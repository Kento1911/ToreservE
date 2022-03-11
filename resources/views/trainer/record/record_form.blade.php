<x-app-layout>
    <div class="min-h-screen bg-gray-200">    
        <main class="bg-gray-200 lg:container mx-auto">
            <div class="bg-gray-200">
                <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-8">
                    <form method="POST" action="{{ route('trainer.record.post_record',['schedule' => $schedule]) }}">
                        @csrf
                        <div class="p-4 bg-white rounded-lg shadow-lg">
                            <div class="text-center text-gray-700 text-xl font-bold text-tile mt-5">トレーニング記録</div>
                            @if ($errors->any())
                                <div class="p-4 mb-4 alert alert-danger mt-3 bg-red-100 text-red-600 rounded-lg">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="flex flex-col">
                                <div class="w-full mt-5">
                                    <label for="" class="ml-2 block">実施メニュー</label>
                                    <textarea name="menu" id="" cols="30" rows="3" class="w-full rounded-lg border border-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required></textarea>
                                </div>
                                <div class="w-full mt-3">
                                    <label for=""  class="ml-2 block">アドバイス</label>
                                    <textarea name="feedback" id="" cols="30" rows="10" class="w-full rounded-lg border border-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center mt-5">
                            <button type="button" onclick=history.back() class="bg-white text-gray-500 border border-gray-500 py-3 px-6 rounded-lg mr-3 hover:bg-gray-200 md:mr-10 shadow-lg">戻る</button>
                            <button type="submit" class="text-white border border-green-800 bg-green-800 py-3 px-6 rounded-lg mr-3 hover:bg-green-600 md:mr-10 shadow-lg">投稿</button>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>
</x-app-layout>