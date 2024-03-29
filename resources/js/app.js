import './bootstrap';
import {Chat, Input, Panel} from './chat.js';
import {mask as phoneMask} from './phoneMask';

import Alpine from 'alpinejs';
import {getCurrentUser} from "./api";
import "./dropdown";
import "./add-contact";
import "./select-contact";
import "./modal";

export var currentUser;
export var chatPreview;
export var chats;

window.Alpine = Alpine;

Alpine.start();

phoneMask();

(async (d, w) => {
    await getCurrentUser()
        .then(response => response.json())
        .then(response => currentUser = response);

    let previousY = 0;
    let chatPreviewPanelContainer = document.querySelector('.chat-preview')
    chatPreview = new Chat(
        null,
        new Panel(chatPreviewPanelContainer, chatPreviewPanelContainer.querySelector('.chat-content')),
        currentUser
    );
    var chatTabs = [...document.querySelectorAll('.chat-tab')];

    chats = chatTabs.map(tab => {
        let panel = document.querySelector(`#${tab.getAttribute('aria-controls')}`)
        let content = panel.querySelector('.chat-content');
        let chat = new Chat(tab, new Panel(panel, content), currentUser);
        let input = new Input(panel.querySelector('.message-input'), chat);
        input.htmlElement.addEventListener('keyup', event => input.onKeyUp(event))

        return chat;
    })

    chats.forEach(chat => {
        chat.close()
        chat.tab.onclick = () => {
            chats.forEach(chat => chat.close())
            chatPreview.close()
            chat.open();
        }

        chat.panel.contentContainer.addEventListener('scroll', function (e) {
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

})(document, window);
