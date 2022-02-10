<x-guest-layout>
    <x-guest-header/>
        <div class="flex flex-col h-screen items-center px-auto">
            <div class="container w-full mx-auto mt-24 shadow-lg p-8 md:w-1/3 bg-white h-screen md:h-96 rounded-lg">
                <div class="text-center text-2xl font-semibold mb-12 block">
                    パスワードの再設定
                </div>
                <div class=" mb-4 text-md text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
            <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('admin.password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="block">
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg px-4 py-3 mt-6">
                            {{ __('Email Password Reset Link') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
</x-guest-layout>
