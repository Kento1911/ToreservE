<x-app-layout>
    <main class="bg-gray-200">
        <section class="mx-auto pt-28 md:pt-24 lg:pt-20 pb-16 px-2 md:px-4">
            <form method="POST" action="{{ route('admin.trainer.search') }}">
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
                @foreach($trainers as $trainer)
                    @if(!is_null($trainer->TrainerProfile))
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ asset($trainer->TrainerProfile->profile_image) }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $trainer->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $trainer->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-1 py-4 whitespace-nowrap">
                                @if(is_null($trainer->deleted_at))
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
                                @if(is_null($trainer->deleted_at))
                                <a href="{{ route('admin.trainer.detail',['trainer' => $trainer]) }}" class="text-indigo-600 hover:text-indigo-900">編集</a>
                                @endif
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ asset('/storage/images/no_image.png') }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            未設定
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $trainer->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-1 py-4 whitespace-nowrap">
                                @if(is_null($trainer->deleted_at))
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
                                @if(is_null($trainer->deleted_at))
                                <a href="{{ route('admin.trainer.detail',['trainer' => $trainer]) }}" class="text-indigo-600 hover:text-indigo-900">編集</a>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div>
                {{ $trainers->links() }}
            </div>
        </section>
    </main>
</x-app-layout>
