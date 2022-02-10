<header x-data="{ isActive:false }" class="text-gray-600 body-font shadow-md fixed top-0 left-0 right-0 bg-gray-400">
    <div class="w-full flex flex-row justify-between p-5">
        <div class="w-40 self-center">
            <a href="{{ route('trainer.top') }}">
                <img src="/images/logo.png" >
            </a>
        </div>
        <div class="hidden lg:inline-block">
            <div class="text-white self-center">
                <a href="{{ route('trainer.top') }}" class="p-4 hover:text-gray-600 hover:border-b-4 border-white-500 target:border-b-4 border-white-500">トップ</a>
                <a href="{{ route('trainer.schedule.unapproved') }}" class="p-4 hover:text-gray-600 hover:border-b-4 border-white-500">承認待ち予約</a>
                <a href="{{ route('trainer.record.top') }}" class="p-4 hover:text-gray-600 hover:border-b-4 border-white-500">記録一覧</a>
                <a href="{{ route('trainer.profile.index') }}" class="lg:mr-20 md:mr-8 p-4 hover:text-gray-600 hover:border-b-4 border-white-500">プロフィール</a>
                <form class="inline" method="POST" action="{{ route('trainer.logout') }}">
                @csrf
                    <a :href="{{ route('trainer.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="p-4 hover:text-gray-600 text-red-600 font-semibold cursor-pointer">ログアウト</a>
                </form>
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
        <div>
            <a href="{{ route('trainer.top') }}" class="block p-4 hover:bg-gray-400">トップ</a>
            <a href="{{ route('trainer.schedule.unapproved') }}" class="block p-4 hover:bg-gray-400">承認待ち予約</a>
            <a href="{{ route('trainer.record.top') }}" class="block p-4 hover:bg-gray-400">記録一覧</a>
            <a href="{{ route('trainer.profile.index') }}" class="block p-4 hover:bg-gray-400">プロフィール</a>
            <form method="POST" action="{{ route('trainer.logout') }}">
            @csrf
                <a :href="{{ route('trainer.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block p-4 text-red-600 hover:bg-gray-400 font-semibold cursor-pointer">ログアウト</a>
            </form>
        </div>
    </div>
</header>

