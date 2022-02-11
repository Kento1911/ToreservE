<header x-data="{ isActive:false }" class="text-gray-600 body-font shadow-md fixed top-0 left-0 right-0 bg-gray-400">
    <div class="w-full flex flex-row justify-between p-5 items-center">
        <div class="w-40">
            <a href="{{ route('user.top') }}">
                <img src="/images/logo.png" >
            </a>
        </div>
        <div class="hidden md:inline-block">
            <div class="text-white">
                <a href="{{ route('user.schedule.top') }}" class="p-5 hover:text-gray-600 hover:border-b-4 border-white-500 target:border-b-4 border-white-500">予約一覧</a>
                <a href="{{ route('user.schedule.unapproved') }}" class="p-5 hover:text-gray-600 hover:border-b-4 border-white-500">未確定予約</a>
                <a href="{{ route('user.record.top') }}" class="p-5 hover:text-gray-600 hover:border-b-4 border-white-500">トレーニング履歴</a>
                <form class="inline" method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <a :href="{{ route('user.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="p-5 hover:text-gray-600 text-red-600 font-semibold cursor-pointer">ログアウト</a>
                </form>
            </div>
        </div>
        <div class="md:hidden">
            <button @click="isActive =! isActive" class="hover:bg-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                </svg>
            </button>   
        </div>
    </div>
    <div id="content" x-cloak x-show="isActive" class="flex flex-col w-full text-center text-black body-font shadow-md fixed bg-gray-300 border border-gray-500">
        <div class="">
            <a href="{{ route('user.schedule.top') }}" class="block p-4 hover:bg-gray-400">予約一覧</a>
            <a href="{{ route('user.schedule.unapproved') }}" class="block p-4 hover:bg-gray-400">未確定予約</a>
            <a href="" class="block p-4 hover:bg-gray-400">トレーニング履歴</a>
            <form class="block p-4" method="POST" action="{{ route('user.logout') }}">
                @csrf
                <a :href="{{ route('user.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="p-5 hover:text-gray-600 text-red-600 font-semibold cursor-pointer">ログアウト</a>
            </form>
        </div>
    </div>
</header>
