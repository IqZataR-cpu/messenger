<div class="message-card w-[80%] mt-2 @if ($isMine) mine ml-auto @endif relative" data-uid="{{ $user->id }}">
    <div class="text-[12px] flex items-end gap-2 font-bold @if ($isMine) flex-row-reverse @endif mb-2">
        @if ($userMessagesCount == 1)
            <div class="flex items-center h-full">
                <div class="avatar rounded-full w-8 h-8 bg-slate-500"
                     @if ($user->avatar)
                        style="background-image: url({{ $user->avatar->link }});"
                     @endif
                >
                </div>
            </div>
        @endif
        <span>{{ $user->phone }}</span>
        <span>{{ $user->name }}</span>
    </div>
    @if ($attachments)
        <div class="flex gap-2 flex-wrap my-2">
            @foreach($attachments as $attachment)
                <img src="{{ $attachment->link }}" class="sm:max-w-100 sm:max-h-[380px] h-100 rounded-md" alt="image">
            @endforeach
        </div>
    @endif
    <div class="text-[15px] break-all">
        {{ $text }}
        <span class="absolute bottom-1 right-1 text-slate-500 text-[12px]">
            @if($isFavoriteMessage)
                <i class="fa-solid fa-star favorites" data-message-id="{{$messageId}}" style="cursor: pointer;"></i>
            @else
                <i class="fa-regular fa-star favorites" data-message-id="{{$messageId}}" style="cursor: pointer;"></i>
            @endif

            @if($isEdited)
                изменено <i class="far fa-edit"></i>
            @endif

            {{ $date }}
        </span>
    </div>
</div>
