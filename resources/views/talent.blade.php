<!-- =====================================================
     SCHEDULE
====================================================== -->

<div class="section">

    <h3 class="section-title">

        Jadwal Saya

    </h3>


    <div class="schedule">

        @forelse($talent->schedules as $schedule)

            @php
                $status = $schedule->resolveStatusForDate(
                    now(config('app.timezone'))->toDateString()
                );
            @endphp

            <div class="slot">

                <span class="time">

                    {{ substr($schedule->start_time, 0, 5) }}

                    -

                    {{ substr($schedule->end_time, 0, 5) }}

                </span>


                <span class="status {{ $status }}">

                    {{ ucfirst($status) }}

                </span>

            </div>

        @empty

            <div class="slot">

                <span class="time">

                    Belum ada jadwal

                </span>

            </div>

        @endforelse

    </div>

</div>