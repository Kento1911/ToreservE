<x-app-layout>
    <div class="min-h-screen bg-gray-200">    
        <main class="bg-gray-200 lg:container mx-auto">
            <div class="bg-gray-200">
                <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-28 pb-8">
                    <div class="flex flex-row text-gray-700 font-bold text-tile mb-1 md:mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        予約一覧
                    </div>
                    <div x-data="{ open_confirm : false, schedule_id : '' }" >
                        @foreach($schedules as $schedule)
                        <div class="max-w-full bg-white flex flex-col rounded-lg overflow-hidden shadow-lg mt-5">
                            <div class="flex flex-row items-baseline flex-nowrap bg-teal-600 p-2">
                                <h1 class="ml-2 uppercase font-normal text-white">予約日</h1>
                                <p class="ml-2 font-bold text-white">{{ $schedule->date }}</p>
                            </div>
                            <div class="mt-2 flex sm:flex-row mx-6 sm:justify-between flex-wrap ">
                                <div class="flex flex-row place-items-center p-2">
                                    @foreach( $schedule->trainer as $trainer )
                                        <img class="h-20 " src="{{ asset($trainer->TrainerProfile->profile_image) }}" style="opacity: 1; transform-origin: 0% 50% 0px; transform: none;" />
                                        <div class="flex flex-col ml-2">
                                            <p class="text-md text-gray-500 ">{{ $trainer->name }}</p>
                                        </div>
                                    @endforeach
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
                                    <a href="{{ route('user.schedule.detail',['schedule' => $schedule]) }}" class="w-32 h-11 flex border border-gray-700 text-gray-700 hover:bg-gray-50 mx-2 justify-center place-items-center rounded-lg"><div class="">詳細</div></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </main>
    </div>
</x-app-layout>