<x-app-layout>
    <div class="min-h-screen bg-gray-200">    
        <main class="bg-gray-200 lg:container mx-auto">
            <div class="bg-gray-200">
                @foreach($schedules as $schedule)
                    <section class="mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-8">
                        <div class="bg-white w-full rounded-lg shadow-md mt-5">
                            <div>
                                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                    <p class="text-gray-600">
                                        ユーザー名
                                    </p>
                                    @foreach($schedule->trainer as $trainer)
                                    <p>
                                        {{ $trainer->name }}
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
                        @if(!$records->isEmpty())
                            @foreach( $records as $record )
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
                            @endforeach
                        @else
                            <div class="bg-white rounded-lg shadow-lg p-4 mt-6">
                                <label for="" class="block">フィードバック</label>
                                <div class="border-b"></div>
                                <div class="text-center text-xl my-10">作成中</div>
                            </div>
                        @endif
                    </section>
                @endforeach
            </div>
        </main>
    </div>
</x-app-layout>