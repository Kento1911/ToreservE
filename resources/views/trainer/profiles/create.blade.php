<x-app-layout>
    <main class="bg-gray-200">
        <section class="mx-auto pt-28 md:pt-32 pb-16">
            <!-- component -->
            <div class="flex bg-gray-200 items-center justify-center">
                <div class="grid bg-white rounded-md shadow-sm md:w-8/12 w-11/12">
            
                    <div class="flex justify-center">
                        <div class="flex flex-col">
                            <h1 class="text-center text-gray-600 font-bold md:text-2xl text-xl pt-8 pb-5">プロフィール編集</h1>
                            <p class="text-center text-red-600 texr-sm">全項目入力必須です</p>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <div class="flex">
                            <x-auth-validation-errors class="mb-4" :error="$errors"/>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('trainer.profile.store') }}" enctype="multipart/form-data">
                        @csrf
        
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">名前</label>
                            <input name="name" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text" placeholder="お名前を入力して下さい" required value="{{ old('name') }}"/>
                        </div>

                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">年齢</label>
                            <input name="age" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="number" max="100" step="1" placeholder="年齢を入力して下さい" required value="{{ old('age') }}" required/>
                        </div>
            
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">性別</label>
                            <select name="sex" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" value="{{ old('sex') }}">
                                <option value="0">男性</option>
                                <option value="1">女性</option>
                                <option value="9">無回答</option>
                            </select>
                        </div>
                       
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">紹介文</label>
                            <textarea name="profile_comment" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" cols="30" rows="15" required>{{ old('profile_comment') }}</textarea>
                        </div>

                        <div x-data="typeAdd()"> 
                            <div class="grid grid-cols-1 mt-5 mx-7 border-t border-gray-200">
                                <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">トレーニングタイプ<span class="text-sm text-red-600 font-light">(最大5つまで)</span></label>
                                <select name="type[]" x-model="type.Select" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                        <option hidden>選択して下さい</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <template x-for="(type, index) in types" :key="index">
                                    <div class="grid grid-cols-12 mt-3">
                                        <select name="type[]" x-model="type.Select" class="col-span-9 md:col-span-11  py-2 px-3 rounded-lg border border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                            <option hidden>選択して下さい</option>
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="flex flex-row justify-self-end items-center col-span-3 md:col-span-1">
                                            <button type="button" @click.prevent="removeTypeForm(index)" class="text-sm py-1 px-2  text-red-600" >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                                <div class="flex flex-row justify-center items-center pt-3">
                                    <button type="button" @click.prevent="addTypeForm" class="text-sm py-2 px-5 rounded-lg text-teal-600 border border-gray-300 hover:bg-gray-200">
                                        タイプを追加
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                            <div>
                        </div>

                        <div x-data="areaAdd()"> 
                            <div class="grid grid-cols-1 mt-5 border-t border-gray-200">
                                <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">エリア<span class="text-sm text-red-600 font-light">(最大5つまで)</span></label>
                                <select name="area[]" x-model="area.Select" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                    <option hidden>選択して下さい</option>
                                    @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>
                                <template x-for="(area, index) in areas" :key="index">
                                    <div class="grid grid-cols-12 mt-3">
                                        <select name="area[]" x-model="area.Select" class="col-span-9 md:col-span-11  py-2 px-3 rounded-lg border border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                            <option hidden>選択して下さい</option>
                                            @foreach($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="flex flex-row justify-self-end items-center col-span-3 md:col-span-1">
                                            <button type="button" @click.prevent="removeAreaForm(index)" class="text-sm py-1 px-2  text-red-600" >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                                <div class="flex flex-row justify-center items-center pt-3">
                                    <button type="button" @click.prevent="addAreaForm" class="text-sm py-2 px-5 rounded-lg text-teal-600 border border-gray-300 hover:bg-gray-200">
                                        エリアを追加
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                            <div>
                        </div>

                        <div class="grid grid-cols-1 mt-5 border-t border-gray-200">
                            <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">受付日時</label>
                            <table class="w-full mx-auto my-2 py-2">
                                <tr class="bg-teal-500 text-gray-600 uppercase text-md leading-normal">
                                    <th class="py-2 px-3">曜日</th>
                                    <td class="text-center font-bold">時間</td>
                                    <td class="text-center px-1 font-bold md:text-sm">定休日</td>
                                </tr>
                                
                                <tr class="border border-gray-200">
                                    <th class="py-4 px-1 md:px-5 text-lg ">月曜日</th>
                                    <td class="text-center text-xl">
                                        <select name="monday_open" class="border border-gray-300 rounded-md py-1 px-5 md:mr-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                        〜
                                        <select name="monday_close" class="border border-gray-300 rounded-md py-1 px-5 md:ml-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="monday_rest" value=0>
                                    </td>
                                </tr>
                                <tr class="border border-gray-200">
                                    <th class="py-4 px-1 md:px-5 text-lg">火曜日</th>
                                    <td class="text-center text-xl">
                                        <select name="tuesday_open" class="border border-gray-300 rounded-md py-1 px-5 md:mr-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                        〜
                                        <select name="tuesday_close" class="border border-gray-300 rounded-md py-1 px-5 md:ml-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="tuesday_rest" value=0>
                                    </td>
                                </tr>
                                <tr class="border border-gray-200">
                                    <th class="py-4 px-1 md:px-5 text-lg">水曜日</th>
                                    <td class="text-center text-xl">
                                        <select name="wednesday_open" class="border border-gray-300 rounded-md py-1 px-5 md:mr-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                        〜
                                        <select name="wednesday_close" class="border border-gray-300 rounded-md py-1 px-5 md:ml-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="wednesday_rest" value=0>
                                    </td>
                                </tr>
                                <tr class="border border-gray-200">
                                    <th class="py-4 px-1 md:px-5 text-lg">木曜日</th>
                                    <td class="text-center text-xl">
                                        <select name="thursday_open" class="border border-gray-300 rounded-md py-1 px-5 md:mr-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                        〜
                                        <select name="thursday_close" class="border border-gray-300 rounded-md py-1 px-5 md:ml-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="thursday_rest" value=0>
                                    </td>
                                </tr>
                                <tr class="border border-gray-200">
                                    <th class="py-4 px-1 md:px-5 text-lg">金曜日</th>
                                    <td class="text-center text-xl">
                                        <select name="friday_open" class="border border-gray-300 rounded-md py-1 px-5 md:mr-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                        〜
                                        <select name="friday_close" class="border border-gray-300 rounded-md py-1 px-5 md:ml-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="friday_rest" value=0>
                                    </td>
                                </tr>
                                <tr class="border border-gray-200">
                                    <th class="py-4 px-1 md:px-5 text-lg">土曜日</th>
                                    <td class="text-center text-xl">
                                        <select name="saturday_open" class="border border-gray-300 rounded-md py-1 px-5 md:mr-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                        〜
                                        <select name="saturday_close" class="border border-gray-300 rounded-md py-1 px-5 md:ml-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="saturday_rest" value=0>
                                    </td>
                                </tr>
                                <tr class="border border-gray-200">
                                    <th class="py-4 px-1 md:px-5 text-lg">日曜日</th>
                                    <td class="text-center text-lg">
                                        <select name="sunday_open" class="border border-gray-300 rounded-md py-1 px-5 md:mr-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                        〜
                                        <select name="sunday_close" class="border border-gray-300 rounded-md py-1 px-5 md:ml-10">
                                                <option value=0 hidden>-</option>
                                            @foreach($times as $time)
                                                <option value="{{ $time->id }}">{{ $time->hour }}:{{ $time->minute }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="sunday_rest" value=0>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    
                        <div x-data="planAdd()"> 
                            <div class="grid grid-cols-1 mt-5 border-t border-gray-200">
                                <h1 class="text-center mt-5 font-bold text-lg">トレーニングプラン<span class="text-sm text-red-600 font-light">(最大5つまで)</span></h1>
                                <label class="mt-5 md:mt-2 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mb-1">トレーニングタイプ</label>
                                <input name="plan_name[]" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text" placeholder="プラン名を入力して下さい" required/>
                                <label class="mt-1 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">金額</label>
                                <div class="inline-block">
                                    <input name="price[]" class="md:w-11/12 py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text" placeholder="金額を入力して下さい" required/>
                                    <div class="inline select-none">円</div>
                                </div>
                                <label class="mt-1 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">時間</label>
                                <select name="time[]" class="md:w-11/12 py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                    <option value="60">60分</option>
                                    <option value="90">90分</option>
                                    <option value="120">120分</option>
                                    <option value="150">150分</option>
                                    <option value="180">180分</option>
                                    <option value="240">240分</option>
                                    <option value="300">300分</option>
                                </select>
                                <label class="mt-1 uppercase md:text-sm text-gray-500 text-light font-semibold">説明文</label>
                                <textarea name="introduction[]" x-model="plan.txt2" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="金額を入力して下さい" cols="30" rows="5" required></textarea>
                                <template x-for="(plan, index) in plans" :key="index">
                                    <div class="grid grid-cols-1 mt-5 border-t border-gray-200">
                                        <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">トレーニングタイプ</label>
                                        <input name="plan_name[]" x-model="plan.txt1" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text" placeholder="プラン名を入力して下さい" required/>
                                        <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-1">金額</label>
                                        <div class="inline-block">
                                            <input name="price[]" x-model="plan.txt2" class="md:w-11/12 py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text" placeholder="金額を入力して下さい" required/>
                                            <div class="inline select-none">円</div>
                                        </div>
                                        <label class="mt-1 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold" x-model="plan.txt3">時間</label>
                                            <select name="time[]" class="md:w-11/12 py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                                <option value="60">60分</option>
                                                <option value="90">90分</option>
                                                <option value="120">120分</option>
                                                <option value="150">150分</option>
                                                <option value="180">180分</option>
                                                <option value="240">240分</option>
                                                <option value="300">300分</option>
                                            </select>
                                        <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mt-1">説明文</label>
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
                                <div class="flex flex-row justify-center items-center pt-3">
                                    <button type="button" @click.prevent="addPlanForm" class="text-sm py-2 px-5 rounded-lg text-teal-600 border border-gray-300 hover:bg-gray-200">
                                        プランを追加する
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                            <div>
                        </div>
                    
                        <div class="grid grid-cols-1 mt-5">
                            <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold mb-1">プロフィール画像</label>
                            <div class='flex items-center justify-center w-full'>
                                <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-teal-300 group'>
                                    <div class='flex flex-col items-center justify-center pt-9'>
                                        <svg class="w-10 h-10 text-teal-600 group-hover:text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <input name="profile_image" type="file" class="hidden" accept="image/png,image/jpeg,image/jpg"/>
                                </label>
                            </div>
                        </div>
                    
                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                            <a href="{{ route('trainer.profile.index') }}" class='w-auto border border-red-600 hover:bg-red-100 rounded-lg shadow-md font-medium text-red-600 px-4 py-2'>キャンセル</a>
                            <button type="submit" class='w-auto bg-teal-600 hover:bg-teal-500 rounded-lg shadow-2xl font-medium text-white px-4 py-2'>完了</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>