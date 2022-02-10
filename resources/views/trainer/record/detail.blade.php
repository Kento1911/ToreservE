<x-app-layout>
    <div x-data="{ open_cancel : false }" class="min-h-screen bg-gray-200">    
        <main class="bg-gray-200 lg:container mx-auto">
            <div class="bg-gray-200">
                <section class="mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-8">
                    <div class="bg-white w-full rounded-lg shadow-md mt-5">
                        <div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    ユーザー名
                                </p>
                                @foreach($schedule->user as $user)
                                <p>
                                    {{ $user->name }}
                                </p>
                                @endforeach
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    プラン名
                                </p>
                                @foreach($schedule->plan as $plan)
                                    <p>{{ $plan->plan_name }}</h2>
                                @endforeach
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    時間
                                </p>
                                @foreach($schedule->plan as $plan)
                                    <p>{{ $plan->time }} 分</p>
                                @endforeach
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    日時
                                </p>
                                @foreach($schedule->time as $time)
                                <p>
                                    {{ $schedule->date }}&emsp;&emsp;{{ $time->hour }}:{{ $time->minute }}
                                </p>
                                @endforeach
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    選択エリア
                                </p>
                                @foreach($schedule->area as $area)
                                <p>
                                    {{ $area->name }}
                                </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if(!is_null($record))
                        <div class="md:grid md:grid-cols-2 gap-5 w-full mt-5">
                            <div class="bg-white rounded-lg shadow-md p-4">
                                <label for="" class="block text-sm text-gray-700">
                                    メニュー
                                </label>
                                <div class="text-lg text-gray-700">
                                    {!! nl2br(e($record->menu)) !!}
                                </div>
                            </div>
                            <div class="bg-white rounded-lg shadow-md p-4 mt-3 md:mt-0">
                                <label for="" class="block text-sm text-gray-700">
                                    アドバイス
                                </label>
                                <div class="text-lg text-gray-700">
                                    {!! nl2br(e($record->feedback)) !!}
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center mt-5">
                            <button type="button" onclick=history.back() class="bg-white text-gray-500 border border-gray-500 py-3 px-6 rounded-lg mr-3 hover:bg-gray-200 md:mr-10 shadow-lg">戻る</button>
                            <a href="{{ route('trainer.record.edit_form',['schedule' => $schedule]) }}" class="border border-teal-700 bg-teal-700 text-white hover:bg-teal-600 rounded-lg py-3 px-6 shadow-lg">
                                <div class="flex flex-row items-center">
                                    編集
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="flex justify-center mt-5">
                            <button type="button" onclick=history.back() class="bg-white text-gray-500 border border-gray-500 py-3 px-6 rounded-lg mr-3 hover:bg-gray-200 md:mr-10 shadow-lg">戻る</button>
                            <a href="{{ route('trainer.record.record_form',['schedule' => $schedule]) }}" class="border border-teal-700 bg-teal-700 text-white hover:bg-teal-600 rounded-lg py-3 px-6 shadow-lg">
                                <div class="flex flex-row items-center">
                                    記録作成
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    @endif
                </section>
            </div>
        </main>
    </div>
</x-app-layout>