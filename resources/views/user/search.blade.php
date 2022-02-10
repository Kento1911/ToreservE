<x-guest-layout>
    <x-user-guest-navigationbar />
    
    <main class="bg-gray-200 lg:container mx-auto">
        <section class="px-4 md:px-0 pt-32 pb-16 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 ">
        @foreach($trainers as $trainer)
            <div class="grid justify-items-center bg-white shadow-md border border-gray-200 rounded-lg max-w-sm mb-5">
                <div class="mt-3 px-2 flex justify-center h-52">
                    <img src="{{ asset($trainer->profile_image) }}" class="rounded-lg">
                </div>
                <div class="px-5 w-full self-strat">
                    <div>
                        <h5 class="mt-3 text-gray-900 font-bold text-2xl tracking-tight mb-2 text-center pt-3">{{ $trainer->name }}</h5>
                    </div>
                    <div class="line-clamp-5 text-lg text-gray-700 my-5">{!! nl2br(e($trainer->profile_comment)) !!}</div>
                </div>
                <div class="px-5 py-2 w-full h-full self-strat top-0">
                    @foreach($trainer->plan as $plan)
                        <div class="pt-1 flex flex-col p-2 border border-teal-500 rounded-lg h-full">
                            <p class="p-1 text-xl font-semibold">{{ $plan->plan_name }}</p>
                            <p class="p-1 text-sm font-semibold">{{ $plan->time }} 分</p>
                            <p class="p-1 text-2xl font-semibold border-b border-gray-100">{{ $plan->price }}円</p>
                            <p class="p-1 text-sm text-left line-clamp-5">{!! nl2br(e($plan->introduction)) !!}</p>
                        </div>
                        @php
                            break
                        @endphp
                    @endforeach
                </div>
                <div class="self-end">
                    <div class="text-center mt-3 rounded-lg flex justify-center self-end">
                        <a class="font-medium text-sm px-3 py-2 text-center flex hover:font-extrabold hover:bg-gray-100 rounded-lg" href="{{ route('user.detail',['trainer' => $trainer]) }}">
                            詳しくみる
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        </section>
        <div>
            {{ $trainers->links() }}
        </div>
    </main>
</x-guest-layout>