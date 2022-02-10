<x-app-layout>
    <main class="bg-gray-200">
        <section class="max-w-11/12 mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-16">
            <!-- component -->
            <div class="flex bg-gray-200 items-center justify-center ">
                <div class="grid bg-white rounded-md shadow-sm w-11/12 md:w-9/12 lg:w-1/2">
            
                    <div class="flex justify-center">
                        <div class="flex">
                            <h1 class="text-gray-600 font-bold md:text-2xl text-xl pt-8 pb-5">プラン編集</h1>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <div class="flex">
                            <x-auth-validation-errors class="mb-4" :error="$errors"/>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('trainer.profile.update_plan',['plan' => $plan]) }}">
                        @csrf
        
                            <div class="grid grid-cols-1 mt-5 border-t border-gray-200 px-3">
                                <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">トレーニングタイプ</label>
                                <input name="plan_name" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text"  required value="{{ $plan->plan_name }}"/>
                                <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-3">金額</label>
                                <input name="price" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text"  required value="{{ $plan->price }}"/>
                                <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-3">時間</label>
                                <select name="time" class="md:w-11/12 py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                    <option value="60">60分</option>
                                    <option value="90">90分</option>
                                    <option value="120">120分</option>
                                    <option value="150">150分</option>
                                    <option value="180">180分</option>
                                    <option value="240">240分</option>
                                    <option value="300">300分</option>
                                </select>
                                <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-3">説明文</label>
                                <textarea name="introduction" x-model="plan.txt2" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" cols="30" rows="5" required>{{ $plan->introduction }}</textarea>
                            <div>
                        
                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                            <a href="{{ route('trainer.profile.index') }}" class='w-auto border border-red-600 hover:bg-red-100 rounded-lg shadow-md font-medium text-red-600 px-4 py-2'>キャンセル</a>
                            <button type="submit" class='w-auto bg-teal-600 hover:bg-teal-500 rounded-lg shadow-xl font-medium text-white px-4 py-2'>完了</button>
                        </div>
                    </form>
            
                </div>
            </div>
        </section>
    </main>
</x-app-layout>