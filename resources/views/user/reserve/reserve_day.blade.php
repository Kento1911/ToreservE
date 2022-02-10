<x-app-layout>
<main class="bg-gray-200 lg:container mx-auto">
        <div class="bg-gray-200 ">
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
                <form method="POST" action="{{ route('user.reserve_confirm') }}">
                    @csrf
                    <div class="container mx-auto max-w-4xl bg-white rounded-lg mt-3 shadow-md">
                        <input name="daydata" value="{{ $daydata }}" type="hidden">
                        <input name="plan_id" value="{{ $plan->id }}" type="hidden">
                        <div class="md:flex md:justify-center ">
                            <div class="mt-3 p-4 md:w-full">
                                <label class="text-md block px-3" for="">開始時間<span class="text-sm text-red-500">(必須事項)</span></label>
                                <select name="time" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm sm:text-sm" required>
                                    @foreach($select_times as $select_time)
                                        <option value="{{ $select_time->id }}">{{ $select_time->hour }}:{{ $select_time->minute }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3 p-4 md:w-full">
                                <label class="text-md block px-3" for="">実施エリア<span class="text-sm text-red-500">(必須事項)</span></label>
                                <select name="area" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm sm:text-sm" required>
                                    @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-3 bg-white p-4 rounded-lg">
                            <label class="px-3 text-md text-left block" for="">何かご要望があれば、記入をお願い致します。<span class="text-sm text-red-500">(必須事項)</span></label>
                            <textarea class="w-full border border-teal-500 rounded-lg focus:border-3 outline-none p-3" name="comment" id="" rows="10" placeholder="例:複数人(具体的な人数)で行いたい。〜のスタジオで行いたい等。" required></textarea>
                        </div>
                    </div>
                    <div class="flex flex-row justify-center mt-4 py-3">
                        <button type="button" onclick=history.back() class="bg-white text-red-500 border border-red-500 py-3 px-6 rounded-lg mr-3 hover:bg-red-200 md:mr-10 md:w-1/6">戻る</button>
                        <button type="submit" class="bg-teal-500 text-white py-3 px-6 rounded-lg font-bold hover:bg-teal-300 md:w-1/6">予約確認</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</x-app-layout>