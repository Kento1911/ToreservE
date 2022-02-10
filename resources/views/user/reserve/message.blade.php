<x-app-layout>
    <main class="bg-gray-200 lg:container mx-auto">
        <div class="bg-gray-200">
            <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-8">
                <div class="bg-white rounded-md shadow-md mx-auto px-5">
                    <h1 class="text-center text-2xl font-bold pt-10">予約完了</h1>

                    <p class="mt-20 text-center pb-20 tracking-wider leading-loose text-gray-700">
                        予約が完了致しました。<br/>
                        現在、トレーナーが実施場所の確保及び、スケジュールの確認を行なっております。<br/>
                        トレーナーからの連絡をお待ちください。
                    </p>
                </div>
                <div class="text-center mt-4 py-3">
                    <a href="{{ route('user.top') }}" class="border border-teal-500 text-teal-600 py-3 px-6 rounded-lg font-bold hover:bg-teal-50 md:w-1/6">トップに戻る</a>
                </div>
            </section>
        </div>
    </main>
</x-app-layout>