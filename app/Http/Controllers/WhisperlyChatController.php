<?php

namespace App\Http\Controllers;

use App\Modules\bookings\Models\WhisperlyBooking;
use App\Modules\chat\Models\WhisperlyChatUserState;
use App\Modules\chat\Models\WhisperlyConversation;
use App\Modules\pengguna\Models\pengguna;
use App\Modules\talents\Models\talents;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class WhisperlyChatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST CHAT
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $user = $request->user('whisperly');

        abort_unless($user, 403);

        $query = WhisperlyBooking::query()
            ->with([
                'pengguna',
                'talent.pengguna',
                'schedule',
                'conversation.messages.sender',
            ])
            ->orderByDesc('created_at');

        if ($user->role === 'user') {

            $query->where(
                'pengguna_id',
                $user->id
            );

        } elseif ($user->role === 'talent') {

            $profile = talents::query()
                ->where(
                    'pengguna_id',
                    $user->id
                )
                ->first();

            if ($profile) {

                $query->where(
                    'talent_id',
                    $profile->id
                );

            } else {

                $query->whereRaw('0 = 1');
            }

        } else {

            abort(403);
        }

        $allBookings = $query->get();

        /*
        |--------------------------------------------------------------------------
        | SEMBUNYIKAN CHAT YANG DIHAPUS
        |--------------------------------------------------------------------------
        */

        $allBookings = $allBookings
            ->filter(function (WhisperlyBooking $booking) use ($user) {

                $state = $this->chatUserState(
                    $user,
                    $booking
                );

                return ! $state?->deleted_at;
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | SINKRON STATUS BOOKING
        |--------------------------------------------------------------------------
        */

        $allBookings = $allBookings->map(
            function (WhisperlyBooking $booking) {

                $booking->syncChatStatus();

                return $booking;
            }
        );

        /*
        |--------------------------------------------------------------------------
        | SATUKAN ROOM BERDASARKAN LAWAN CHAT
        |--------------------------------------------------------------------------
        */

        $bookings = $allBookings
            ->groupBy(function (WhisperlyBooking $booking) use ($user) {

                if ($user->role === 'user') {

                    return 'talent:' . $booking->talent_id;
                }

                return 'user:' . $booking->pengguna_id;
            })
            ->map(function (Collection $roomBookings) {

                return $roomBookings
                    ->sortByDesc('created_at')
                    ->first();
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | HITUNG UNREAD
        |--------------------------------------------------------------------------
        */

        $readTimes = session()->get(
            'whisperly_chat_read',
            []
        );

        $bookings = $bookings->map(
            function (WhisperlyBooking $booking) use (
                $user,
                $allBookings,
                $readTimes
            ) {

                $roomKey = $this->roomKey(
                    $user,
                    $booking
                );

                $userChatState = $this->chatUserState(
                    $user,
                    $booking
                );

                $roomBookings = $allBookings
                    ->filter(function (WhisperlyBooking $item) use (
                        $user,
                        $booking
                    ) {

                        return $this->roomKey(
                            $user,
                            $item
                        ) === $this->roomKey(
                            $user,
                            $booking
                        );
                    });

                $conversationIds = $roomBookings
                    ->pluck('conversation')
                    ->filter()
                    ->pluck('id')
                    ->values();

                $unreadCount = 0;

                $lastMessage = null;

                if ($conversationIds->isNotEmpty()) {

                    foreach ($roomBookings as $roomBooking) {

                        $conversation =
                            $roomBooking->conversation;

                        if (! $conversation) {
                            continue;
                        }

                        $messages =
                            $conversation
                                ->messages()
                                ->when(
                                    $userChatState?->cleared_at,
                                    function (
                                        $query,
                                        $clearedAt
                                    ) {
                                        $query->where(
                                            'created_at',
                                            '>',
                                            $clearedAt
                                        );
                                    }
                                )
                                ->get();

                        foreach ($messages as $message) {

                            if (
                                ! $lastMessage
                                ||
                                (
                                    $message->created_at
                                    &&
                                    $message->created_at->gt(
                                        $lastMessage->created_at
                                    )
                                )
                            ) {

                                $lastMessage = $message;
                            }

                            if (
                                (string) $message->sender_id
                                ===
                                (string) $user->id
                            ) {
                                continue;
                            }

                            $messageTime =
                                $message->created_at;

                            $lastRead =
                                $readTimes[$roomKey] ?? null;

                            if (
                                ! $lastRead
                                ||
                                (
                                    $messageTime
                                    &&
                                    $messageTime->gt(
                                        Carbon::parse($lastRead)
                                    )
                                )
                            ) {

                                $unreadCount++;
                            }
                        }
                    }
                }

                $booking->unread_count =
                    $unreadCount;

                $booking->last_message =
                    $lastMessage;

                $booking->last_message_is_read =
                    $lastMessage
                    && (string) $lastMessage->sender_id
                    === (string) $user->id
                    && isset($readTimes[$roomKey])
                    && $lastMessage->created_at->lte(
                        Carbon::parse($readTimes[$roomKey])
                    );

                return $booking;
            }
        );

        return view(
            'whisperly.chat.index',
            compact('bookings')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ROOM CHAT
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        WhisperlyBooking $booking
    ): View {

        $user = $request->user('whisperly');

        abort_unless($user, 403);

        /*
        |--------------------------------------------------------------------------
        | CEK AKSES
        |--------------------------------------------------------------------------
        */

        $this->authorizeBookingAccess(
            $user,
            $booking
        );

        /*
        |--------------------------------------------------------------------------
        | STATUS BOOKING
        |--------------------------------------------------------------------------
        */

        $booking->syncChatStatus();

        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA BOOKING DENGAN ORANG YANG SAMA
        |--------------------------------------------------------------------------
        */

        $roomBookingsQuery =
            WhisperlyBooking::query()
                ->with([
                    'pengguna',
                    'talent.pengguna',
                    'schedule',
                    'conversation.messages.sender',
                ])
                ->orderBy('created_at');

        if ($user->role === 'user') {

            $roomBookingsQuery
                ->where(
                    'pengguna_id',
                    $user->id
                )
                ->where(
                    'talent_id',
                    $booking->talent_id
                );

        } elseif ($user->role === 'talent') {

            $roomBookingsQuery
                ->where(
                    'pengguna_id',
                    $booking->pengguna_id
                )
                ->where(
                    'talent_id',
                    $booking->talent_id
                );
        }

        $roomBookings =
            $roomBookingsQuery->get();

        /*
        |--------------------------------------------------------------------------
        | CHAT USER STATE
        |--------------------------------------------------------------------------
        */

        $userChatState =
            $this->chatUserState(
                $user,
                $booking
            );

        /*
        |--------------------------------------------------------------------------
        | CHAT YANG PERNAH DIHAPUS DIBUKA KEMBALI
        |--------------------------------------------------------------------------
        |
        | deleted_at hanya digunakan untuk menyembunyikan chat dari daftar.
        |
        | Kalau halaman chat dibuka kembali, chat tidak dianggap 404.
        | Pesan lama disembunyikan menggunakan cleared_at.
        |
        */

        if ($userChatState?->deleted_at) {

            $userChatState->forceFill([
                'deleted_at' =>
                    null,

                'cleared_at' =>
                    now(),
            ])->save();
        }

        /*
        |--------------------------------------------------------------------------
        | SINKRON STATUS SEMUA BOOKING DI ROOM
        |--------------------------------------------------------------------------
        */

        $roomBookings =
            $roomBookings->map(
                function (WhisperlyBooking $item) {

                    $item->syncChatStatus();

                    return $item;
                }
            );

        /*
        |--------------------------------------------------------------------------
        | BUAT / AMBIL CONVERSATION UNTUK BOOKING AKTIF
        |--------------------------------------------------------------------------
        */

        $conversation =
            $booking
                ->conversation()
                ->firstOrCreate(
                    [
                        'booking_id' =>
                            $booking->id,

                        'user_id' =>
                            $booking->pengguna_id,

                        'talent_id' =>
                            $booking->talent_id,
                    ],
                    [
                        'start_time' =>
                            $booking
                                ->schedule
                                ?->start_time
                            ?? '00:00',

                        'end_time' =>
                            $booking
                                ->schedule
                                ?->end_time
                            ?? '00:00',

                        'status' =>
                            $this->chatState(
                                $booking
                            ),
                    ]
                );

        /*
        |--------------------------------------------------------------------------
        | SINKRON CONVERSATION BOOKING AKTIF
        |--------------------------------------------------------------------------
        */

        if ($booking->schedule) {

            $conversation->update([

                'start_time' =>
                    $booking
                        ->schedule
                        ->start_time,

                'end_time' =>
                    $booking
                        ->schedule
                        ->end_time,

                'status' =>
                    $this->chatState(
                        $booking
                    ),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA PESAN
        |--------------------------------------------------------------------------
        */

        $roomMessages = collect();

        foreach ($roomBookings as $roomBooking) {

            $roomConversation =
                $roomBooking->conversation;

            if (! $roomConversation) {
                continue;
            }

            $messages =
                $roomConversation
                    ->messages()
                    ->with('sender')
                    ->when(
                        $userChatState?->cleared_at,
                        function (
                            $query,
                            $clearedAt
                        ) {
                            $query->where(
                                'created_at',
                                '>',
                                $clearedAt
                            );
                        }
                    )
                    ->orderBy('created_at')
                    ->get();

            $roomMessages->push([
                'booking' =>
                    $roomBooking,

                'messages' =>
                    $messages,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PESAN FLAT
        |--------------------------------------------------------------------------
        */

        $messages =
            $roomMessages
                ->pluck('messages')
                ->flatten()
                ->sortBy('created_at')
                ->values();

        /*
        |--------------------------------------------------------------------------
        | STATUS CHAT BOOKING AKTIF
        |--------------------------------------------------------------------------
        */

        $status =
            $this->chatState(
                $booking
            );

        $canChat =
            $status === 'active';

        $notice =
            $this->chatNotice(
                $booking,
                $status
            );

        /*
        |--------------------------------------------------------------------------
        | PROFILE LAWAN CHAT
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'user') {

            $pengguna =
                $booking
                    ->talent
                    ?->pengguna;

            $talent =
                $booking->talent;

        } else {

            $pengguna =
                $booking->pengguna;

            $talent =
                null;
        }

        $contactStatus = 'Offline';

        if ($pengguna?->typing_until?->isFuture()) {

            $contactStatus = 'Mengetik...';

        } elseif (
            $pengguna?->last_seen_at?->gt(
                now()->subSeconds(30)
            )
        ) {

            $contactStatus = 'Online';
        }

        /*
        |--------------------------------------------------------------------------
        | TANDAI ROOM SUDAH DIBACA
        |--------------------------------------------------------------------------
        */

        $roomKey =
            $this->roomKey(
                $user,
                $booking
            );

        $readTimes =
            session()->get(
                'whisperly_chat_read',
                []
            );

        $hasUnreadMessageInCurrentRoom =
            $messages->contains(
                function ($message) use ($user) {

                    return (string) $message->sender_id
                        !==
                        (string) $user->id;
                }
            );

        if ($hasUnreadMessageInCurrentRoom) {

            $readTimes[$roomKey] =
                now()->toIso8601String();

            session()->put(
                'whisperly_chat_read',
                $readTimes
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SIDEBAR
        |--------------------------------------------------------------------------
        */

        $allBookings =
            WhisperlyBooking::query()
                ->with([
                    'pengguna',
                    'talent.pengguna',
                    'schedule',
                    'conversation.messages.sender',
                ])
                ->orderByDesc('created_at')
                ->get();

        $allBookings =
            $allBookings
                ->filter(
                    function (
                        WhisperlyBooking $item
                    ) use ($user) {

                        $state =
                            $this->chatUserState(
                                $user,
                                $item
                            );

                        return ! $state?->deleted_at;
                    }
                )
                ->values();

        if ($user->role === 'user') {

            $allBookings =
                $allBookings->filter(
                    fn (WhisperlyBooking $item) =>
                        (string) $item->pengguna_id
                        ===
                        (string) $user->id
                );

        } elseif ($user->role === 'talent') {

            $profile =
                talents::query()
                    ->where(
                        'pengguna_id',
                        $user->id
                    )
                    ->first();

            if ($profile) {

                $allBookings =
                    $allBookings->filter(
                        fn (WhisperlyBooking $item) =>
                            (string) $item->talent_id
                            ===
                            (string) $profile->id
                    );

            } else {

                $allBookings =
                    collect();
            }
        }

        $allBookings =
            $allBookings->map(
                function (
                    WhisperlyBooking $item
                ) {

                    $item->syncChatStatus();

                    return $item;
                }
            );

        $allBookings =
            $allBookings
                ->filter(
                    function (
                        WhisperlyBooking $item
                    ) {

                        return
                            $item->conversation
                            &&
                            $item
                                ->conversation
                                ->messages
                                ->isNotEmpty();
                    }
                )
                ->values();

        /*
        |--------------------------------------------------------------------------
        | SATUKAN SIDEBAR
        |--------------------------------------------------------------------------
        */

        $bookings =
            $allBookings
                ->groupBy(
                    function (
                        WhisperlyBooking $item
                    ) use ($user) {

                        return $this->roomKey(
                            $user,
                            $item
                        );
                    }
                )
                ->map(
                    function (
                        Collection $room
                    ) {

                        return $room
                            ->sortByDesc(
                                'created_at'
                            )
                            ->first();
                    }
                )
                ->values();

        /*
        |--------------------------------------------------------------------------
        | HITUNG UNREAD SIDEBAR
        |--------------------------------------------------------------------------
        */

        $readTimes =
            session()->get(
                'whisperly_chat_read',
                []
            );

        $bookings =
            $bookings->map(
                function (
                    WhisperlyBooking $item
                ) use (
                    $user,
                    $allBookings,
                    $readTimes
                ) {

                    $key =
                        $this->roomKey(
                            $user,
                            $item
                        );

                    $userChatState =
                        $this->chatUserState(
                            $user,
                            $item
                        );

                    $roomBookings =
                        $allBookings->filter(
                            function (
                                WhisperlyBooking $roomItem
                            ) use (
                                $user,
                                $item
                            ) {

                                return
                                    $this->roomKey(
                                        $user,
                                        $roomItem
                                    )
                                    ===
                                    $this->roomKey(
                                        $user,
                                        $item
                                    );
                            }
                        );

                    $unread = 0;

                    $lastMessage = null;

                    foreach (
                        $roomBookings
                        as $roomBooking
                    ) {

                        $conversation =
                            $roomBooking
                                ->conversation;

                        if (! $conversation) {
                            continue;
                        }

                        $roomMessages =
                            $conversation
                                ->messages()
                                ->when(
                                    $userChatState?->cleared_at,
                                    function (
                                        $query,
                                        $clearedAt
                                    ) {

                                        $query->where(
                                            'created_at',
                                            '>',
                                            $clearedAt
                                        );
                                    }
                                )
                                ->get();

                        foreach (
                            $roomMessages
                            as $message
                        ) {

                            if (
                                ! $lastMessage
                                ||
                                (
                                    $message->created_at
                                    &&
                                    $message
                                        ->created_at
                                        ->gt(
                                            $lastMessage->created_at
                                        )
                                )
                            ) {

                                $lastMessage =
                                    $message;
                            }

                            if (
                                (string)
                                $message->sender_id
                                ===
                                (string)
                                $user->id
                            ) {

                                continue;
                            }

                            $lastRead =
                                $readTimes[$key]
                                ?? null;

                            if (! $lastRead) {

                                $unread++;

                                continue;
                            }

                            if (
                                $message->created_at
                                &&
                                $message
                                    ->created_at
                                    ->gt(
                                        Carbon::parse(
                                            $lastRead
                                        )
                                    )
                            ) {

                                $unread++;
                            }
                        }
                    }

                    $item->unread_count =
                        $unread;

                    $item->last_message =
                        $lastMessage;

                    $item->last_message_is_read =
                        $lastMessage
                        &&
                        (string)
                        $lastMessage->sender_id
                        ===
                        (string)
                        $user->id
                        &&
                        isset(
                            $readTimes[$key]
                        )
                        &&
                        $lastMessage
                            ->created_at
                            ->lte(
                                Carbon::parse(
                                    $readTimes[$key]
                                )
                            );

                    return $item;
                }
            );

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'whisperly.chat.show',
            [
                'booking' =>
                    $booking,

                'bookings' =>
                    $bookings,

                'roomBookings' =>
                    $roomBookings,

                'roomMessages' =>
                    $roomMessages,

                'conversation' =>
                    $conversation,

                'messages' =>
                    $messages,

                'status' =>
                    $status,

                'canChat' =>
                    $canChat,

                'notice' =>
                    $notice,

                'pengguna' =>
                    $pengguna,

                'talent' =>
                    $talent,

                'contactStatus' =>
                    $contactStatus,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ARCHIVE CHAT
    |--------------------------------------------------------------------------
    */

    public function archive(
        Request $request,
        WhisperlyBooking $booking
    ): RedirectResponse {

        $user =
            $request->user('whisperly');

        abort_unless(
            $user,
            403
        );

        $this->authorizeBookingAccess(
            $user,
            $booking
        );

        /*
        | archived_at tidak digunakan karena
        | kolom tersebut tidak ada di database.
        |
        | Archive diperlakukan sama seperti menyembunyikan
        | chat dari daftar.
        */

        $this->chatUserState(
            $user,
            $booking
        )->update([
            'deleted_at' =>
                now(),
        ]);

        return redirect()->route(
            'whisperly.chat.index'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE CHAT
    |--------------------------------------------------------------------------
    */

    public function deleteChat(
        Request $request,
        WhisperlyBooking $booking
    ): RedirectResponse {

        $user =
            $request->user('whisperly');

        abort_unless(
            $user,
            403
        );

        $this->authorizeBookingAccess(
            $user,
            $booking
        );

        $this->chatUserState(
            $user,
            $booking
        )->update([
            'deleted_at' =>
                now(),
        ]);

        return redirect()->route(
            'whisperly.chat.index'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CLEAR CHAT
    |--------------------------------------------------------------------------
    */

    public function clearChat(
        Request $request,
        WhisperlyBooking $booking
    ): RedirectResponse {

        $user =
            $request->user('whisperly');

        abort_unless(
            $user,
            403
        );

        $this->authorizeBookingAccess(
            $user,
            $booking
        );

        $this->chatUserState(
            $user,
            $booking
        )->update([
            'cleared_at' =>
                now(),
        ]);

        return redirect()->route(
            'whisperly.chat.show',
            $booking->id
        );
    }


    /*
    |--------------------------------------------------------------------------
    | KIRIM PESAN
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        WhisperlyBooking $booking
    ): RedirectResponse {

        $user =
            $request->user('whisperly');

        $this->authorizeBookingAccess(
            $user,
            $booking
        );

        $request->validate([
            'message' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $booking->syncChatStatus();

        if (
            $this->chatState(
                $booking
            )
            !==
            'active'
        ) {

            abort(
                403,
                'Booking telah selesai. Chat ini sudah ditutup.'
            );
        }

        $conversation =
            $booking
                ->conversation()
                ->firstOrCreate(
                    [
                        'booking_id' =>
                            $booking->id,

                        'user_id' =>
                            $booking->pengguna_id,

                        'talent_id' =>
                            $booking->talent_id,
                    ],
                    [
                        'start_time' =>
                            $booking
                                ->schedule
                                ?->start_time
                            ?? '00:00',

                        'end_time' =>
                            $booking
                                ->schedule
                                ?->end_time
                            ?? '00:00',

                        'status' =>
                            'active',
                    ]
                );

        $conversation
            ->messages()
            ->create([
                'sender_id' =>
                    $user->id,

                'message' =>
                    trim(
                        (string)
                        $request->input(
                            'message'
                        )
                    ),
            ]);

        return redirect()
            ->route(
                'whisperly.chat.show',
                $booking->id
            )
            ->with(
                'status',
                'Pesan terkirim.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HEARTBEAT
    |--------------------------------------------------------------------------
    */

    public function heartbeat(
        Request $request
    ): JsonResponse {

        $user =
            $request->user('whisperly');

        abort_unless(
            $user,
            403
        );

        $user->forceFill([
            'last_seen_at' =>
                now(),
        ])->save();

        return response()->json([
            'ok' =>
                true,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | TYPING
    |--------------------------------------------------------------------------
    */

    public function typing(
        Request $request
    ): JsonResponse {

        $user =
            $request->user('whisperly');

        abort_unless(
            $user,
            403
        );

        $user->forceFill([
            'last_seen_at' =>
                now(),

            'typing_until' =>
                $request->boolean('typing')
                    ? now()->addSeconds(5)
                    : null,
        ])->save();

        return response()->json([
            'ok' =>
                true,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | PRESENCE
    |--------------------------------------------------------------------------
    */

    public function presence(
        Request $request,
        WhisperlyBooking $booking
    ): JsonResponse {

        $user =
            $request->user('whisperly');

        abort_unless(
            $user,
            403
        );

        $this->authorizeBookingAccess(
            $user,
            $booking
        );

        $other =
            $user->role === 'user'
                ? $booking->talent?->pengguna
                : $booking->pengguna;

        $status = 'Offline';

        if (
            $other?->typing_until?->isFuture()
        ) {

            $status =
                'Mengetik...';

        } elseif (
            $other?->last_seen_at?->gt(
                now()->subSeconds(30)
            )
        ) {

            $status =
                'Online';
        }

        return response()->json([
            'status' =>
                $status,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ROOM KEY
    |--------------------------------------------------------------------------
    */

    private function roomKey(
        pengguna $user,
        WhisperlyBooking $booking
    ): string {

        if (
            $user->role === 'user'
        ) {

            return
                'user:'
                . $user->id
                . ':talent:'
                . $booking->talent_id;
        }

        return
            'talent:'
            . $user->id
            . ':user:'
            . $booking->pengguna_id;
    }


    /*
    |--------------------------------------------------------------------------
    | CONTACT USER ID
    |--------------------------------------------------------------------------
    */

    private function contactUserId(
        pengguna $user,
        WhisperlyBooking $booking
    ): ?string {

        return
            $user->role === 'user'
                ? $booking->talent?->pengguna_id
                : $booking->pengguna_id;
    }


    /*
    |--------------------------------------------------------------------------
    | CHAT USER STATE
    |--------------------------------------------------------------------------
    */

    private function chatUserState(
        pengguna $user,
        WhisperlyBooking $booking
    ): ?WhisperlyChatUserState {

        $contactUserId =
            $this->contactUserId(
                $user,
                $booking
            );

        if (! $contactUserId) {
            return null;
        }

        return WhisperlyChatUserState::firstOrCreate([
            'user_id' =>
                $user->id,

            'contact_user_id' =>
                $contactUserId,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | CEK AKSES BOOKING
    |--------------------------------------------------------------------------
    */

    private function authorizeBookingAccess(
        pengguna $user,
        WhisperlyBooking $booking
    ): void {

        $role =
            $user->role;

        if (
            $role === 'user'
            &&
            $booking->pengguna_id
                !==
                $user->id
        ) {

            abort(
                403,
                'Anda tidak memiliki akses ke chat ini.'
            );
        }

        if (
            $role === 'talent'
        ) {

            $talentProfile =
                talents::query()
                    ->where(
                        'pengguna_id',
                        $user->id
                    )
                    ->first();

            if (
                ! $talentProfile
                ||
                $booking->talent_id
                    !==
                    $talentProfile->id
            ) {

                abort(
                    403,
                    'Anda tidak memiliki akses ke chat ini.'
                );
            }
        }

        if (
            ! in_array(
                $role,
                [
                    'user',
                    'talent',
                ],
                true
            )
        ) {

            abort(
                403,
                'Akses chat tidak tersedia untuk role ini.'
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | STATUS CHAT
    |--------------------------------------------------------------------------
    */

    private function chatState(
        WhisperlyBooking $booking
    ): string {

        if (
            ! $booking->schedule
        ) {

            return 'closed';
        }

        $now =
            now()->setTimezone(
                'Asia/Jakarta'
            );

        $start =
            Carbon::parse(
                $booking
                    ->schedule
                    ->start_time,
                'Asia/Jakarta'
            )->setDate(
                $now->year,
                $now->month,
                $now->day
            );

        $end =
            Carbon::parse(
                $booking
                    ->schedule
                    ->end_time,
                'Asia/Jakarta'
            )->setDate(
                $now->year,
                $now->month,
                $now->day
            );

        if (
            $now->lt($start)
        ) {

            return 'upcoming';
        }

        if (
            $now->gte($end)
        ) {

            if (
                $booking->status
                !==
                'completed'
            ) {

                $booking->update([
                    'status' =>
                        'completed',
                ]);
            }

            $booking
                ->conversation
                ?->update([
                    'status' =>
                        'closed',
                ]);

            return 'completed';
        }

        if (
            $booking->status
            !==
            'active'
        ) {

            $booking->update([
                'status' =>
                    'active',
            ]);
        }

        $booking
            ->conversation
            ?->update([
                'status' =>
                    'active',
            ]);

        return 'active';
    }


    /*
    |--------------------------------------------------------------------------
    | PESAN STATUS CHAT
    |--------------------------------------------------------------------------
    */

    private function chatNotice(
        WhisperlyBooking $booking,
        string $status
    ): string {

        if (
            $status === 'upcoming'
        ) {

            return
                'Chat akan tersedia mulai pukul '
                .
                $booking
                    ->schedule
                    ?->start_time
                .
                ' WIB.';
        }

        if (
            $status === 'completed'
        ) {

            return
                'Booking telah selesai. Chat ini sudah ditutup.';
        }

        return '';
    }
}