<x-app-layout>
    <main class="bg-gray-200">
        <section class="max-w-11/12 mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-16">
            <!-- component -->
            <div class="flex bg-gray-200 items-center justify-center">
                <div class="grid bg-white rounded-md shadow-sm w-11/12 md:w-9/12 lg:w-1/2 px-5">
            
                    <div class="flex justify-center">
                        <div class="flex">
                            <h1 class="text-red-600 font-bold md:text-2xl text-xl pt-8 pb-5">注意</h1>
                        </div>
                    </div>

                    <div>
                        <p class="text-center">以下のプランを削除致しますが、宜しいですか。</p>
                    </div>

                    <div class="grid grid-cols-1 mt-5 border-t border-gray-200">
                        <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">プラン名</label>
                        <h1 class="py-2 px-3 text-xl border-b border-teal-600 mt-1">{{ $plan->plan_name }}</h1>
                        <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-3">金額</label>
                        <h1 class="py-2 px-3 text-xl border-b border-teal-600 mt-1">{{ $plan->price }}円</h1>
                        <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-3">時間</label>
                        <h1 class="py-2 px-3 text-xl border-b border-teal-600 mt-1">{{ $plan->time }}分</h1>
                        <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-3">説明文</label>
                        <h3 class="py-2 px-3 text-xl border-b border-teal-600 mt-1 ">{!! nl2br(e($plan->introduction)) !!}</h3>
                    <div>
                    
                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                        <a href="{{ route('trainer.profile.index') }}" class='w-auto font-medium px-4 py-2 hover:font-extrabold'>キャンセル</a>
                        <a href="{{ route('trainer.profile.destroy_plan',['plan' => $plan]) }}" class='w-auto bg-red-600 hover:bg-red-500 rounded-lg shadow-xl font-medium text-white px-4 py-2'>削除</a>
                    </div>
            
                </div>
            </div>
        </section>
    </main>
</x-app-layout>