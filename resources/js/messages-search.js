import {Chat, Input, Panel} from "@/chat";
import {chatPreview, chats, currentUser} from "./app";

let chatsMain = null;
let chatsSearch = null;
let messagesSearch = null;
let messagesSearchContent = null;

document.addEventListener("DOMContentLoaded", function () {
    let search = document.querySelector('input[name=search]');

    chatsMain = document.querySelector('.chats-main');
    chatsSearch = document.querySelector('.chats-search');
    messagesSearch = document.querySelector('.messages-search');

    let delay = null;
    search.oninput = function () {
        let search = this.value;

        if (delay) {
            clearTimeout(delay);
        }

        setTimeout(() => {
            if (search === '') {
                chatsMain.style.display = "block";
                chatsSearch.style.display = "none";
                messagesSearch.style.display = "none";
            } else {
                searchInChats(search);
            }
        }, 200)
    };
});

async function searchInChats(search) {
    const data = new FormData();
    data.append('text', search);

    let csrfToken = document.querySelector('#csrf_token').getAttribute('value');

    let response = await fetch('chats/search', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : csrfToken,
            'Accept': 'application/json'
        },
        body: data
    });

    if (response.ok) {
        response.json().then(response => {
            let chats = response.data.chats;
            let messages = response.data.messages;



            createObject(chats, chatsSearch);
            createObject(messages, messagesSearch);
        });
    }

    function createObject(object, container) {
        container.innerHTML = null;
        container.style.display = "block";
        chatsMain.style.display = "none";

        for (const [index, elements] of Object.entries(object)) {
            for (const [, element] of Object.entries(elements)) {
                let div = document.createElement('div');

                div.innerHTML = `
                            <li id="chat-${ element.chat_id }"
                                    class="chat-tab hover:bg-slate-100 cursor-pointer px-2 flex"
                                    data-chat-id="${ element.chat_id }"
                                    aria-controls="chat-${ element.chat_id }-panel" role="tab">
                                    <div class="flex items-center h-full py-4">
                                        <div class="avatar rounded-full w-12 h-12 bg-slate-500"
                                             style="background-image: url(); background-size: cover; background-position: center;">
                                        </div>
                                    </div>
                                    <div class="border-t flex-1 flex flex-col justify-center pl-2">
                                        <div class="flex">
                                            <div class="flex-1">${ element.name }</div>
                                            <div
                                                class="text-[12px] text-slate-600">${ element.created_at }</div>
                                        </div>
                                        <div
                                            class="w-[400px] text-slate-500 text-[14px] text-ellipsis whitespace-nowrap overflow-hidden">
                                       ${ element.text }
                                    </div>
                                </div>
                            </li>
                            `

                let panel = document.querySelector(`#chat-${ element.chat_id }-panel`)
                let content = panel.querySelector('.chat-content');
                let chat = new Chat(div, new Panel(panel, content), currentUser);
                let input = new Input(panel.querySelector('.message-input'), chat);
                input.htmlElement.addEventListener('keyup', event => input.onKeyUp(event))

                chat.tab.onclick = () => {
                    chats.forEach(chat => chat.close())
                    chatPreview.close()
                    chat.open();
                }

                container.appendChild(div);
            }
        }
    }
}
