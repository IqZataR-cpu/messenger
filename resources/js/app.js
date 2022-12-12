import './bootstrap';
import {Chat, Panel} from './chat.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let currentUser;

await fetch('/me')
    .then(response => response.json())
    .then(response => currentUser = response);

let previousY = 0;
let chatPreviewPanelContainer = document.querySelector('.chat-preview')
let chatPreview = new Chat(
    null,
    new Panel(chatPreviewPanelContainer, chatPreviewPanelContainer.querySelector('.chat-content')),
    currentUser
);
let chatTabs = [...document.querySelectorAll('.chat-tab')];

let chats = chatTabs.map(tab => {
    let panel = document.querySelector(`#${tab.getAttribute('aria-controls')}`)
    let content = panel.querySelector('.chat-content');

    return new Chat(tab, new Panel(panel, content), currentUser);
})

chats.forEach(chat => {
    chat.close()
    chat.tab.onclick = () => {
        chats.forEach(chat => chat.close())
        chatPreview.close()
        chat.open();
    }

    chat.panel.contentContainer.addEventListener('scroll', function(e) {
        let currentY = this.scrollTop;

        if (currentY < previousY && currentY === 0) {
            chat.loadMessages();
        }
        previousY = currentY;
    });
})
