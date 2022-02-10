<x-app-layout>
    <main class="bg-gray-200">
    <section class="max-w-11/12 mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-16">
            <!-- component -->
            <div class="flex bg-gray-200 items-center justify-center px-2 ">
                <div class="grid bg-white rounded-md shadow-sm w-full md:w-10/12">
            
                    <div class="flex justify-center">
                        <div class="flex">
                            <h1 class="text-gray-600 font-bold md:text-2xl text-xl pt-8 pb-5">プロフィール編集</h1>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <div class="flex">
                            <x-auth-validation-errors class="mb-4" :error="$errors"/>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('trainer.profile.update_profile',['trainer_profile' => $trainer_profile]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">名前</label>
                            <input name="name" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="text" placeholder="お名前を入力して下さい" required value="{{ $trainer_profile->name }}"/>
                        </div>

                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">年齢</label>
                            <input name="age" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" type="number" max="100" step="1" placeholder="年齢を入力して下さい" required value="{{ $trainer_profile->age }}" required/>
                        </div>
            
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">性別</label>
                            <select name="sex" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" value="{{ $trainer_profile->sex }}">
                                <option value="0">男性</option>
                                <option value="1">女性</option>
                                <option value="9">無回答</option>
                            </select>
                        </div>
                       
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">紹介文</label>
                            <textarea name="profile_comment" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" cols="30" rows="15" required>{{ $trainer_profile->profile_comment }}</textarea>
                        </div>

                        <div x-data="typeAdd()"> 
                            <div class="grid grid-cols-1 mt-5 mx-7 border-t border-gray-200">
                                <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">トレーニングタイプ</label>
                                
                                <select name="type[]" x-model="type.Select" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                    <option hidden value="">選択して下さい</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>

                                <template x-for="(type, index) in types" :key="index">
                                    <div class="grid grid-cols-12 mt-3">
                                        <select name="type[]" x-model="type.Select" class="col-span-9 md:col-span-11  py-2 px-3 rounded-lg border border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                            <option hidden value="">選択して下さい</option>
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
                                        プランを追加する
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                            <div>
                        </div>

                        <div x-data="areaAdd()"> 
                            <div class="grid grid-cols-1 mt-5 border-t border-gray-200">
                                <label class="mt-5 uppercase md:text-sm text-sm text-gray-500 text-light font-semibold">エリア</label>

                                <select name="area[]" x-model="area.Select" class="py-2 px-3 rounded-lg border border-teal-600 mt-1 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                    <option hidden value="">選択して下さい</option>
                                    @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>

                                <template x-for="(area, index) in areas" :key="index">
                                    <div class="grid grid-cols-12 mt-3">
                                        <select name="area[]" x-model="area.Select" class="col-span-9 md:col-span-11  py-2 px-3 rounded-lg border border-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                                            <option hidden value="">選択して下さい</option>
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
                                        プランを追加する
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
                            <button type="submit" class='w-auto bg-teal-600 hover:bg-teal-500 rounded-lg shadow-xl font-medium text-white px-4 py-2'>完了</button>
                        </div>
                    </form>
            
                </div>
            </div>
        </section>
    </main>
</x-app-layout>