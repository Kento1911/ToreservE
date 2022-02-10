<x-app-layout>
    <main class="bg-gray-200" x-data="{ modalActive:false }">
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-16">
            <div class="flex flex-row text-gray-700 font-bold text-tile mb-1 md:mb-3 md:ml-12">
                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                プロフィール
            </div>
            @if(is_null($trainer_profile))
            <div class="container mx-auto bg-gray-200">
                <div class="md:flex md:-mx-2">
                    <div class="w-full md:w-5/12 md:mx-2 md:h-90 bg-white rounded-lg shadow-md">
                        <div class="p-3">
                            <div class="image overflow-hidden rounded-lg">
                                <div class="h-auto mx-auto">
                                    <img class="h-auto w-full" src="{{ asset('/storage/images/no_image.png') }}">
                                </div>
                            </div>
                            <h1 class="text-gray-900 font-bold text-xl leading-8 my-1"></h1>
                            <div></div>
                            <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">
                            </p>
                        </div>
                    </div>
                    <div class="md:w-7/12">
                        <div class="bg-white p-3 shadow-sm rounded-lg">
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">プロフィール</span>
                            </div>
                            <div class="text-gray-700">
                                <div class="grid text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">名前</div>
                                        <div class="px-4 py-2">登録されていません</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">年齢</div>
                                        <div class="px-4 py-2">登録されていません</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">性別</div>
                                        <div class="px-4 py-2">登録されていません</div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">トレーナータイプ</div>
                                        <div class="px-4 py-2">
                                            <ul>
                                                <li>登録されていません</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">活動場所</div>
                                        <div class="px-4 py-2">
                                            <ul>
                                                <li>登録されていません</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 shadow-sm rounded-lg bg-white mt-1">
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8l3 5m0 0l3-5m-3 5v4m-3-5h6m-6 3h6m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">プラン一覧</span>
                            </div>
                            <section class="text-gray-600 body-font">
                                
                                <div class="mt-1 bg-white rounded-lg hover:shadow-xs">
                                    <a href="{{ route('trainer.profile.create') }}" class="w-full block text-center text-blue-800 text-md font-semibold rounded-lg focus:outline-none focus:shadow-outline focus:font-black p-3 my-4 md:p-1 md:my-1">
                                        編集する
                                    </a>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="container mx-auto bg-gray-200">
                <div class="md:flex md:-mx-2">
                    <div class="w-full md:w-5/12 md:mx-2 md:h-90 bg-white rounded-lg">
                        <div class="p-3">
                            <div class="image overflow-hidden rounded-lg">
                                <img class="h-auto w-full mx-auto" src="{{ asset($trainer_profile->profile_image) }}">
                            </div>
                            <h1 class="text-gray-900 font-bold text-xl leading-8 my-3">{{ $trainer_profile->name }}</h1>
                            <div class="mt-5">
                                <label class="text-sm">自己紹介</label>
                                <p class="text-md md:text-lg text-gray-500 p-2 leading-6">
                                    {!! nl2br (e($trainer_profile->profile_comment)) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-7/12">
                        <div class="bg-white p-3 shadow-sm rounded-lg">
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">プロフィール</span>
                            </div>
                            <div class="text-gray-700">
                                <div class="grid text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">名前</div>
                                        <div class="px-4 py-2 text-lg">{{ $trainer_profile->name }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">年齢</div>
                                        <div class="px-4 py-2">{{ $trainer_profile->age }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">性別</div>
                                        <div class="px-4 py-2">
                                            @if($trainer_profile->sex === 0)
                                                男
                                                @elseif($trainer_profile->sex === 1)
                                                女
                                                @else
                                                無回答
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">トレーナータイプ</div>
                                        <div class="px-4 py-2">
                                            <ul>
                                                @foreach($trainer_types as $type )
                                                <li>{{ $type->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">活動場所</div>
                                        <div class="px-4 py-2">
                                            <ul>
                                               @foreach($trainer_areas as $area)
                                               <li>{{ $area->name }}</li>
                                               @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">活動日時</div>
                                        <div class="px-4 py-2">
                                            <ul>
                                                <li>月曜日:  @if($sales_day->monday_open === "0" || $sales_day->monday_close === "0")休み@else{{ $time[0]->hour }}:{{$time[0]->minute}}〜{{ $time[1]->hour }}:{{$time[1]->minute}}@endif</li>
                                                <li>火曜日:  @if($sales_day->tuesday_open === "0" || $sales_day->tuesday_close === "0")休み@else{{ $time[2]->hour }}:{{$time[2]->minute}}〜{{ $time[3]->hour }}:{{$time[3]->minute}}@endif</li>
                                                <li>水曜日:  @if($sales_day->wednesday_open === "0" || $sales_day->wednesday_close === "0")休み@else{{ $time[4]->hour }}:{{$time[4]->minute}}〜{{ $time[5]->hour }}:{{$time[5]->minute}}@endif</li>
                                                <li>木曜日:  @if($sales_day->thursday_open === "0" || $sales_day->thursday_close === "0")休み@else{{ $time[6]->hour }}:{{$time[6]->minute}}〜{{ $time[7]->hour }}:{{$time[7]->minute}}@endif</li>
                                                <li>金曜日:  @if($sales_day->friday_open === "0" || $sales_day->friday_close === "0")休み@else{{ $time[8]->hour }}:{{$time[8]->minute}}〜{{ $time[9]->hour }}:{{$time[9]->minute}}@endif</li>
                                                <li>土曜日:  @if($sales_day->saturday_open === "0" || $sales_day->saturday_close === "0")休み@else{{ $time[10]->hour }}:{{$time[10]->minute}}〜{{ $time[11]->hour }}:{{$time[11]->minute}}@endif</li>
                                                <li>日曜日:  @if($sales_day->sunday_open === "0" || $sales_day->sunday_close === "0")休み@else{{ $time[12]->hour }}:{{$time[12]->minute}}〜{{ $time[13]->hour }}:{{$time[13]->minute}}@endif</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="mt-5 bg-white rounded-lg">
                                        <a href="{{ route('trainer.profile.edit_profile',['trainer_profile' => $trainer_profile]) }}" class="block text-center w-full text-blue-800 text-md font-semibold rounded-lg focus:outline-none focus:shadow-outline hover:font-extrabold p-3 my-4 md:p-1 md:my-1">
                                            編集する
                                        </a> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 shadow-sm rounded-lg bg-white mt-1">
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8l3 5m0 0l3-5m-3 5v4m-3-5h6m-6 3h6m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">プラン一覧</span>
                            </div>
                            <section class="text-gray-600 body-font">
                                <div class="-m-4 snap-x snap-mandatory">
                                @foreach($plans as $plan)
                                    <div class="snap-always snap-center p-4 ">
                                        <div class="h-full p-6 rounded-lg border-2 border-teal-500 flex flex-col">
                                            <h2 class="text-2xl tracking-widest title-font mb-1 font-bold">{{ $plan->plan_name }}</h2>
                                            <h2 class="text-md tracking-widest title-font mb-1 font-bold">{{ $plan->time }} 分</h2>
                                            <h1 class="text-4xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">{{ $plan->price }} 円</h1>
                                            <p class="text-lg flex items-center text-gray-600 mb-5"> {!! nl2br(e($plan->introduction)) !!}</p>
                                            <div class="flex items-center justify-start md:justify-end">
                                                <a class="block bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-500" href="{{ route('trainer.profile.edit_plan',['plan' => $plan]) }}">編集</a>
                                                <a class="block bg-red-400 text-white py-2 px-4 rounded-lg ml-2 hover:bg-red-300" href="{{ route('trainer.profile.delete_plan',['plan' => $plan]) }}">削除</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </section>
                            <div class="bg-white mt-3 flex justify-center items-center py-2 px-3 text-lg hover:font-extrabold text-teal-600">
                                <a href="{{ route('trainer.profile.create_plan',['trainer_profile' => $trainer_profile]) }}">プランを追加</a>
                                <a href="{{ route('trainer.profile.create_plan',['trainer_profile' => $trainer_profile]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>
    </main>
</x-app-layout>
