import './bootstrap';
import {Chat, Input, Panel} from './chat.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let currentUser;

inputs.forEach(function (input) {

})


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
    let chat = new Chat(tab, new Panel(panel, content), currentUser);
    let input = new Input(panel.querySelector('.message-input'), chat);
    input.htmlElement.addEventListener('keyup', input.onKeyUp)

    return chat;
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

    chat.panel.container.addEventListener('dragover', (event) => {
        event.stopPropagation();
        event.preventDefault();
        event.dataTransfer.dropEffect = 'copy';

    });

    chat.panel.container.addEventListener('drop', (event) => {
        event.stopPropagation();
        event.preventDefault();

        const fileList = event.dataTransfer.files;
        const attacments = chat.panel.container.querySelector(".attachments")
        const attachmentContainer = chat.createAttachmentContainer(attacments)

        attacments.append(attachmentContainer)

        attachmentContainer.querySelector('.attachment-name').textContent = fileList[0].name;

        chat.saveImage(fileList[0], attachmentContainer.querySelector('.attachment-photo'));
    });
})

