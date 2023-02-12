<div {{ $attributes->merge(['class' => 'absolute top-0 left-0 w-full h-full z-10 flex flex-col']) }}>
    <div class="bg-emerald-700 h-28 flex items-end text-white p-2">
        <div class="icon rounded-full w-12 h-12 flex justify-center hover:bg-emerald-800 hover:cursor-pointer items-center text-lg modal-close-button">
            <i class="fas fa-arrow-left"></i>
        </div>
        <span class="leading-[48px] text-xl ml-2">{{ $title }}</span>
    </div>
    <div class="bg-slate-100 flex-1">
        {{ $modalContent }}
    </div>
</div>
