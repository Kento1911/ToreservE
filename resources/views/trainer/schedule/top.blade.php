<x-app-layout>
    <main class="bg-gray-200">
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 pt-32 pb-16">
            <div class="p-4">
                <div class="flex flex-row text-gray-700 font-bold text-tile mb-1 md:mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    予約一覧
                </div>
                <div x-data="{ open_confirm : false, schedule_id : '' }" >
                    @foreach($schedules as $schedule)
                        <div class="max-w-full bg-white flex flex-col rounded overflow-hidden shadow-lg mt-5">
                            <div class="flex flex-row items-baseline flex-nowrap bg-teal-600 p-2">
                                <h1 class="ml-2 uppercase font-normal text-white">予約日</h1>
                                <p class="ml-2 font-bold text-white">{{ $schedule->date }}</p>
                            </div>
                            <div class="mt-2 flex sm:flex-row mx-6 sm:justify-between flex-wrap ">
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
                    @endforeach
                    <form method="POST" action="{{ route('trainer.schedule.comfirm') }}">
                        @csrf
                        <input type="hidden" name="schedule_id" :value="schedule_id">
                        <div class="fixed  bottom-0 left-0 w-full flex min-h-screen items-center justify-center" style="background-color: rgba(0,0,0,.5);" x-show="open_confirm" x-cloak>
                            <div class="text-left w-2/3 bg-white h-auto p-4 md:max-w-xl md:px-8 md:py-6 lg:px-12 lg:py-8 shadow-xl rounded-lg mx-2 md:mx-0" @click.away="open_confirm = false">
                                <h2 class="text-2xl text-green-800 text-center">完了</h2>
                                <p class="mt-4">この予約を完了処理致しますが、宜しいでしょうか？</p>
                                <div class="flex flex-row justify-center mt-10 py-3">
                                    <button type="button" @click ="open_confirm = false" class="bg-white text-gray-500 border border-gray-500 py-2 px-4 rounded-lg mr-5 hover:bg-gray-200 md:mr-10">戻る</button>
                                    <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-lg font-bold hover:bg-green-600">完了</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <div>
            {{ $schedules->links() }}
        </div>
    </main>
</x-app-layout>
