<?php

namespace App\Http\Controllers;

use App\Modules\bookings\Models\WhisperlyBooking;
use App\Modules\bookings\Models\bookings;
use App\Modules\chat\Models\WhisperlyChatUserState;
use App\Modules\chat\Models\WhisperlyConversation;
use App\Modules\pengguna\Models\pengguna;
use App\Modules\talents\Models\talents;
use App\Modules\ratings\Models\ratings;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
            ->filter(function (
                WhisperlyBooking $booking
            ) use ($user) {

                $state = $this->chatUserState(
                    $user,
                    $booking,
                    true
                );

                return ! $state?->archived_at
                    && ! $state?->deleted_at;
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | SINKRON STATUS BOOKING
        |--------------------------------------------------------------------------
        */

        $allBookings = $allBookings->map(
            function (
                WhisperlyBooking $booking
            ) {

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
            ->groupBy(
                function (
                    WhisperlyBooking $booking
                ) use ($user) {

                    if ($user->role === 'user') {

                        return
                            'talent:'
                            . $booking->talent_id;
                    }

                    return
                        'user:'
                        . $booking->pengguna_id;
                }
            )
            ->map(
                function (
                    Collection $roomBookings
                ) {

                    return $roomBookings
                        ->sortByDesc('created_at')
                        ->first();
                }
            )
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
            function (
                WhisperlyBooking $booking
            ) use (
                $user,
                $allBookings,
                $readTimes
            ) {

                $roomKey = $this->roomKey(
                    $user,
                    $booking
                );

                $userChatState =
                    $this->chatUserState(
                        $user,
                        $booking
                    );

                $roomBookings = $allBookings
                    ->filter(
                        function (
                            WhisperlyBooking $item
                        ) use (
                            $user,
                            $booking
                        ) {

                            return
                                $this->roomKey(
                                    $user,
                                    $item
                                )
                                ===
                                $this->roomKey(
                                    $user,
                                    $booking
                                );
                        }
                    );

                $unreadCount = 0;

                $lastMessage = null;

                foreach (
                    $roomBookings
                    as $roomBooking
                ) {

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
                                ) use ($userChatState) {

                                    $query->where(
                                        'created_at',
                                        '>',
                                        $clearedAt
                                    );
                                }
                            )
                            ->whereNotIn(
                                'id',
                                DB::table(
                                    'whisperly_message_user_deletions'
                                )
                                    ->where(
                                        'user_id',
                                        (string) $user->id
                                    )
                                    ->pluck(
                                        'message_id'
                                    )
                            )
                            ->get();

                    foreach (
                        $messages
                        as $message
                    ) {

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
                            $readTimes[$roomKey]
                            ?? null;

                        if (
                            ! $lastRead
                            ||
                            (
                                $messageTime
                                &&
                                $messageTime->gt(
                                    Carbon::parse(
                                        $lastRead
                                    )
                                )
                            )
                        ) {

                            $unreadCount++;
                        }
                    }
                }

                $booking->unread_count =
                    $unreadCount;

                $booking->last_message =
                    $lastMessage;

                $booking->last_message_is_read =
                    $lastMessage
                    &&
                    (string) $lastMessage->sender_id
                        ===
                    (string) $user->id
                    &&
                    isset($readTimes[$roomKey])
                    &&
                    $lastMessage->created_at->lte(
                        Carbon::parse(
                            $readTimes[$roomKey]
                        )
                    );

                return $booking;
            }
        );

        /*
        |--------------------------------------------------------------------------
        | URUTKAN BERDASARKAN PESAN TERAKHIR SEBENARNYA
        |--------------------------------------------------------------------------
        | Jangan menggunakan created_at booking sebagai urutan utama.
        | Booking lama bisa memiliki pesan baru, sehingga preview dan urutan
        | sidebar harus mengikuti pesan terakhir yang benar-benar terlihat.
        |--------------------------------------------------------------------------
        */

        $bookings = $bookings
            ->sort(function (
                WhisperlyBooking $a,
                WhisperlyBooking $b
            ) {

                $aTime = $a->last_message?->created_at;
                $bTime = $b->last_message?->created_at;

                if ($aTime && $bTime) {
                    return $bTime->valueOf() <=> $aTime->valueOf();
                }

                if ($aTime && ! $bTime) {
                    return -1;
                }

                if (! $aTime && $bTime) {
                    return 1;
                }

                return $b->created_at?->valueOf() <=> $a->created_at?->valueOf();
            })
            ->values();

        return view(
            'whisperly.chat.index',
            compact('bookings')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REALTIME UPDATE LIST CHAT
    |--------------------------------------------------------------------------
    */

    public function updates(Request $request): JsonResponse
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

                return response()->json([
                    'chats' => []
                ]);
            }

        } else {

            abort(403);
        }

        $allBookings = $query->get()
            ->filter(function (
                WhisperlyBooking $booking
            ) use ($user) {

                $state =
                    $this->chatUserState(
                        $user,
                        $booking,
                        true
                    );

                return ! $state?->archived_at
                    && ! $state?->deleted_at;
            })
            ->values()
            ->map(function (
                WhisperlyBooking $booking
            ) {

                $booking->syncChatStatus();

                return $booking;
            });

        $bookings = $allBookings
            ->groupBy(
                fn (
                    WhisperlyBooking $booking
                ) =>
                    $this->roomKey(
                        $user,
                        $booking
                    )
            )
            ->map(function (
                Collection $roomBookings
            ) {

                return $roomBookings
                    ->sortByDesc('created_at')
                    ->first();
            })
            ->values();

        $readTimes = session()->get(
            'whisperly_chat_read',
            []
        );

        $result = $bookings->map(
            function (
                WhisperlyBooking $booking
            ) use (
                $user,
                $allBookings,
                $readTimes
            ) {

                $roomKey = $this->roomKey(
                    $user,
                    $booking
                );

                $userChatState =
                    $this->chatUserState(
                        $user,
                        $booking
                    );

                $roomBookings =
                    $allBookings->filter(
                        function (
                            WhisperlyBooking $item
                        ) use (
                            $user,
                            $booking
                        ) {

                            return
                                $this->roomKey(
                                    $user,
                                    $item
                                )
                                ===
                                $this->roomKey(
                                    $user,
                                    $booking
                                );
                        }
                    );

                $unreadCount = 0;

                $lastMessage = null;

                foreach (
                    $roomBookings
                    as $roomBooking
                ) {

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
                            ->whereNotIn(
                                'id',
                                DB::table(
                                    'whisperly_message_user_deletions'
                                )
                                    ->where(
                                        'user_id',
                                        (string) $user->id
                                    )
                                    ->pluck(
                                        'message_id'
                                    )
                            )
                            ->get();

                    foreach (
                        $messages
                        as $message
                    ) {

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

                        $lastRead =
                            $readTimes[$roomKey]
                            ?? null;

                        $messageTime =
                            $message->created_at;

                        if (
                            ! $lastRead
                            ||
                            (
                                $messageTime
                                &&
                                $messageTime->gt(
                                    Carbon::parse(
                                        $lastRead
                                    )
                                )
                            )
                        ) {

                            $unreadCount++;
                        }
                    }
                }

                $otherName =
                    $user->role === 'user'
                        ? (
                            $booking
                                ->talent
                                ?->pengguna
                                ?->username
                            ?? 'Talent'
                        )
                        : (
                            $booking
                                ->pengguna
                                ?->username
                            ?? 'User'
                        );

                $lastMessageTime =
                    $lastMessage?->created_at;

                /*
                |--------------------------------------------------------------------------
                | FOTO PROFIL LAWAN CHAT
                |--------------------------------------------------------------------------
                |
                | Untuk USER, foto lawan chat berasal dari foto talent.
                | Ini harus dikirim oleh endpoint realtime karena chat baru
                | belum memiliki elemen HTML di sidebar saat halaman pertama
                | kali dibuka.
                |
                |--------------------------------------------------------------------------
                */

                $avatar = null;

                if ($user->role === 'user') {

                    // USER login -> lihat foto TALENT.
                    // Utamakan avatar milik pengguna talent, lalu fallback
                    // ke kolom photo pada profil talent.
                    $avatar =
                        $booking->talent?->pengguna?->avatar_url
                        ?? $booking->talent?->pengguna?->photo
                        ?? null;

                    if (!$avatar && $booking->talent?->photo) {
                        $avatar = asset(
                            'storage/' .
                            ltrim(
                                $booking->talent->photo,
                                '/'
                            )
                        );
                    }

                } elseif ($user->role === 'talent') {

                    // TALENT login -> lihat foto USER.
                    $avatar =
                        $booking->pengguna?->avatar_url
                        ?? $booking->pengguna?->photo
                        ?? null;
                }

                // Pastikan path relatif dari database menjadi URL yang bisa
                // langsung dipakai oleh JavaScript.
                if ($avatar) {

                    $avatar = trim((string) $avatar);

                    if (
                        ! str_starts_with($avatar, 'http://')
                        && ! str_starts_with($avatar, 'https://')
                        && ! str_starts_with($avatar, '//')
                        && ! str_starts_with($avatar, '/')
                    ) {

                        if (str_starts_with($avatar, 'storage/')) {
                            $avatar = asset($avatar);
                        } else {
                            $avatar = asset(
                                'storage/' .
                                ltrim($avatar, '/')
                            );
                        }
                    }
                }

                return [
                    'booking_id' =>
                        (string) $booking->id,

                    'room_key' =>
                        $roomKey,

                    'name' =>
                        $otherName,

                    'avatar' =>
                        $avatar,

                    'last_message' =>
                        $lastMessage?->message
                        ?? 'Belum ada pesan',

                    'time' =>
                        $lastMessageTime
                            ? $lastMessageTime->format('H:i')
                            : substr(
                                $booking
                                    ->schedule
                                    ?->start_time
                                    ?? '00:00',
                                0,
                                5
                            ),

                    'timestamp' =>
                        $lastMessageTime
                            ? $lastMessageTime
                                ->toIso8601String()
                            : (
                                $booking
                                    ->created_at
                                    ?->toIso8601String()
                                ?? ''
                            ),

                    'unread_count' =>
                        $unreadCount,

                    'last_message_from_me' =>
                        $lastMessage
                            ? (string)
                                $lastMessage->sender_id
                                ===
                                (string) $user->id
                            : false,

                    'last_message_is_read' =>
                        $lastMessage
                        &&
                        (string)
                            $lastMessage->sender_id
                            ===
                        (string) $user->id
                        &&
                        isset(
                            $readTimes[$roomKey]
                        )
                        &&
                        $lastMessage
                            ->created_at
                            ->lte(
                                Carbon::parse(
                                    $readTimes[$roomKey]
                                )
                            ),
                ];
            }
        )->values()->all();

        usort(
            $result,
            function (
                array $a,
                array $b
            ) {

                return strcmp(
                    $b['timestamp'],
                    $a['timestamp']
                );
            }
        );

        return response()->json([
            'chats' => $result,
        ]);
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

        $user =
            $request->user('whisperly');

        abort_unless(
            $user,
            403
        );

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

        $userChatState =
            $this->chatUserState(
                $user,
                $booking,
                true
            );

        /*
        |--------------------------------------------------------------------------
        | SINKRON STATUS SEMUA BOOKING
        |--------------------------------------------------------------------------
        */

        $roomBookings =
            $roomBookings->map(
                function (
                    WhisperlyBooking $item
                ) {

                    $item->syncChatStatus();

                    return $item;
                }
            );

        /*
        |--------------------------------------------------------------------------
        | PULIHKAN ROOM CHAT YANG SEBELUMNYA DIHAPUS
        |--------------------------------------------------------------------------
        |
        | Jika user/talent pernah menekan "Hapus Chat", state chat menyimpan
        | deleted_at sehingga room disembunyikan dari sidebar. Begitu pesan baru
        | dikirim, room harus otomatis aktif kembali tanpa Tinker dan tanpa
        | menghapus riwayat/fungsi chat lainnya.
        |
        */

        $chatUserState =
            $this->chatUserState(
                $user,
                $booking
            );

        if ($chatUserState) {

            $chatUserState->update([
                'deleted_at' =>
                    null,

                'archived_at' =>
                    null,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CONVERSATION
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
        | UPDATE CONVERSATION
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
        | AMBIL SEMUA PESAN ROOM
        |--------------------------------------------------------------------------
        */

        $roomMessages = collect();

        foreach (
            $roomBookings
            as $roomBooking
        ) {

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
                        ) use ($userChatState) {

                            $query->where(
                                'created_at',
                                '>',
                                $clearedAt
                            );
                        }
                    )
                    ->whereNotIn(
                        'id',
                        DB::table(
                            'whisperly_message_user_deletions'
                        )
                            ->where(
                                'user_id',
                                (string) $user->id
                            )
                            ->pluck(
                                'message_id'
                            )
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
        | STATUS CHAT
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
        | RATING
        |--------------------------------------------------------------------------
        |
        | PENTING:
        |
        | ratings.id_booking
        |     ↓
        | bookings.kode_booking
        |
        |--------------------------------------------------------------------------
        */

        $canRate = false;

        $existingRating = null;

        if ($user->role === 'user') {

            $booking->syncLaralagBooking(
                true
            );

            $laralagBooking =
                bookings::withTrashed()
                    ->where(
                        'source_booking_id',
                        $booking->id
                    )
                    ->first();

            if ($laralagBooking) {

                /*
                |--------------------------------------------------------------------------
                | CEK RATING DENGAN KODE BOOKING
                |--------------------------------------------------------------------------
                |
                | Jangan gunakan:
                |
                | $laralagBooking->id
                |
                | karena FK ratings.id_booking menunjuk
                | ke bookings.kode_booking.
                |
                */

                $existingRating =
                    ratings::query()
                        ->where(
                            'id_booking',
                            $laralagBooking->kode_booking
                        )
                        ->where(
                            'id_pengguna',
                            $user->id
                        )
                        ->first();

                $canRate =
                    $status === 'completed'
                    && ! $existingRating;
            }
        }

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

            $talent = null;
        }

        /*
        |--------------------------------------------------------------------------
        | STATUS ONLINE
        |--------------------------------------------------------------------------
        */

        $contactStatus = 'Offline';

        if (
            $pengguna?->typing_until?->isFuture()
        ) {

            $contactStatus =
                'Mengetik...';

        } elseif (
            $pengguna?->last_seen_at?->gt(
                now()->subSeconds(30)
            )
        ) {

            $contactStatus =
                'Online';
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

                    return
                        (string) $message->sender_id
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
                                $item,
                                true
                            );

                        return
                            ! $state?->archived_at
                            &&
                            ! $state?->deleted_at;
                    }
                )
                ->values();

        if ($user->role === 'user') {

            $allBookings =
                $allBookings->filter(
                    fn (
                        WhisperlyBooking $item
                    ) =>
                        (string)
                            $item->pengguna_id
                        ===
                        (string)
                            $user->id
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
                        fn (
                            WhisperlyBooking $item
                        ) =>
                            (string)
                                $item->talent_id
                            ===
                            (string)
                                $profile->id
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

        /*
        |--------------------------------------------------------------------------
        | JANGAN SEMBUNYIKAN BOOKING YANG BELUM PUNYA PESAN
        |--------------------------------------------------------------------------
        */

        $allBookings =
            $allBookings->values();

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
        | UNREAD SIDEBAR
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
                                    ) use (
                                        $userChatState
                                    ) {

                                        $query->where(
                                            'created_at',
                                            '>',
                                            $clearedAt
                                        );
                                    }
                                )
                                ->whereNotIn(
                                    'id',
                                    DB::table(
                                        'whisperly_message_user_deletions'
                                    )
                                        ->where(
                                            'user_id',
                                            (string) $user->id
                                        )
                                        ->pluck(
                                            'message_id'
                                        )
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
                                    $message->created_at->gt(
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

        /*
        |--------------------------------------------------------------------------
        | URUTKAN SIDEBAR DENGAN ATURAN YANG SAMA SEPERTI INDEX
        |--------------------------------------------------------------------------
        */

        $bookings = $bookings
            ->sort(function (
                WhisperlyBooking $a,
                WhisperlyBooking $b
            ) {

                $aTime = $a->last_message?->created_at;
                $bTime = $b->last_message?->created_at;

                if ($aTime && $bTime) {
                    return $bTime->valueOf() <=> $aTime->valueOf();
                }

                if ($aTime && ! $bTime) {
                    return -1;
                }

                if (! $aTime && $bTime) {
                    return 1;
                }

                return $b->created_at?->valueOf() <=> $a->created_at?->valueOf();
            })
            ->values();

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

                'canRate' =>
                    $canRate,

                'existingRating' =>
                    $existingRating,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN RATING KE LARALAG
    |--------------------------------------------------------------------------
    */

    public function storeRating(
        Request $request,
        WhisperlyBooking $booking
    ): RedirectResponse {

        $user =
            $request->user('whisperly');

        abort_unless(
            $user,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | HANYA USER
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'user'
        ) {

            abort(
                403,
                'Hanya pengguna yang dapat memberikan rating.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK AKSES BOOKING
        |--------------------------------------------------------------------------
        */

        $this->authorizeBookingAccess(
            $user,
            $booking
        );

        /*
        |--------------------------------------------------------------------------
        | BOOKING HARUS SUDAH SELESAI
        |--------------------------------------------------------------------------
        */

        $status =
            $this->chatState(
                $booking
            );

        if (
            $status !== 'completed'
        ) {

            return redirect()
                ->route(
                    'whisperly.chat.show',
                    $booking->id
                )
                ->with(
                    'message_error',
                    'Rating hanya dapat diberikan setelah sesi selesai.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDASI RATING
        |--------------------------------------------------------------------------
        */

        $validated =
            $request->validate([
                'nilai_rating' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:5',
                ],

                'ulasan' => [
                    'required',
                    'string',
                    'max:1000',
                ],
            ]);

        /*
        |--------------------------------------------------------------------------
        | SINKRONKAN BOOKING
        |--------------------------------------------------------------------------
        */

        $booking->syncLaralagBooking(
            true
        );

        /*
        |--------------------------------------------------------------------------
        | CARI BOOKING LARALAG
        |--------------------------------------------------------------------------
        */

        $laralagBooking =
            bookings::withTrashed()
                ->where(
                    'source_booking_id',
                    $booking->id
                )
                ->first();

        if (
            ! $laralagBooking
        ) {

            return redirect()
                ->route(
                    'whisperly.chat.show',
                    $booking->id
                )
                ->with(
                    'message_error',
                    'Booking Laralag tidak ditemukan, sehingga rating belum dapat disimpan.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | PASTIKAN KODE BOOKING ADA
        |--------------------------------------------------------------------------
        */

        if (
            empty(
                $laralagBooking->kode_booking
            )
        ) {

            return redirect()
                ->route(
                    'whisperly.chat.show',
                    $booking->id
                )
                ->with(
                    'message_error',
                    'Kode booking Laralag tidak ditemukan, sehingga rating belum dapat disimpan.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK RATING DUPLIKAT
        |--------------------------------------------------------------------------
        */

        $alreadyRated =
            ratings::query()
                ->where(
                    'id_booking',
                    $laralagBooking->kode_booking
                )
                ->where(
                    'id_pengguna',
                    $user->id
                )
                ->exists();

        /*
        |--------------------------------------------------------------------------
        | JIKA SUDAH RATING
        |--------------------------------------------------------------------------
        */

        if (
            $alreadyRated
        ) {

            return redirect()
                ->route(
                    'whisperly.chat.show',
                    $booking->id
                )
                ->with(
                    'message_error',
                    'Booking ini sudah kamu beri rating.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN RATING
        |--------------------------------------------------------------------------
        */

        ratings::create([
            'id_booking' =>
                $laralagBooking->kode_booking,

            'id_pengguna' =>
                $user->id,

            'nilai_rating' =>
                $validated[
                    'nilai_rating'
                ],

            'ulasan' =>
                trim(
                    $validated[
                        'ulasan'
                    ]
                ),

            'created_by' =>
                $user->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'whisperly.chat.show',
                $booking->id
            )
            ->with(
                'rating_success',
                true
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

        $this->chatUserState(
            $user,
            $booking
        )->update([
            'archived_at' =>
                now(),

            'deleted_at' =>
                null,
        ]);

        return redirect()
            ->route(
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

        return redirect()
            ->route(
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

        return redirect()
            ->route(
                'whisperly.chat.show',
                $booking->id
            );
    }


    /*
    |--------------------------------------------------------------------------
    | KIRIM PESAN
    |--------------------------------------------------------------------------
    */

    public function messages(
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

        $userChatState =
            $this->chatUserState(
                $user,
                $booking
            );

        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA BOOKING DALAM ROOM YANG SAMA
        |--------------------------------------------------------------------------
        */

        $roomBookingsQuery =
            WhisperlyBooking::query()
                ->with([
                    'conversation.messages.sender',
                ]);

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

        } else {

            abort(403);
        }

        $roomBookings =
            $roomBookingsQuery->get();

        $messages = collect();

        foreach (
            $roomBookings
            as $roomBooking
        ) {

            $conversation =
                $roomBooking->conversation;

            if (! $conversation) {
                continue;
            }

            $roomMessages =
                $conversation->messages
                    ->when(
                        $userChatState?->cleared_at,
                        function (
                            $messages,
                            $clearedAt
                        ) {

                            return $messages->filter(
                                function (
                                    $message
                                ) use (
                                    $clearedAt
                                ) {

                                    return
                                        $message->created_at
                                        &&
                                        $message
                                            ->created_at
                                            ->gt(
                                                $clearedAt
                                            );
                                }
                            );
                        }
                    )
                    ->reject(
                        function (
                            $message
                        ) use (
                            $user
                        ) {

                            return DB::table(
                                'whisperly_message_user_deletions'
                            )
                                ->where(
                                    'message_id',
                                    (string)
                                        $message->id
                                )
                                ->where(
                                    'user_id',
                                    (string)
                                        $user->id
                                )
                                ->exists();
                        }
                    );

            foreach (
                $roomMessages
                as $message
            ) {

                $messages->push(
                    $message
                );
            }
        }

        $messages =
            $messages
                ->sortBy(
                    function (
                        $message
                    ) {

                        return
                            $message
                                ->created_at
                                ?->timestamp
                            ?? 0;
                    }
                )
                ->values();

        /*
        |--------------------------------------------------------------------------
        | REACTIONS
        |--------------------------------------------------------------------------
        */

        $messageIds =
            $messages
                ->pluck('id')
                ->map(
                    fn ($id) =>
                        (string) $id
                )
                ->values()
                ->all();

        $reactionsByMessage =
            empty($messageIds)
                ? collect()
                : DB::table(
                    'whisperly_message_reactions'
                )
                    ->whereIn(
                        'message_id',
                        $messageIds
                    )
                    ->get([
                        'message_id',
                        'user_id',
                        'emoji'
                    ])
                    ->groupBy(
                        fn (
                            $reaction
                        ) =>
                            (string)
                                $reaction->message_id
                    );

        $result =
            $messages
                ->map(
                    function (
                        $message
                    ) use (
                        $user,
                        $reactionsByMessage
                    ) {

                        $isMine =
                            (string)
                                $message->sender_id
                            ===
                            (string)
                                $user->id;

                        $messageReactions =
                            $reactionsByMessage
                                ->get(
                                    (string)
                                        $message->id,
                                    collect()
                                )
                                ->map(
                                    function (
                                        $reaction
                                    ) {

                                        return [
                                            'user_id' =>
                                                (string)
                                                    $reaction
                                                        ->user_id,

                                            'emoji' =>
                                                (string)
                                                    $reaction
                                                        ->emoji,
                                        ];
                                    }
                                )
                                ->values()
                                ->all();

                        return [
                            'id' =>
                                (string)
                                    $message->id,

                            'sender_id' =>
                                (string)
                                    $message->sender_id,

                            'sender_name' =>
                                $message
                                    ->sender
                                    ?->username
                                ??
                                (
                                    $isMine
                                        ? 'Anda'
                                        : 'User'
                                ),

                            'message' =>
                                $message->message,

                            'image_url' =>
                                $message->image_path
                                    ? asset(
                                        'storage/'
                                        .
                                        $message
                                            ->image_path
                                    )
                                    : null,

                            'time' =>
                                $message
                                    ->created_at
                                    ? $message
                                        ->created_at
                                        ->format('H:i')
                                    : '',

                            'created_at' =>
                                $message
                                    ->created_at
                                    ? $message
                                        ->created_at
                                        ->toIso8601String()
                                    : null,

                            'is_read' =>
                                (bool) (
                                    $message
                                        ->is_read
                                    ?? false
                                ),

                            'reactions' =>
                                $messageReactions,
                        ];
                    }
                )
                ->values();

        return response()->json([
            'messages' =>
                $result,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | REACTION PESAN
    |--------------------------------------------------------------------------
    */

    public function react(
        Request $request,
        WhisperlyBooking $booking,
        string $message
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

        $messageModel =
            $this->findRoomMessage(
                $user,
                $booking,
                $message
            );

        abort_unless(
            $messageModel,
            404
        );

        $validated =
            $request->validate([
                'emoji' =>
                    [
                        'nullable',
                        'string',
                        'max:20'
                    ],
            ]);

        $emoji =
            trim(
                (string)
                    (
                        $validated['emoji']
                        ?? ''
                    )
            );

        if (
            $emoji === ''
        ) {

            DB::table(
                'whisperly_message_reactions'
            )
                ->where(
                    'message_id',
                    (string)
                        $messageModel->id
                )
                ->where(
                    'user_id',
                    (string)
                        $user->id
                )
                ->delete();

        } else {

            DB::table(
                'whisperly_message_reactions'
            )->updateOrInsert(
                [
                    'message_id' =>
                        (string)
                            $messageModel->id,

                    'user_id' =>
                        (string)
                            $user->id,
                ],
                [
                    'emoji' =>
                        $emoji,

                    'updated_at' =>
                        now(),

                    'created_at' =>
                        now(),
                ]
            );
        }

        return response()->json([
            'ok' =>
                true,

            'message_id' =>
                (string)
                    $messageModel->id,

            'reactions' =>
                $this->getMessageReactions(
                    $messageModel->id
                ),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE MESSAGE
    |--------------------------------------------------------------------------
    */

    public function deleteMessage(
        Request $request,
        WhisperlyBooking $booking,
        string $message
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

        $messageModel =
            $this->findRoomMessage(
                $user,
                $booking,
                $message
            );

        abort_unless(
            $messageModel,
            404
        );

        $isMine =
            (string)
                $messageModel->sender_id
            ===
            (string)
                $user->id;

        if ($isMine) {

            /*
            |--------------------------------------------------------------------------
            | PESAN SENDIRI: HAPUS UNTUK SEMUA
            |--------------------------------------------------------------------------
            */

            DB::table(
                'whisperly_message_reactions'
            )
                ->where(
                    'message_id',
                    (string)
                        $messageModel->id
                )
                ->delete();

            DB::table(
                'whisperly_message_user_deletions'
            )
                ->where(
                    'message_id',
                    (string)
                        $messageModel->id
                )
                ->delete();

            if (
                ! empty(
                    $messageModel->image_path
                )
            ) {

                Storage::disk(
                    'public'
                )->delete(
                    $messageModel->image_path
                );
            }

            $messageModel->delete();

            return response()->json([
                'ok' =>
                    true,

                'message_id' =>
                    (string)
                        $messageModel->id,

                'scope' =>
                    'everyone',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PESAN LAWAN: HANYA SEMBUNYIKAN UNTUK USER INI
        |--------------------------------------------------------------------------
        */

        DB::table(
            'whisperly_message_user_deletions'
        )->updateOrInsert(
            [
                'message_id' =>
                    (string)
                        $messageModel->id,

                'user_id' =>
                    (string)
                        $user->id,
            ],
            [
                'created_at' =>
                    now(),

                'updated_at' =>
                    now(),
            ]
        );

        return response()->json([
            'ok' =>
                true,

            'message_id' =>
                (string)
                    $messageModel->id,

            'scope' =>
                'me',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | FIND ROOM MESSAGE
    |--------------------------------------------------------------------------
    */

    private function findRoomMessage(
        pengguna $user,
        WhisperlyBooking $booking,
        string $messageId
    ) {

        $roomBookingsQuery =
            WhisperlyBooking::query()
                ->with(
                    'conversation'
                );

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

        } else {

            return null;
        }

        foreach (
            $roomBookingsQuery->get()
            as $roomBooking
        ) {

            $conversation =
                $roomBooking->conversation;

            if (! $conversation) {
                continue;
            }

            $found =
                $conversation
                    ->messages()
                    ->whereKey(
                        $messageId
                    )
                    ->first();

            if ($found) {
                return $found;
            }
        }

        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | GET MESSAGE REACTIONS
    |--------------------------------------------------------------------------
    */

    private function getMessageReactions(
        $messageId
    ): array {

        return DB::table(
            'whisperly_message_reactions'
        )
            ->where(
                'message_id',
                (string)
                    $messageId
            )
            ->orderBy(
                'created_at'
            )
            ->get([
                'user_id',
                'emoji'
            ])
            ->map(
                function (
                    $reaction
                ) {

                    return [
                        'user_id' =>
                            (string)
                                $reaction->user_id,

                        'emoji' =>
                            (string)
                                $reaction->emoji,
                    ];
                }
            )
            ->values()
            ->all();
    }


    /*
    |--------------------------------------------------------------------------
    | STORE MESSAGE
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        WhisperlyBooking $booking
    ): RedirectResponse|JsonResponse {

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

        $request->validate([
            'message' => [
                'nullable',
                'string',
                'max:2000',
                'required_without:image',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:5120',
            ],
        ]);

        if (
            ! $request->filled('message')
            &&
            ! $request->hasFile('image')
        ) {

            if (
                $request->expectsJson()
            ) {

                return response()->json([
                    'ok' =>
                        false,

                    'message' =>
                        'Pesan atau foto wajib diisi.',
                ], 422);
            }

            return redirect()
                ->route(
                    'whisperly.chat.show',
                    $booking->id
                )
                ->with(
                    'message_error',
                    'Pesan atau foto wajib diisi.'
                );
        }

        $booking->syncChatStatus();

        $chatStatus =
            $this->chatState(
                $booking
            );

        if (
            $chatStatus !== 'active'
        ) {

            if (
                $request->expectsJson()
            ) {

                return response()->json([
                    'ok' =>
                        false,

                    'expired' =>
                        true,

                    'status' =>
                        $chatStatus,

                    'message' =>
                        'Waktu booking telah selesai. Chat sudah ditutup.',
                ], 409);
            }

            return redirect()
                ->route(
                    'whisperly.chat.show',
                    $booking->id
                )
                ->with(
                    'booking_expired',
                    true
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CONVERSATION
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
                            'active',
                    ]
                );

        /*
        |--------------------------------------------------------------------------
        | SIMPAN PESAN
        |--------------------------------------------------------------------------
        */

        $message =
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

        /*
        |--------------------------------------------------------------------------
        | RESTORE ROOM SETELAH PESAN BARU
        |--------------------------------------------------------------------------
        |
        | Jika room sebelumnya dihapus/diarsipkan, pesan baru harus
        | membuat room aktif kembali untuk pengirim dan penerima.
        | Dengan begitu index/updates dapat menampilkan room kembali
        | tanpa logout, login, atau Tinker.
        |--------------------------------------------------------------------------
        */

        $contactUserId =
            $this->contactUserId(
                $user,
                $booking
            );

        if ($contactUserId) {

            WhisperlyChatUserState::updateOrCreate(
                [
                    'user_id' =>
                        $user->id,

                    'contact_user_id' =>
                        $contactUserId,
                ],
                [
                    'deleted_at' =>
                        null,

                    'archived_at' =>
                        null,
                ]
            );

            WhisperlyChatUserState::updateOrCreate(
                [
                    'user_id' =>
                        $contactUserId,

                    'contact_user_id' =>
                        $user->id,
                ],
                [
                    'deleted_at' =>
                        null,

                    'archived_at' =>
                        null,
                ]
            );
        }

        if (
            $request->hasFile('image')
        ) {

            $imagePath =
                $request
                    ->file('image')
                    ->store(
                        'whisperly/chat-images',
                        'public'
                    );

            $message->image_path =
                $imagePath;

            $message->save();
        }

        $message->load(
            'sender'
        );

        /*
        |--------------------------------------------------------------------------
        | AJAX / REALTIME
        |--------------------------------------------------------------------------
        */

        if (
            $request->expectsJson()
        ) {

            return response()->json([
                'ok' =>
                    true,

                'message' => [
                    'id' =>
                        (string)
                            $message->id,

                    'sender_id' =>
                        (string)
                            $message->sender_id,

                    'sender_name' =>
                        $message
                            ->sender
                            ?->username
                        ??
                        'Anda',

                    'message' =>
                        $message->message,

                    'image_url' =>
                        $message->image_path
                            ? asset(
                                'storage/'
                                .
                                $message
                                    ->image_path
                            )
                            : null,

                    'time' =>
                        $message->created_at
                            ? $message
                                ->created_at
                                ->format('H:i')
                            : '',

                    'created_at' =>
                        $message->created_at
                            ? $message
                                ->created_at
                                ->toIso8601String()
                            : null,

                    'is_read' =>
                        (bool) (
                            $message
                                ->is_read
                            ?? false
                        ),

                    'reactions' =>
                        [],
                ],
            ]);
        }

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
                $request->boolean(
                    'typing'
                )
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
                ? $booking
                    ->talent
                    ?->pengguna
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

        return $user->role === 'user'
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
        WhisperlyBooking $booking,
        bool $restoreForNewBooking = false
    ): ?WhisperlyChatUserState {

        $contactUserId =
            $this->contactUserId(
                $user,
                $booking
            );

        if (! $contactUserId) {
            return null;
        }

        $state =
            WhisperlyChatUserState::firstOrCreate([
                'user_id' =>
                    $user->id,

                'contact_user_id' =>
                    $contactUserId,
            ]);

        /*
        |--------------------------------------------------------------------------
        | RESTORE ROOM JIKA ADA BOOKING BARU
        |--------------------------------------------------------------------------
        */

        if (
            $restoreForNewBooking
        ) {

            $bookingCreatedAt =
                $booking->created_at;

            $deletedAt =
                $state->deleted_at;

            $archivedAt =
                $state->archived_at;

            $wasDeletedBeforeBooking =
                $deletedAt
                &&
                $bookingCreatedAt
                &&
                Carbon::parse(
                    $bookingCreatedAt
                )->gt(
                    Carbon::parse(
                        $deletedAt
                    )
                );

            $wasArchivedBeforeBooking =
                $archivedAt
                &&
                $bookingCreatedAt
                &&
                Carbon::parse(
                    $bookingCreatedAt
                )->gt(
                    Carbon::parse(
                        $archivedAt
                    )
                );

            /*
            | Jika room sudah dihapus, tetapi setelah itu ada pesan baru
            | pada conversation yang sama, room wajib muncul kembali.
            | Ini juga menangani pesan baru dari lawan chat, bukan hanya
            | pesan yang dikirim oleh user yang menghapus room.
            */
            $hasNewMessageAfterDelete = false;

            if ($deletedAt) {

                $latestMessage =
                    $booking
                        ->conversation()
                        ->with('messages')
                        ->first()?->messages
                        ?->sortByDesc('created_at')
                        ->first();

                $hasNewMessageAfterDelete =
                    $latestMessage?->created_at
                    &&
                    Carbon::parse(
                        $latestMessage->created_at
                    )->gt(
                        Carbon::parse($deletedAt)
                    );
            }

            if (
                $wasDeletedBeforeBooking
                ||
                $wasArchivedBeforeBooking
                ||
                $hasNewMessageAfterDelete
            ) {

                $state->update([
                    'deleted_at' =>
                        null,

                    'archived_at' =>
                        null,
                ]);
            }
        }

        return $state;
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
            (string)
                $booking->pengguna_id
                !==
            (string)
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
                (string)
                    $booking->talent_id
                    !==
                (string)
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

        $timezone =
            'Asia/Jakarta';

        $now =
            now()->setTimezone(
                $timezone
            );

        /*
        |--------------------------------------------------------------------------
        | GUNAKAN TANGGAL SCHEDULE ASLI
        |--------------------------------------------------------------------------
        */

        $scheduleDate =
            Carbon::parse(
                $booking
                    ->schedule
                    ->date,
                $timezone
            )->toDateString();

        $start =
            Carbon::parse(
                $scheduleDate
                . ' '
                . $booking
                    ->schedule
                    ->start_time,
                $timezone
            );

        $end =
            Carbon::parse(
                $scheduleDate
                . ' '
                . $booking
                    ->schedule
                    ->end_time,
                $timezone
            );

        /*
        |--------------------------------------------------------------------------
        | LEWAT TENGAH MALAM
        |--------------------------------------------------------------------------
        */

        if (
            $end->lt($start)
        ) {

            $end->addDay();
        }

        /*
        |--------------------------------------------------------------------------
        | BELUM MULAI
        |--------------------------------------------------------------------------
        */

        if (
            $now->lt($start)
        ) {

            return 'upcoming';
        }

        /*
        |--------------------------------------------------------------------------
        | SUDAH SELESAI
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | SEDANG AKTIF
        |--------------------------------------------------------------------------
        */

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
    | PESAN STATUS
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
                (
                    $booking
                        ->schedule
                        ?->start_time
                    ?? ''
                )
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