<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        <header x-data="{ isActive:false }" class="text-gray-600 body-font shadow-md fixed top-0 left-0 right-0 bg-gray-400">
            <div class="w-full flex flex-row justify-between p-5 items-center">
                <div class="w-40">
                    <a>
                        <img src="/images/logo.png" >
                    </a>
                </div>
                <div class="hidden lg:inline-block">
                    <div class="text-white">
                        <a href="{{ route('trainer.login') }}" class="p-5 hover:text-gray-600 hover:border-b-4 border-white-500 target:border-b-4 border-white-500">ログイン</a>
                        <a href="{{ route('trainer.register') }}" class="p-5 hover:text-gray-600 hover:border-b-4 border-white-500">会員登録</a>
                    </div>
                </div>
                <div class="lg:hidden">
                    <button @click="isActive =! isActive" class="hover:bg-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>   
                </div>
            </div>
            <div id="content" x-cloak x-show="isActive" class="flex flex-col w-full text-center text-black body-font shadow-md fixed bg-gray-300 border border-gray-500">
                <div class="">
                    <a href="{{ route('trainer.login') }}" class="block p-4 hover:bg-gray-400">ログイン</a>
                    <a href="{{ route('trainer.register') }}" class="block p-4 hover:bg-gray-400">会員登録</a>
                </div>
            </div>
        </header>
        <main>
            <div class="bg-cover bg-center mt-16 md:p-16 p-8" style="background-image: url(/images/trainer_top.jpg)">
                <div class="mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-16">
                    <div class="flex flex-col justify-center items-center md:w-2/3">
                        <div class="bg-gray-800 bg-opacity-75 p-6">
                            <div class="text-white font-serif text-5xl text-center">
                                Torematch
                            </div>
                            <p class="text-white text-md mt-5">Torematchはパーソナルトレーナーの為の無料予約サイトです</p>
                        </div>
                    </div>
                </div>
            </div>
            <section class="text-gray-600 body-font bg-gray-200">
                <div class="container px-5 py-8 mx-auto">
                    <div class="flex flex-wrap flex-row w-full mb-4">
                        <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">使用方法</h1>
                            <div class="h-1 w-20 bg-indigo-500 rounded"></div>
                        </div>
                        <div class="whitespace-pre-line -mt-8 md:mt-8">
                            <p class="w-full leading-relaxed text-gray-500">Torematchへの登録は、無料且つシンプルです。 </p>
                            <p class="w-full leading-relaxed text-gray-500 -mt-4">あなたも登録し、トレーニングの指導をしましょう!</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -m-4 -mt-8">
                        <div class="md:w-1/2 p-4">
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <img class="h-40 rounded w-full object-cover object-center mb-6" src="{{ asset('images/submit.jpg') }}" alt="content">
                                <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">1.登録</h3>
                                <h2 class="text-lg text-gray-900 font-medium title-font mb-4">プロフィールを登録</h2>
                                <p class="leading-relaxed text-base">あなたの活動場所、受付時間、独自のプランを登録しましょう。</p>
                            </div>
                        </div>
                        <div class="md:w-1/2 p-4">
                            <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                                <img class="h-40 rounded w-full object-cover object-center mb-6" src="{{ asset('images/phone.jpg') }}" alt="content">
                                <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">2.マッチング</h3>
                                <h2 class="text-lg text-gray-900 font-medium title-font mb-4">ユーザーとマッチング</h2>
                                <p class="leading-relaxed text-base">ユーザーからの予約内容を確認し、問題がなければ了承して下さい。</p>
                            </div>
                        </div>
                        <div class="md:w-1/2 p-4">
                            <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                                <img class="h-40 rounded w-full object-cover object-center mb-6" src="{{ asset('images/confirm.jpg') }}" alt="content">
                                <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">3.確定</h3>
                                <h2 class="text-lg text-gray-900 font-medium title-font mb-4">予約の確定</h2>
                                <p class="leading-relaxed text-base">ユーザーとトレーナーのお互いに了承が取れたら、確定となります。確定後に場所の確保等が必要であれば、このタイミングで行いましょう！</p>
                            </div>
                        </div>
                        <div class="md:w-1/2 p-4">
                            <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                                <img class="h-40 rounded w-full object-cover object-center mb-6" src="{{ asset('images/record.jpg') }}" alt="content">
                                <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">4.フィードバック</h3>
                                <h2 class="text-lg text-gray-900 font-medium title-font mb-4">トレーニング記録の作成</h2>
                                <p class="leading-relaxed text-base">トレーニングが終了したら、記録を作成しましょう。ユーザー、トレーナーの双方で確認ができて、効率的にトレーニングが行えます。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
