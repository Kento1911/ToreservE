<header x-data="{ isActive:false }" class="text-gray-600 body-font shadow-md fixed top-0 left-0 right-0 bg-gray-400">
    <div class="w-full flex flex-row justify-between p-5 items-center">
        <div class="w-40">
            <img src="/images/logo.png" >
        </div>
        <div class="hidden lg:inline-block">
            <div class="text-white">
                <a href="{{ route('admin.trainer.top') }}" class="p-5 hover:text-gray-600 font-medium hover:border-b-4 border-white-500">トレーナー</a>
                <a href="{{ route('admin.user.top') }}" class="p-5 hover:text-gray-600 font-medium hover:border-b-4 border-white-500">ユーザー</a>
                <a href="{{ route('admin.trainer.stop_trainer') }}" class="p-5 hover:text-gray-600 font-medium hover:border-b-4 border-white-500">停止中トレーナー</a>
                <a href="{{ route('admin.user.stop_user') }}" class="p-5 hover:text-gray-600 font-medium hover:border-b-4 border-white-500">停止中ユーザー</a>
                <form class="inline" method="POST" action="{{ route('admin.logout') }}">
                @csrf
                    <a :href="{{ route('admin.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="p-5 hover:text-gray-600 text-red-600 font-semibold">ログアウト</a>
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
    <div id="content" x-show="isActive" class="flex flex-col w-full text-center text-black body-font shadow-md fixed bg-gray-300 border border-gray-500" x-cloak>
        <div class="">
            <a href="{{ route('admin.trainer.top') }}" class="block p-4 hover:bg-gray-400">トレーナー</a>
            <a href="{{ route('admin.user.top') }}" class="block p-4 hover:bg-gray-400">ユーザー</a>
            <a href="{{ route('admin.trainer.stop_trainer') }}" class="block p-4 hover:bg-gray-400">停止中トレーナー</a>
            <a href="{{ route('admin.user.stop_user') }}" class="block p-4 hover:bg-gray-400">停止中ユーザー</a>
            <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
                <a :href="{{ route('admin.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block p-4 text-red-600 hover:bg-gray-400 font-semibold">ログアウト</a>
            </form>
        </div>
    </div>
</header>
