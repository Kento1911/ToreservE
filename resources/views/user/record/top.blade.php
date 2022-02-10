<x-app-layout>
    <main class="bg-gray-200">
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 pt-32 pb-16">
            <div class="p-4">
                <div class="flex flex-row text-gray-700 font-bold text-tile mb-1 md:mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    トレーニング記録一覧
                </div>
                <form method="POST" action="{{ route('user.record.research') }}">
                    @csrf
                    <div class='max-w-lg mx-auto flex md:flex-row flex-col justify-between items-center'>
                        <div class="flex items-center w-full h-12 rounded-lg focus-within:shadow-lg focus-within:border border-teal-500 bg-white overflow-hidden">
                            <input name="name" class="h-full w-full focus:outline-none border-0 text-sm text-gray-700 pr-2 focus:ring-teal-500" type="text" placeholder="ユーザー名を入力して下さい" value="{{ old('name') }}"/> 
                            <button type="submit" class="grid place-items-center h-full w-12 text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-3 md:mt-0 h-12 w-full">
                            <select class="md:ml-4 border-0 rounded-lg h-full w-full focus:outline-none focus:ring-teal-500 focus:shadow-lg" name="sort_order">
                                <option value=0>選択して下さい</option>
                                <option value="old">トレーニング日の古い順</option>
                                <option value="new">トレーニング日の新しい順</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div>
                    @foreach($schedules as $schedule)
                        <div class="max-w-full bg-white flex flex-col rounded overflow-hidden shadow-lg mt-5">
                            <div class="flex flex-row items-baseline flex-nowrap bg-teal-600 p-2">
                                <h1 class="ml-2 uppercase font-normal text-white">実施日</h1>
                                <p class="ml-2 font-bold text-white">{{ $schedule->date }}</p>
                            </div>
                            <div class="mt-2 flex sm:flex-row mx-6 sm:justify-between flex-wrap ">
                                <div class="flex flex-row place-items-center p-2">
                                    @foreach( $schedule->trainer as $trainer )
                                        <img class="h-20 " src="{{ asset($trainer->TrainerProfile->profile_image) }}" style="opacity: 1; transform-origin: 0% 50% 0px; transform: none;"/>
                                        <div class="flex flex-col ml-2">
                                            <p class="text-md text-gray-500 ">{{ $trainer->name }}</p>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="flex flex-col p-2">
                                    @foreach($schedule->plan as $plan)
                                        <p class="text-gray-500 font-bold">{{ $plan->plan_name }}</p>
                                    @endforeach
                                    @foreach($schedule->plan as $plan)
                                        <p class="text-gray-500"><span class="font-bold">{{ $plan->time }}</span>分</p>
                                    @endforeach
                                    @foreach($schedule->area as $area)
                                        <p class="text-gray-500">{{ $area->name }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-4 bg-gray-100 flex flex-row justify-around md:justify-end">
                                <div class="md:border-l-2 mx-6 md:border-dotted flex flex-row py-4">
                                    <a href="{{ route('user.record.detail',['schedule' => $schedule]) }}" class="w-32 h-11 flex border border-gray-700 text-gray-700 hover:bg-gray-50 mx-2 justify-center place-items-center rounded-lg"><div class="">詳細</div></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div>
            {{ $schedules->links() }}
        </div>
    </main>
</x-app-layout>