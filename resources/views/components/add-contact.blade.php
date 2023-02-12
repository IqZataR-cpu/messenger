<x-left-modal class="add-contact-form hidden">
    <x-slot name="title">
        Добавить контакт
    </x-slot>
    <x-slot name="modalContent">
        <div class="flex h-12 px-4 items-center drop-shadow">
            <label class="relative block flex-1">
                <span class="sr-only">Search</span>
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <i class="fa-solid fa-magnifying-glass text-slate-400"></i>
                        </span>
                <input
                    class="border-none add-contact-form-search text-slate-600 placeholder:text-slate-500 block bg-slate-200 w-full border rounded-md py-1 pl-10 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                    placeholder="Поиск" type="text" name="search" id="add-contact-form-search"/>
            </label>
        </div>
        <div class="flex justify-center">
            <x-waiting-element>
                <x-slot name="class">hidden</x-slot>
            </x-waiting-element>
        </div>
        <div>

        </div>
    </x-slot>
</x-left-modal>
