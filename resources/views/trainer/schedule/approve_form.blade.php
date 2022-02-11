<x-app-layout>
    <main class="bg-gray-200 lg:container mx-auto">
        <div class="bg-gray-200">
            <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-8">
                @if (isset($message))
                    <div class="text-center text-red-600 text-xl bg-red-100 p-4 rounded-lg">
                        {{ $message }}
                    </div>
                @endif
                <div class="max-w-4xl bg-white w-full rounded-lg shadow-md mt-5">
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
                            <p>
                                {{ $plan->plan_name }}
                            </p>
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
                        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                            <p class="text-gray-600">
                                コメント
                            </p>
                            <p>
                                {!! nl2br(e($schedule->user_comment)) !!}
                            </p>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('trainer.schedule.approve',['schedule' => $schedule]) }}">
                    @csrf
                    @foreach($schedule->user as $user)
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                    @endforeach
                    <div class="max-w-4xl bg-white w-full shadow-md mt-5 p-5 rounded-lg">
                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                        <div>
                            <label class="block text-gray-700" for="">コメント</label>
                            <div class="flex justify-center">
                                <textarea name="comment" class="w-full border border-teal-500 rounded-lg block" id="" cols="30" rows="10" required placeholder="実施場所、注意事項等を記入願います。"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row justify-center mt-4 py-3">
                        <button type="button" onclick=history.back() class="bg-white text-red-500 border border-red-500 py-3 px-6 rounded-lg mr-3 hover:bg-red-200 md:mr-10">戻る</button>
                        <button type="submit" class="bg-teal-500 text-white py-3 px-6 rounded-lg font-bold hover:bg-teal-300">確定</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</x-app-layout>