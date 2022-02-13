<x-guest-layout>
    <x-user-guest-navigationbar />
    <div class="pt-4">
        <div class="bg-cover bg-center" style="background-image: url(/images/gym.jpg)">
                <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-2xl lg:max-w-2xl md:px-36 md:py-20">
                    <div class="w-full">
                        <div class="mt-8 bg-white rounded shadow-2xl p-7 sm:p-10">
                            <h3 class="mb-4 text-xl font-semibold text-center">
                                トレーナーを探す
                            </h3>
                            <form method="POST" action="{{ route('user.show') }}">
                                @csrf
                                <div class="mb-2 sm:mb-2"> 
                                    <div class="col-span-1">
                                        <div class="flex flex-row">
                                            <label for="country" class="inline text-sm font-medium text-gray-700">エリアから探す</label>
                                            <svg class="h-4 w-4 text-gray-800"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />  <circle cx="12" cy="10" r="3" /></svg>
                                        </div>
                                        <select name="area" autocomplete="country-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=0>選択してください</option>
                                            @foreach($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 sm:mb-2 col-span-2">
                                    <label for="lastName" class="inline text-sm font-medium text-gray-700">トレーナータイプから探す</label>
                                    <select name="type" autocomplete="country-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value=0>選択してください</option>
                                        @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-10 mb-2 sm:mb-4">
                                    <button type="submit" class="bg-blue-400 text-white inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide transition duration-200 ease-in-out delay-150 hover:bg-blue-600 rounded shadow-md">
                                        検索
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="text-gray-600 body-font border-b">
        <div class="container px-5 py-2 mx-auto">
            <div class="flex flex-col text-center w-full mb-4 md:mb-24">
                <h2 class="text-xs text-indigo-500 tracking-widest font-medium title-font mb-1">トレザーブとは</h2>
                <h1 class="sm:text-3xl text-2xl font-serif font-medium title-font mb-4 text-gray-900">ToreservE</h1>
                <p class="lg:w-auto mx-auto leading-loose text-justify">Toreserve(トレザーブ)は、あなたにピッタリなパーソナルトレーナを探せるマッチングサイトです。</p>
                <p class="lg:w-auto mx-auto leading-loose text-justify">さあ、今すぐあなたもパーソナルトレーナーを探し、一緒に自分を高めましょう!</p>
            </div>
        </div>
    </section>
    <section class="text-gray-600 body-font mt-5">
        <div class="px-5mx-auto">
            <div class="flex flex-col text-center w-full mb-1">
                <h2 class="text-xs text-indigo-500 tracking-widest font-medium title-font mb-1">ToreservEのここがすごい</h2>
            </div>
            <div class="flex flex-wrap">
                <div class="xl:w-1/3 lg:w-1/3 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                    <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">1.自分にピッタリなトレーナーが見つかる</h2>
                    <p class="leading-relaxed text-base mb-4">コーチングしてして欲しい分野と近くのエリアから簡単に検索できます</p>
                </div>
                <div class="xl:w-1/3 lg:w-1/3 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                    <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">2.簡単予約</h2>
                    <p class="leading-relaxed text-base mb-4">二週間先まで予約することが可能です。</p>
                </div>
                <div class="xl:w-1/3 lg:w-1/3 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                    <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">3.フィードバック</h2>
                    <p class="leading-relaxed text-base mb-4">トレーニングが終わったら、メニューとフィードバックが貰えます。</p>
                </div>
            </div>
            <div class="flex justify-center">
                <a href="{{ route('user.login') }}" class="block text-white bg-teal-800 border-0 py-2 px-8 focus:outline-none hover:bg-teal-600 rounded text-lg">会員登録</a>
            </div>
        </div>
    </section>
    <section class="text-gray-600 body-font shadow-lg md:mt-24">
        <div class="container px-5 py-12 mx-auto">
            <div class="flex flex-col text-center w-full mb-4">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">お問合せ</h1>
            </div>
            <form method="POST" action="{{ route('user.send') }}">
                @csrf
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-1/2">
                        <label for="name" class="leading-7 text-sm text-gray-600">お名前</label>
                        <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                    </div>
                    <div class="p-2 w-1/2">
                        <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                        <input type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                    </div>
                    <div class="p-2 w-full">
                        <label for="message" class="leading-7 text-sm text-gray-600">お問合せ事項</label>
                        <textarea id="message" name="message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" required></textarea>
                    </div>
                    <div class="p-2 w-full">
                        <button class="flex mx-auto text-white bg-blue-400 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">送信</button>
                    </div>
                    <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
                        <a href="{{ route('trainer.welcome') }}" class="p-5 hover:text-blue-400">トレーナーの方はこちらから</a>
                        <p class="text-indigo-500 mb-2">ToreservE@email.com</p>
                        <span class="inline-flex">
                        <a class="text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                            </svg>
                        </a>
                        <a class="ml-4 text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                            </svg>
                        </a>
                        <a class="ml-4 text-gray-500">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                            </svg>
                        </a>
                        <a class="ml-4 text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                            </svg>
                        </a>
                        </span>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
