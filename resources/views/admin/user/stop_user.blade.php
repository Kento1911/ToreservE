<x-app-layout>
    <main x-data="{ open_restore : false,open_force_delete : false , user_id : '' }" class="bg-gray-200">
        <section class="mx-auto pt-28 md:pt-24 lg:pt-20 pb-16 px-2 md:px-4">
            <form method="POST" action="{{ route('admin.user.stop_user_search') }}">
                @csrf
                <div class="text-gray-600 md:flex flex-row justify-around">
                    <div class="p-1 md:w-1/3">
                        <label for="name" class="text-sm font-medium text-gray-700 ml-2 md:inline">アカウント名で検索</label>
                        <div class="flex items-center place-content-center">
                            <input class="inline-block border-2 border-gray-300 bg-white h-12 w-full pl-2 pr-8 rounded-lg text-sm focus:outline-none" name="name" placeholder="名前で検索">
                            <button type="submit" class="py-2 px-4 inline-block bg-green-400 hover:bg-green-600 rounded-lg">
                                <svg class="text-gray-600 h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                    <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                                </svg>
                            </button>
                        </div>
                    </div>                
                </div>
            </form>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        名前
                        </th>
                        <th scope="col" class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        状態
                        </th>
                        <th scope="col" class="relative px-1 py-3">
                        <span class="sr-only">編集</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $user->email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-1 py-4 whitespace-nowrap">
                            @if(is_null($user->deleted_at))
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-600">
                                Stop
                            </span>
                            @endif
                        </td>
                        <td class="pl-1 pr-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button type="button" @click="open_restore = true,user_id = {{ $user->id }}" class="text-indigo-600 hover:text-indigo-900 mr-2">復帰</button>
                            <button type="button" @click="open_force_delete = true,user_id = {{ $user->id }}" class="text-red-600 hover:text-red-900">削除</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                {{ $users->links() }}
            </div>
            <form method="POST" action="{{ route('admin.user.restore') }}">
                @csrf
                <input type="hidden" name="trainer_id" :value="user_id">
                <div class="fixed  bottom-0 left-0 w-full flex min-h-screen items-center justify-center" style="background-color: rgba(0,0,0,.5);" x-show="open_restore" x-cloak>
                    <div class="text-left w-1/2 bg-white h-auto p-4 md:max-w-xl md:px-8 md:py-6 lg:px-12 lg:py-8 shadow-xl rounded-lg mx-2 md:mx-0" @click.away="open_restore = false">
                        <h2 class="text-2xl text-red-500">注意</h2>
                        <p class="mt-4">このトレーナのアカウントを復帰しますか？</p>
                        <div class="flex flex-row justify-center mt-10 py-3">
                            <button type="button" @click ="open_restore = false" class="bg-white text-gray-500 border border-gray-500 py-2 px-4 rounded-lg mr-3 hover:bg-gray-200 md:mr-10">戻る</button>
                            <button class="bg-green-500 text-white py-2 px-4 rounded-lg font-bold hover:bg-green-300">復帰</button>
                        </div>
                    </div>
                </div>
            </form>
            <form method="POST" action="{{ route('admin.user.force_delete') }}">
                @csrf
                <input type="hidden" name="user_id" :value="user_id">
                <div class="fixed  bottom-0 left-0 w-full flex min-h-screen items-center justify-center" style="background-color: rgba(0,0,0,.5);" x-show="open_force_delete" x-cloak>
                    <div class="text-left w-1/2 bg-white h-auto p-4 md:max-w-xl md:px-8 md:py-6 lg:px-12 lg:py-8 shadow-xl rounded-lg mx-2 md:mx-0" @click.away="open_force_delete = false">
                        <h2 class="text-2xl text-red-500">注意</h2>
                        <p class="mt-4">このトレーナのアカウントを停止しますか？</p>
                        <div class="flex flex-row justify-center mt-10 py-3">
                            <button type="button" @click ="open_cancel = false" class="bg-white text-gray-500 border border-gray-500 py-2 px-4 rounded-lg mr-3 hover:bg-gray-200 md:mr-10">戻る</button>
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg font-bold hover:bg-red-300">停止</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
</x-app-layout>