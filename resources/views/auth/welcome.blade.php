<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="csrf_token" value="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d0d90264b1.js" crossorigin="anonymous"></script>
    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *, :after, :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg, video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-gray-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity))
        }

        .border-gray-200 {
            --tw-border-opacity: 1;
            border-color: rgb(229 231 235 / var(--tw-border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);
            --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --tw-text-opacity: 1;
            color: rgb(229 231 235 / var(--tw-text-opacity))
        }

        .text-gray-300 {
            --tw-text-opacity: 1;
            color: rgb(209 213 219 / var(--tw-text-opacity))
        }

        .text-gray-400 {
            --tw-text-opacity: 1;
            color: rgb(156 163 175 / var(--tw-text-opacity))
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity))
        }

        .text-gray-600 {
            --tw-text-opacity: 1;
            color: rgb(75 85 99 / var(--tw-text-opacity))
        }

        .text-gray-700 {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity))
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns:repeat(1, minmax(0, 1fr))
        }

        @media (min-width: 640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns:repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-800 {
                --tw-bg-opacity: 1;
                background-color: rgb(31 41 55 / var(--tw-bg-opacity))
            }

            .dark\:bg-gray-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(17 24 39 / var(--tw-bg-opacity))
            }

            .dark\:border-gray-700 {
                --tw-border-opacity: 1;
                border-color: rgb(55 65 81 / var(--tw-border-opacity))
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity))
            }
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body class="antialiased">
<div
    class="before:block before:absolute before:h-48 before:bg-emerald-600 bg-[#00a783] before:w-full before:top-0 relative flex justify-center min-h-screen bg-gradient-to-b from-slate-200 to-slate-400 py-4 sm:pt-14 sm:pt-0">
    <div class="mx-auto sm:px-6 pt-16 lg:px-8 w-11/12" style="max-height:880px">
        <div class="flex h-full">
            <div class="basis-1/3 z-10 bg-white flex flex-col">
                <div class="flex bg-slate-200 h-16 space-x-2 px-6 flex-nowrap items-center border-right">
                    <div class="flex items-center h-full">
                        <div class="avatar rounded-full w-12 h-12 bg-slate-500"
                             @if ($currentUser->avatar) style="background-image: url({{$currentUser->avatar->link}}); @endif background-size: cover">
                        </div>
                    </div>
                    <div class="status text-ellipsis whitespace-nowrap w-64 overflow-hidden">
                        {{ $currentUser->description }}
                    </div>
                    <div
                        class="control-buttons text-gray-500 text-[18px] flex justify-end space-x-6 mr-6 items-center flex-1 h-full">
                        <i class="fa-solid fa-message"></i>
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </div>
                </div>
                <div class="border-r border-b border-slate-200">
                    <div class="flex h-10 px-4 items-center drop-shadow">
                        <label class="relative block flex-1">
                            <span class="sr-only">Search</span>
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <i class="fa-solid fa-magnifying-glass text-slate-400"></i>
                        </span>
                            <input
                                class="border-none text-slate-600 placeholder:text-slate-500 block bg-slate-200 w-full border rounded-md py-1 pl-10 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                placeholder="Поиск или новый чат" type="text" name="search"/>
                        </label>
                        <i class="sort-messages text-slate-400 pl-4 fa-solid fa-filter"></i>
                    </div>
                </div>

                <div
                    class="border-r-[1px] flex-1 border-slate-200 overflow-y-auto overflow-hidden scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-white-100">
                    <ul role="tablist" class="" aria-orientation="vertical">
                        @forelse($chats as $chat)
                            <li id="chat-{{ $chat->id }}"
                                class="chat-tab hover:bg-slate-100 cursor-pointer px-2 flex"
                                data-chat-id="{{ $chat->id }}"
                                aria-controls="chat-{{$chat->id}}-panel" role="tab">
                                <div class="flex items-center h-full py-4">
                                    <div class="avatar rounded-full w-12 h-12 bg-slate-500"
                                         style="background-image: url({{$chat->avatar->link}}); background-size: cover; background-position: center;">
                                    </div>
                                </div>
                                <div class="border-t flex-1 flex flex-col justify-center pl-2">
                                    <div class="flex">
                                        <div class="flex-1">{{ $chat->name }}</div>
                                        <div
                                            class="text-[12px] text-slate-600">{{ optional($chat->lastMessage)->created_at->format("H:m") }}</div>
                                    </div>
                                    <div
                                        class="w-[400px] text-slate-500 text-[14px] text-ellipsis whitespace-nowrap overflow-hidden">
                                        @if (optional($chat->lastMessage)->user->is($currentUser))
                                            <x-message-status :message="$chat->lastMessage"></x-message-status>
                                        @endif
                                        {{ optional($chat->lastMessage)->text }}
                                    </div>
                                </div>
                            </li>
                        @empty

                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="flex basis-2/3 z-10">
                <div class="chat-panel chat-preview flex flex-1 flex-col w-100">
                    <div class="flex space-x-2 px-6 border-l-[1px] border-slate-300 bg-slate-200 h-16 w-full">
                        <div class="flex items-center h-full">
                            <div class="avatar rounded-full w-12 h-12 bg-slate-500">

                            </div>
                        </div>
                        <div class="flex flex-col justify-center flex-1">
                            <div>
                                No name
                            </div>
                            <div class="text-[12px] text-slate-500">
                                был(-а) сегодня в 00:00
                            </div>
                        </div>
                        <div
                            class="control-buttons text-gray-500 text-[18px] flex justify-end space-x-6 mr-6 items-center h-full">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </div>
                    </div>
                    <div class="flex-1 chat-content"
                         style="background: url({{ asset('images/messages_background.jpg') }}); background-size: contain;">

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
                            placeholder="Введите сообщение" type="text" name="search"
                            style="resize: none;"
                        ></textarea>
                        </div>
                        <div>
                            <i class="fa-solid fa-microphone"></i>
                        </div>
                    </div>
                </div>
                @forelse($chats as $chat)
                    <x-chat-view :chat="$chat"></x-chat-view>
                @empty

                @endforelse
            </div>
            <div class="flex h-16">
            </div>
        </div>
    </div>
</div>
@vite('resources/js/app.js')
<script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
</body>
</html>
