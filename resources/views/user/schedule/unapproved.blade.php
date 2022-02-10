<x-app-layout>
    <main class="bg-gray-200">
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 pt-32 pb-16">
            <body class="antialiased font-sans bg-gray-200">
                <div class="mx-auto px-4 sm:px-8">
                    <div class="py-4">
                        <div class="flex flex-row text-gray-700 font-bold text-tile mb-1 md:mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            未承待ち一覧
                        </div>
                        <div class="-mx-4 sm:-mx-8 py-4 overflow-x-auto">
                            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-4 border-b-2 border-gray-200 bg-teal-600 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                                予約日
                                            </th>
                                            <th
                                                class="px-4 py-4 border-b-2 border-gray-200 bg-teal-600 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                                エリア
                                            </th>
                                            <th
                                                class="px-4 py-4 border-b-2 border-gray-200 bg-teal-600 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                                プラン名
                                            </th>
                                            <th
                                                class="px-4 py-4 border-b-2 border-gray-200 bg-teal-600 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                                予約状況
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody">
                                        @foreach($schedules as $schedule)
                                            @if($schedule->state_flg === 0 || $schedule->state_flg === 1 || $schedule->state_flg === 2)
                                                <tr>
                                                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-md">
                                                        <a href="{{ route('user.schedule.detail',['schedule' => $schedule]) }}">
                                                            <p class="text-gray-900 text-center whitespace-nowrap">{{ $schedule->date }}</p>
                                                        </a>
                                                    </td>
                                                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-md">
                                                        <a href="{{ route('user.schedule.detail',['schedule' => $schedule]) }}">
                                                            @foreach($schedule->area as $area)
                                                                <p class="text-gray-900 text-center whitespace-nowrap">{{ $area->name }}</p>
                                                            @endforeach
                                                        </a>
                                                    </td>
                                                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-md">
                                                        <a href="{{ route('user.schedule.detail',['schedule' => $schedule]) }}">
                                                            @foreach($schedule->plan as $plan)
                                                                <p class="text-gray-900 text-center whitespace-nowrap">{{ $plan->plan_name }}</p>
                                                            @endforeach
                                                        </a>
                                                    </td>
                                                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-md text-center">
                                                        <a href="{{ route('user.schedule.detail',['schedule' => $schedule]) }}">
                                                        @if(!$schedule->schedule_comment->isEmpty())
                                                            @if($schedule->state_flg === 2)
                                                                <p class="text-blue-500 text-center whitespace-nowrap">返答待ち</p>
                                                            @elseif($schedule->state_flg === 1)
                                                                <p class="text-white bg-red-500 font-bold text-center whitespace-nowrap">返信あり</p>
                                                            @endif
                                                            @else
                                                                <p class="text-red-500 text-center whitespace-nowrap">未確認</p>
                                                            @endif
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                {{ $schedules->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </body>
        </section>
    </main>
</x-app-layout>