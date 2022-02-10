<x-guest-layout>
    <x-user-guest-navigationbar />  
    <main class="bg-gray-200 lg:container mx-auto">
        <div class="bg-gray-200">
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
            <div class="bg-white rounded-lg shadow-md">
                <div class="mt-5 p-2">
                    <label class="text-lg block px-3 mb-3" for="">日にちを選択して下さい</label>
                    <div class="flex justify-center">
                        @for($i = 1; $i < 8; $i ++)
                            <table class="border border-gray-400 md:w-full container">
                                <tr class="md:px-4 md:py-3 text-center font-bold">
                                    <th>{{ $day[$i] }}</th>
                                </tr>
                                <tr class="px-4 py-10 font-light text-center">
                                    <td>{{ $day_of_week[$i] }}</td>
                                </tr>
                                <tr class="md:px-4 md:py-3 flex justify-center border-t border-gray-400">
                                    <div>
                                        <td>
                                            @if($sales[$keys[$i]]['open'] === 0)
                                                <a href="#">
                                                    <svg class="w-8 h-8 text-red-600 hover:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </a>
                                                @else
                                                <a href="{{ route('user.reserve_day',['td' => $td[$i],'plan' => $plan ]) }}">
                                                    <svg class="w-8 h-8 text-center text-green-600 hover:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </a>
                                            @endif
                                        </td>
                                    </div>
                                </tr>
                            </table>
                        @endfor
                    </div>
                    <div class="flex justify-center mt-10">
                        @for($i = 8; $i < 15; $i ++)
                            <table class="container border border-gray-400 md:w-full mb-4">
                                <tr class="md:px-4 md:py-3 text-center font-bold">
                                    <th>{{ $day[$i] }}</th>
                                </tr>
                                <tr class="px-4 py-10 font-light text-center">
                                    <td>{{ $day_of_week[$i] }}</td>
                                </tr>
                                <tr class="md:px-4 md:py-3 flex justify-center border-t border-gray-400">
                                    <div>
                                        <td>
                                            @if($sales[$keys[$i]]['open'] === 0)
                                                <a href="#">
                                                    <svg class="w-8 h-8 text-red-600 hover:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </a>
                                                @else
                                                <a href="{{ route('user.reserve_day',['td' => $td[$i],'plan' => $plan ]) }}">
                                                    <svg class="w-8 h-8 text-center text-green-600 hover:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </a>
                                            @endif
                                        </td>
                                    </div>
                                </tr>
                            </table>
                        @endfor
                    </div>
                </div>
            </div>
        </section>
        </div>
    </main>
</x-guest-layout>
