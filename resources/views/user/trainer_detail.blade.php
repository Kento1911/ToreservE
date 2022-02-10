<x-guest-layout>
    <x-user-guest-navigationbar />
    <main class="bg-gray-200" x-data="{ modalActive:false }">
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-16">
            <div class="text-gray-700 font-bold text-tile mb-1 md:mb-3 md:ml-12">
                プロフィール
            </div>
            
            <div class="container mx-auto bg-gray-200">
                <div class="md:flex md:-mx-2">
                    <div class="w-full md:w-5/12 md:mx-2 md:h-90 bg-white rounded-lg shadow-md">
                        <div class="p-3">
                            <div class="image overflow-hidden rounded-lg">
                                <img class="h-auto w-full mx-auto" src="{{ asset($trainer_profile->profile_image) }}">
                            </div>
                            <h1 class="text-gray-900 font-bold text-xl leading-8 my-3">{{ $trainer_profile->name }}</h1>
                            <div class="mt-5">
                                <label class="text-sm">自己紹介</label>
                                <p class="text-md md:text-lg text-gray-500 p-2 leading-6">
                                    {!! nl2br(e($trainer_profile->profile_comment)) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-7/12">
                        <div class="bg-white p-3 shadow-md rounded-lg">
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
                                </div>
                            </div>
                        </div>

                        <div class="p-3 shadow-md rounded-lg bg-white mt-1">
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
                                                <a class="block bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-500" href="{{ route('user.reserve',['plan' => $plan]) }}">予約</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-guest-layout>