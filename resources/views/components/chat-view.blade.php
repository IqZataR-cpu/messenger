@props(['name', 'description', 'content', 'tab'])

<div class="chat-panel flex flex-1 flex-col w-100" aria-labelledby="chat-{{$tab}}" role="tabpanel"
     id="chat-{{$tab}}-panel" data-chat-id="{{ $tab }}" aria-hidden="true" style="display: none">
    <div class="flex space-x-2 px-6 border-l-[1px] border-slate-300 bg-slate-200 h-16 w-full">
        <div class="flex items-center h-full">
            <div class="avatar rounded-full w-12 h-12 bg-slate-500"
                 style="background-image: url({{$avatar->link}}); background-size: cover; background-position: center;">
            </div>
        </div>
        <div class="flex flex-col justify-center flex-1">
            <div>
                {{ $name }}
            </div>
            <div class="text-[12px] text-slate-500">
                {{ $description }}
            </div>
        </div>
        <div
            class="control-buttons text-gray-500 text-[18px] flex justify-end space-x-6 mr-6 items-center h-full">
            <i class="fa-solid fa-magnifying-glass"></i>
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </div>
    </div>
    <div class="flex-1 chat-content h-20 overflow-y-auto px-24 py-4 flex flex-col justify-between relative"
         style="background: url({{ asset('images/messages_background.jpg') }}); background-size: contain;">
        @php
            $currentMessageUser = $messages->first()->user;
            $message = $messages->first();
            $currentDay = $message->created_at->format('m/d/Y');
            $userMessagesCount = 0;
        @endphp
        <x-day-view :createdAt="$message->created_at"></x-day-view>
        <div class="mt-2 user-cards-container" data-user-id="{{ $currentMessageUser->id }}"></div>
        @foreach($messages as $message)
            @if ($message->user->is($currentMessageUser))
                @php
                    $userMessagesCount++;
                @endphp
                @if ($currentDay != $message->created_at->format('m/d/Y'))
                    @php
                        $currentDay = $message->created_at->format('m/d/Y')
                    @endphp
                    <x-day-view :createdAt="$message->created_at"></x-day-view>
                @endif
                <x-message-view :message="$message" userMessagesCount="{{ $userMessagesCount }}"></x-message-view>
            @else
                @php
                    $currentMessageUser = $message->user;
                    $userMessagesCount = 1;
                @endphp
                @if ($currentDay != $message->created_at->format('m/d/Y'))
                    @php
                        $currentDay = $message->created_at->format('m/d/Y')
                    @endphp
                    <x-day-view :createdAt="$message->created_at"></x-day-view>
                @endif
                <div class="mt-2 user-cards-container" data-user-id="{{ $currentMessageUser->id }}"></div>
                <x-message-view :message="$message"
                                userMessagesCount="{{ $userMessagesCount }}"></x-message-view>
            @endif
        @endforeach
    </div>
    <div
        class="flex space-x-4 text-[24px] items-center p-4 h-max text-slate-500 border-slate-300 bg-slate-200 h-16 w-full">
        <div>
            <i class="fa-regular fa-face-laugh"></i>
        </div>
        <div>
            <i class="fa-solid fa-paperclip"></i>
        </div>
        <div class="flex-1">
                    <textarea
                        id="message"
                        rows="1"
                        onkeyup="resizeArea('message', 40, 160);"
                        class="scrollbar-thin text-[16px] leading-[30px] scrollbar-thumb-slate-300 scrollbar-track-white-100 border-none h-10 text-slate-600 placeholder:text-slate-500 block bg-white w-full border rounded-md py-1 pl-5 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1"
                        placeholder="Введите сообщение" type="text" name="message"
                        style="resize: none;"
                    ></textarea>
        </div>
        <div>
            <i class="fa-solid fa-microphone"></i>
        </div>
    </div>
</div>
