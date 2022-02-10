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
        
                    <form class="mt-6" action="{{ route('trainer.login') }}" method="POST">
                        @csrf
                        <div>
                            <x-label class="block text-gray-700">メールアドレス</x-label>
                            <x-input type="email" name="email" id="email" placeholder="@example.com" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required value="{{old('email')}}"/>
                        </div>
            
                        <div class="mt-4">
                            <x-label class="block text-gray-700">パスワード</x-label>
                            <x-input type="password" name="password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" required/>
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <x-label for="remember_me" class="inline-flex items-center">
                                <x-input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember"/>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </x-label>
                        </div>
            
                        <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg px-4 py-3 mt-6">
                            ログイン
                        </button>
                    </form>
        
                    <hr class="my-6 border-gray-300 w-full">
        
                    <p class="mt-8 text-center">アカウントを作成する</p>
                    <a href="{{ route('trainer.register') }}" class="block text-center text-blue-500 hover:text-blue-700 font-semibold">会員登録へ</a>
                </div>
            </div>
        </section>
    </main>
</x-guest-layout>
