<x-guest-layout>
    <x-guest-header/>
    <main class="bg-gray-200 lg:container mx-auto">
        <!-- component -->
        <section class="flex flex-col md:flex-row h-screen items-center">

            <div class="hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
                <img src="{{ asset('images/woman.jpg') }}" alt="" class="w-full h-full object-cover">
            </div>
        
            <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center">
                <div class="w-full h-100">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
                    <form class="mt-16" action="{{ route('user.register') }}" method="POST">
                    @csrf
                        <div>
                            <x-label for="name" class="block text-gray-700">ユーザー名</x-label>
                            <x-input type="text" name="name" id="name" placeholder="お名前を入力して下さい" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required/>
                        </div>

                        <div>
                            <x-label for="email" class="block text-gray-700 mt-3">メールアドレス</x-label>
                            <x-input type="email" name="email" id="email" placeholder="@exmple.com" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required/>
                        </div>
            
                        <div class="mt-4">
                            <x-label for="password" class="inline-block text-gray-700">パスワード</x-label><label class="inline text-gray-700 text-xs" for="">   8文字以上</label>
                            <x-input type="password" name="password" required autocomplete="new-password"  minlength="8" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" />
                        </div>

                        <div class="mt-4">
                            <x-label for="password confirmation" class="block text-gray-700">パスワード(確認用)</x-label>
                            <x-input type="password" name="password_confirmation" required id="password_confirmation"  minlength="8" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none"/>
                        </div>
            
                        <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg px-4 py-3 mt-6">
                            ログイン
                        </button>
                    </form>
        
                    <hr class="my-6 border-gray-300 w-full">
        
                    <p class="mt-8 text-center">お持ちのアカウントでログインする</p>
                    <a href="{{ route('user.login') }}" class="block text-center text-blue-500 hover:text-blue-700 font-semibold">ログインへ</a>
                </div>
            </div>
        </section>
    </main>
</x-guest-layout>
