<x-app-layout>
    <div class="min-h-screen bg-gray-200">    
        <main class="bg-gray-200 lg:container mx-auto">
            <div class="bg-gray-200">
                <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-28 pb-8">
                    @foreach($schedules as $schedule)
                        @if($schedule->state_flg === 0)
                            <div x-data="{ info:true }" class="flex justify-end">
                                <div x-show="info" class="p-4 bg-red-300 text-red-700 text-center rounded-2xl">
                                    未確認の予約がございます。
                                </div>
                                <button x-show="info" class="self-start" @click="info = false">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>
                            @php
                            break
                            @endphp
                        @endif
                    @endforeach
                    <div class="flex flex-row text-gray-700 font-bold text-tile mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        月間データ
                    </div>
                    <div class="grid grid-cols-2 justify-around w-full gap-1 mt-2">
                        <div class="bg-white p-4 shadow-lg rounded-lg shrink">
                            <h1 class="flex text-gray-700 font-bold text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8l3 5m0 0l3-5m-3 5v4m-3-5h6m-6 3h6m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                売上
                            </h1>
                            <div class="text-sky-800 font-bold text-3xl text-center">
                                {{ $total_price }}
                                <p class="inline text-gray-700 text-sm">円</p>
                            </div>
                        </div>
                        <div class="bg-white p-4 shadow-lg rounded-lg shrink">
                            <h1 class="flex text-gray-700 font-bold text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                トレーニング件数
                            </h1>
                            <div class="text-sky-800 font-bold text-3xl text-center">
                                {{ $schedule_count }}
                                <p class="inline text-gray-700 text-sm">件</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row text-gray-700 font-bold text-tile md:mb-3 mt-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        予約一覧
                    </div>
                    <div x-data="{ open_confirm : false, schedule_id : '' }" >
                    @foreach($schedules as $schedule)
                        @if($schedule->state_flg === 3)
                        <div class="max-w-full bg-white flex flex-col rounded overflow-hidden shadow-lg mt-3">
                            <div class="flex flex-row items-baseline flex-nowrap bg-teal-600 p-2">
                                <h1 class="ml-2 uppercase font-normal text-white">予約日</h1>
                                <p class="ml-2 font-bold text-white">{{ $schedule->date }}</p>
                            </div>
                            <div class="mt-2 flex sm:flex-row mx-6 sm:justify-between flex-no-wrap">
                                <div class="flex flex-row place-items-center p-2">
                                    <img class="w-10 h-10" style="opacity: 1; transform-origin: 0% 50% 0px; transform: none;" />
                                    <div class="flex flex-col ml-2">
                                        @foreach( $schedule->user as $user )
                                        <p class="text-md text-gray-500 ">{{ $user->name }}</p>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="flex flex-col p-2">
                                    @foreach($schedule->time as $time)
                                        <p class="text-gray-500">開始:<span class="font-bold">{{ $time->hour }}:{{ $time->minute }}</span></p>
                                    @endforeach
                                    @foreach($schedule->plan as $plan)
                                        <p class="text-gray-500 font-bold">{{ $plan->plan_name }}</p>
                                    @endforeach
                                    @foreach($schedule->area as $area)
                                        <p class="text-gray-500">{{ $area->name }}</p>
                                    @endforeach
                                </div>
                                <div class="flex flex-col flex-wrap p-2">
                                    @foreach($schedule->plan as $plan)
                                        <p class="text-gray-500"><span class="font-bold">{{ $plan->time }}</span>分</p>
                                        <p class="text-gray-500 mt-5"><span class="font-bold">{{ $plan->price }}</span>円</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-4 bg-gray-100 flex flex-row justify-around md:justify-end">
                                <div class="md:border-l-2 mx-6 md:border-dotted flex flex-row py-4">
                                    <a href="{{ route('trainer.schedule.unapproved_detail',['schedule' => $schedule]) }}" class="w-32 h-11 flex border border-gray-700 text-gray-700 hover:bg-gray-50 mx-2 justify-center place-items-center rounded-lg"><div class="">詳細</div></a>
                                </div>
                                <div class="mx-6 flex flex-row py-4">
                                    <input type="button" @click="open_confirm = true, schedule_id = {{ $schedule->id }}" value="完了" href="#" class="w-32 h-11 flex border-solid border text-white bg-green-800 hover:bg-green-600 mx-2 justify-center place-items-center rounded-lg">
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    <form method="POST" action="{{ route('trainer.schedule.comfirm') }}">
                        @csrf
                        <input type="hidden" name="schedule_id" :value="schedule_id">
                        <div class="fixed  bottom-0 left-0 w-full flex min-h-screen items-center justify-center" style="background-color: rgba(0,0,0,.5);" x-show="open_confirm" x-cloak>
                            <div class="text-left w-3/4 bg-white h-auto p-4 md:max-w-xl md:px-8 md:py-6 lg:px-12 lg:py-8 shadow-xl rounded-lg mx-2 md:mx-0" @click.away="open_confirm = false">
                                <h2 class="border-b-2 text-2xl text-green-800 text-center">完了</h2>
                                <p class="mt-8 text-xl">この予約を完了処理致しますが、宜しいでしょうか？</p>
                                <p class="mt-8 text-red-600 text-lg font-bold">記録一覧より、フィードバックの記入をお願い致します。</p>
                                <div class="flex flex-row justify-center mt-10 py-3">
                                    <button type="button" @click ="open_confirm = false" class="bg-white text-gray-500 border border-gray-500 py-2 px-4 rounded-lg mr-5 hover:bg-gray-200 md:mr-10">戻る</button>
                                    <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-lg font-bold hover:bg-green-600">完了</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                </section>
            </div>
            <div>
            {{ $schedules->links() }}
            </div>
        </main>
    </div>
</x-app-layout>