@props(['message'])

@switch($message->currentStatus()->status)
    @case(\App\Models\MessageStatus::SENT)
        <i class="fa-solid fa-spinner rotate-180"></i>
        @break
    @case(\App\Models\MessageStatus::RECEIVED)
        <i class="fa-solid fa-check"></i>
        @break
    @case(\App\Models\MessageStatus::NOT_READ)
        <i class="fa-solid fa-check"></i>
        @break
    @case(\App\Models\MessageStatus::READ)
        <i class="fa-solid fa-check-double"></i>
        @break
@endswitch
