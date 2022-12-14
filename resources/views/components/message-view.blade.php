<div class="message-card w-[80%] mt-2 @if ($isMine) mine ml-auto @endif relative" data-user-id="{{ $user->id }}">
    <div class="text-[12px] flex items-end gap-2 font-bold @if ($isMine) flex-row-reverse @endif mb-2">
        @if ($userMessagesCount == 1)
            <div class="flex items-center h-full">
                <div class="avatar rounded-full w-8 h-8 bg-slate-500"
                     style="background-image: url({{ $user->avatar->link }});">
                </div>
            </div>
        @endif
        <span>{{ $user->phone }}</span>
        <span>{{ $user->name }}</span>
    </div>
    @if ($attachment)
        <img src="{{ $attachment->link }}" class="sm:max-w-[380px] sm:max-h-[380px] rounded-md" alt="image">
    @endif
    <div class="text-[15px]">
        {{ $text }}
        <span class="absolute bottom-1 right-1 text-slate-500 text-[12px]">@if($isEdited)изменено <i class="far fa-edit"></i>@endif {{ $date }}</span>
    </div>
</div>
