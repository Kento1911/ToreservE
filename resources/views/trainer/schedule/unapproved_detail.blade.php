<x-app-layout>
    <div x-data="{ open_cancel : false, open_confirm: false }" class="min-h-screen bg-gray-200">    
        <main class="bg-gray-200 lg:container mx-auto">
            <div class="bg-gray-200">
                <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-4 pt-28 md:pt-32 pb-8">
                    <div class="snap-always snap-center p-4 bg-white rounded-lg shadow-md">
                        <div class="h-full p-6 rounded-lg border-2 border-teal-500 flex flex-col">
                            @foreach($schedule->plan as $plan)
                            <h2 class="text-2xl tracking-widest title-font mb-1 font-medium">{{ $plan->plan_name }}</h2>
                            <h2 class="text-md tracking-widest title-font mb-1 font-medium">{{ $plan->time }} 分</h2>
                            <h1 class="text-3xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">{{ $plan->price }} 円</h1>
                            <p class="flex items-center text-gray-600 mb-5">
                                {!! nl2br(e($plan->introduction)) !!}
                            </p>
                            @endforeach
                        </div>
                    </div>
                    <div class="max-w-4xl bg-white w-full rounded-lg shadow-md mt-5">
                        <div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    ユーザー名
                                </p>
                                @foreach($schedule->user as $user)
                                <p>
                                    {{ $user->name }}
                                </p>
                                @endforeach
                                
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    日時
                                </p>
                                @foreach($schedule->time as $time)
                                <p>
                                    {{ $schedule->date }}&emsp;&emsp;{{ $time->hour }}:{{ $time->minute }}
                                </p>
                                @endforeach
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    選択エリア
                                </p>
                                @foreach($schedule->area as $area)
                                <p>
                                    {{ $area->name }}
                                </p>
                                @endforeach
                                
                            </div>
                            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                                <p class="text-gray-600">
                                    コメント
                                </p>
                                <p>
                                    {!! nl2br(e($schedule->user_comment)) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    @if(!$schedule_comment->isEmpty() && $schedule->state_flg == 1 || $schedule->state_flg == 2 || $schedule->state_flg == 3)
                        @if($schedule->state_flg == 2)
                            <label class="block text-lg font-bold text-green-600 mt-5" for="">ユーザーからの連絡があります</label>
                            <label class="block text-sm text-red-600">※返信をお願いします</label>
                        @elseif($schedule->state_flg == 1)
                            <label class="block text-lg font-bold text-green-600 mt-5" for="">返信をお待ちください</label>
                        @else
                        @endif
                        <div class="flex flex-col h-full overflow-x-auto bg-white mb-5 mt-2 rounded-lg snap-x">
                            <div class="flex flex-col h-full">
                                <div class="grid grid-cols-12">
                                    @foreach($schedule_comment as $comment)
                                        @if($comment->sender === 1 )
                                            <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                                <div class="items-center">
                                                    <div class="ml-3 text-sm bg-green-300 py-2 px-4 rounded-xl mt-1">
                                                        <div>{!! nl2br(e($comment->comment)) !!}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                                <div class="items-center">
                                                    @foreach($schedule->user as $user)
                                                    <label class="ml-3" for="">{{ $user->name }}</label>
                                                    @endforeach
                                                    <div class="ml-3 text-sm bg-green-300 py-2 px-4 rounded-xl mt-1">
                                                        <div>{!! nl2br(e($comment->comment)) !!}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($schedule->state_flg === 2 ||  $schedule->state_flg === 3)
                        <form method="POST">
                                @csrf
                            <div class="flex md:flex-row justify-center justify-items-center md:mt-4 md:py-3">
                                <a href="{{ route('trainer.schedule.contact_form',['schedule' => $schedule]) }}" class="block bg-white text-teal-600 border border-teal-600 md:py-3 md:px-6 py-3 px-4 rounded-lg font-bold hover:bg-teal-100 mr-3">追加連絡</a>
                                <button type="button" @click="open_cancel = true" class="block bg-red-500 text-white md:py-3 md:px-6 py-3 px-4 rounded-lg font-bold hover:bg-red-300 mr-3">削除</button>
                            </div>
                            <div class="fixed  bottom-0 left-0 w-full flex min-h-screen items-center justify-center" style="background-color: rgba(0,0,0,.5);" x-show="open_cancel" x-cloak>
                                <div class="text-left w-1/2 bg-white h-auto p-4 md:max-w-xl md:px-8 md:py-6 lg:px-12 lg:py-8 shadow-xl rounded-lg mx-2 md:mx-0" @click.away="open = false">
                                    <h2 class="text-2xl text-red-500">注意</h2>
                                    <p class="mt-4">この予約を本当に削除致しますか？</p>
                                    <div class="flex flex-row justify-center mt-10 py-3">
                                        <button type="button" @click ="open_cancel = false" class="bg-white text-gray-500 border border-gray-500 py-2 px-4 rounded-lg mr-3 hover:bg-gray-200 md:mr-10">戻る</button>
                                        <button type="submit" formaction="{{ route('trainer.schedule.cancel',['schedule' => $schedule]) }}" class="bg-red-500 text-white py-2 px-4 rounded-lg font-bold hover:bg-red-300">削除</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @elseif($schedule->state_flg === 1)
                        <form method="POST" action="{{ route('trainer.schedule.cancel',['schedule' => $schedule])}}">
                            @csrf
                            <div class="flex md:flex-row justify-center justify-items-center md:mt-4 md:py-3 mt-5 ">
                                <a href="{{ route('trainer.schedule.contact_form',['schedule' => $schedule]) }}" class="block bg-white text-teal-600 border border-teal-600 md:py-3 md:px-6 py-3 px-4 rounded-lg font-bold hover:bg-teal-100 mr-3">追加連絡</a>
                                <button type="button" @click="open_cancel = true" class="bg-red-500 text-white py-3 px-6 rounded-lg font-bold hover:bg-red-300 mr-3 md:mr-10">削除</button>
                            </div>
                            <div class="fixed bottom-0 left-0 w-full flex min-h-screen items-center justify-center" style="background-color: rgba(0,0,0,.5);" x-show="open_cancel" x-cloak>
                                <div class="text-left bg-white h-auto p-4 md:max-w-xl md:px-8 md:py-6 lg:px-12 lg:py-8 shadow-xl rounded-lg mx-2 md:mx-0" @click.away="open_cancel = false">
                                    <h2 class="text-2xl text-red-500">注意</h2>
                                    <p class="mt-4">この予約を本当に削除致しますか？</p>
                                    <div class="flex flex-row justify-center mt-4 py-3">
                                        <button type="button" @click ="open_cancel = false" class="bg-white text-gray-500 border border-gray-500 py-2 px-4 rounded-lg mr-3 hover:bg-gray-200 md:mr-10">戻る</button>
                                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg font-bold hover:bg-red-300">削除</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @elseif($schedule->state_flg === 0)
                        <form method="POST" action="{{ route('trainer.schedule.cancel',['schedule' => $schedule]) }}">
                            @csrf
                            <div class="flex md:flex-row justify-center justify-items-center md:mt-4 md:py-3 mt-5 ">
                                <a href="{{ route('trainer.schedule.approve_form',['schedule' => $schedule]) }}" class="block bg-white text-teal-600 border border-teal-600 md:py-3 md:px-6 py-3 px-4 rounded-lg font-bold hover:bg-teal-100 mr-3">承諾</a>
                                <button type="button" @click="open_cancel = true" class="bg-red-500 text-white py-3 px-6 rounded-lg font-bold hover:bg-red-300 mr-3 md:mr-10">削除</button>
                            </div>
                            <div class="fixed  bottom-0 left-0 w-full flex min-h-screen items-center justify-center" style="background-color: rgba(0,0,0,.5);" x-show="open_cancel" x-cloak>
                                <div class="text-left bg-white h-auto p-4 md:max-w-xl md:px-8 md:py-6 lg:px-12 lg:py-8 shadow-xl rounded-lg mx-2 md:mx-0" @click.away="open_cancel = false">
                                    <h2 class="text-2xl text-red-500">注意</h2>
                                    <p class="mt-4">この予約を本当に削除致しますか？</p>
                                    <div class="flex flex-row justify-center mt-4 py-3">
                                        <button type="button" @click ="open_cancel = false" class="bg-white text-gray-500 border border-gray-500 py-2 px-4 rounded-lg mr-3 hover:bg-gray-200 md:mr-10">戻る</button>
                                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg font-bold hover:bg-red-300">削除</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                    @endif
                </section>
            </div>
        </main>
    </div>
</x-app-layout>