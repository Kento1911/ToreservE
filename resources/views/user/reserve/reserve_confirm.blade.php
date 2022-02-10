<x-app-layout>
    <main class="bg-gray-200 lg:container mx-auto">
        <div class="bg-gray-200">
            <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-8">
                <div class="snap-always snap-center p-4 bg-white rounded-lg shadow-md">
                    <div class="h-full p-6 rounded-lg border-2 border-teal-500 flex flex-col">
                        <h2 class="text-2xl tracking-widest title-font mb-1 font-medium">{{ $plan->plan_name }}</h2>
                        <h2 class="text-md tracking-widest title-font mb-1 font-medium">{{ $plan->time }} 分</h2>
                        <h1 class="text-3xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">{{ $plan->price }} 円</h1>
                        <p class="flex items-center text-gray-600 mb-5">
                            {!! nl2br(e($plan->introduction)) !!}
                        </p>
                    </div>
                </div>
                <form method="POST" action="{{ route('user.reserve_submit') }}">
                    @csrf
                    <div class="max-w-4xl bg-white w-full rounded-lg shadow-md mt-5">
                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                        <div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    日時
                                </p>
                                <p>
                                    {{ $month }}月{{ $day }}日&emsp;&emsp;{{ $time->hour }}:{{ $time->minute }}
                                </p>
                                <input type="hidden" name="daydata" value="{{ $daydata }}">
                                <input type="hidden" name="time_id" value="{{ $time->id }}">
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    選択エリア
                                </p>
                                <p>
                                    {{ $area->name }}
                                </p>
                                <input type="hidden" name="area_id" value="{{ $area->id }}">
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    コメント
                                </p>
                                <p>
                                    {!! nl2br(e($comment)) !!}
                                </p>
                                <input type="hidden" name="comment" value="{{ $comment }}">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row justify-center mt-4 py-3">
                        <button type="button" onclick=history.back() class="bg-white text-red-500 border border-red-500 py-3 px-6 rounded-lg mr-3 hover:bg-red-200 md:mr-10">戻る</button>
                        <button type="submit" class="bg-teal-500 text-white py-3 px-6 rounded-lg font-bold hover:bg-teal-300">予約</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</x-app-layout>