<x-app-layout>
    <main class="bg-gray-200">
        <section class="max-w-11/12 mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-16">
            <!-- component -->
            <div class="flex bg-gray-200 items-center justify-center">
                <div class="grid bg-white rounded-md shadow-sm w-11/12 md:w-9/12 lg:w-1/2 px-5">
            
                    <div class="flex justify-center">
                        <div class="flex">
                            <h1 class="text-gray-600 font-bold md:text-2xl text-xl pt-8 pb-5">プラン追加</h1>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <div class="flex">
                            <x-auth-validation-errors class="mb-4" :error="$errors"/>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('trainer.profile.store_plan',['profile' => $profile]) }}">
                        @csrf
                        @if ($errors->any())
                            <div class="p-4 mb-4 alert alert-danger mt-3 bg-red-100 text-red-600 rounded-lg">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
        
                        <div x-data="planAdd()"> 
                            <div class="grid grid-cols-1 mt-5 border-t border-gray-200">
                                <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">プラン名</label>
                                <input name="plan_name[]" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text" placeholder="プラン名を入力して下さい" required />
                                <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-3">金額</label>
                                <div class="inline-block">
                                    <input name="price[]" class="md:w-11/12 py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text" placeholder="金額を入力して下さい" required />
                                    <div class="inline select-none">円</div>
                                </div>
                                <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">時間</label>
                                <select name="time[]" class="md:w-11/12 py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                    <option value="60">60分</option>
                                    <option value="90">90分</option>
                                    <option value="120">120分</option>
                                    <option value="150">150分</option>
                                    <option value="180">180分</option>
                                    <option value="240">240分</option>
                                    <option value="300">300分</option>
                                </select>
                                <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-3">説明文</label>
                                <textarea name="introduction[]" x-model="plan.txt2" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="金額を入力して下さい" cols="30" rows="5" required></textarea>
                                <template x-for="(plan, index) in plans" :key="index">
                                    <div class="grid grid-cols-1 mt-5 border-t border-gray-200">
                                        <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">プラン名</label>
                                        <input name="plan_name[]" x-model="plan.txt1" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text" placeholder="プラン名を入力して下さい" required />
                                        <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-3">金額</label>
                                        <div class="inline-block">
                                            <input name="price[]" x-model="plan.txt2" class="md:w-11/12 py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text" placeholder="金額を入力して下さい" required />
                                            <div class="inline select-none">円</div>
                                        </div>
                                        <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">時間</label>
                                        <select name="time[]" x-model="plan.txt3" class="md:w-11/12 py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                            <option value="60">60分</option>
                                            <option value="90">90分</option>
                                            <option value="120">120分</option>
                                            <option value="150">150分</option>
                                            <option value="180">180分</option>
                                            <option value="240">240分</option>
                                            <option value="300">300分</option>
                                        </select>
                                        <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-3">説明文</label>
                                        <textarea name="introduction[]" x-model="plan.txt4" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="金額を入力して下さい" cols="30" rows="5" required></textarea>
                                        <div class="flex flex-row justify-self-end items-center">
                                            <button type="button" @click.prevent="removePlanForm(index)" class="mt-2 text-sm py-1 px-2  text-red-600 border border-red-600 rounded-lg" >
                                                削除
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                                <div class="flex flex-row justify-center items-center pt-3 mt-5">
                                    <button type="button" @click.prevent="addPlanForm" class="text-sm py-2 px-5 rounded-lg text-teal-600 border border-gray-300 hover:bg-gray-200">
                                        更に追加する
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                            <div>
                        </div>
                    
                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5 mt-5'>
                            <a href="{{ route('trainer.profile.index') }}" class='w-auto border border-red-600 hover:bg-red-100 rounded-lg shadow-md font-medium text-red-600 px-4 py-2'>キャンセル</a>
                            <button type="submit" class='w-auto bg-teal-600 hover:bg-teal-500 rounded-lg shadow-xl font-medium text-white px-4 py-2'>完了</button>
                        </div>
                    </form>
            
                </div>
            </div>
        </section>
    </main>
</x-app-layout>