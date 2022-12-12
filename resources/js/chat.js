"use strict";
const DAY_IN_MICROSECONDS = 86400000;
const DAYS = [
    'Воскресенье',
    'Понедельник',
    'Вторник',
    'Среда',
    'Четверг',
    'Пятница',
    'Суббота'
];

export class Chat {
    panel;
    tab;
    messagesOffset = 10;
    MESSAGES_LIMIT = 10;
    isMessagesFetching;
    currentUser;

    constructor(chatTab, chatPanel, currentUser) {
        this.panel = chatPanel;
        this.tab = chatTab;
        this.currentUser = currentUser;
    }

    open()
    {
        this.panel.container.removeAttribute('style');
        this.panel.contentContainer.scrollTop = this.panel.contentContainer.scrollHeight;
    }

    close()
    {
        this.panel.container.style.display = 'none';
    }

    getId()
    {
        return this.panel.container.dataset.chatId;
    }

    getOffsetMessages() {
        return this.offset;
    }

    getLastViewedDay() {
        return this.panel.contentContainer.querySelector('.day-container');
    }

    findViewedDay(rawDay) {
        return this.panel.contentContainer.querySelector(`.day-container[data-raw-day="${rawDay}"]`);
    }

    async loadMessages() {
        if (this.isMessagesFetching) {
            return;
        }

        this.isMessagesFetching = true;

        fetch(`/chats/${this.getId()}/messages?offset=${this.messagesOffset}`)
            .then(resp => resp.json())
            .then(async response => {
                let messages = [...response.data];

                if (messages.length === 0) {
                    return null;
                }

                let lastViewedDay = this.getLastViewedDay();
                let lastViewedUser = this.getLastViewedUser();
                let currentBlock = lastViewedUser;
                let tempBlock = null;

                messages.forEach(message => {
                    let viewedDay = this.findViewedDay(message.created_at);

                    if (viewedDay) {
                        lastViewedDay = viewedDay;
                        currentBlock = viewedDay.parentElement;
                        lastViewedUser = viewedDay.nextElementSibling.classList.contains('.user-cards-container')
                            ? viewedDay.nextElementSibling
                            : lastViewedUser;
                    }

                    if (message.created_at !== lastViewedDay.dataset.rawDay) {
                        lastViewedDay = createDayContainer(message.created_at);
                        this.panel.contentContainer.prepend(lastViewedDay);
                        currentBlock = lastViewedDay;
                        lastViewedDay = lastViewedDay.firstElementChild;
                    }
                    debugger;
                    if (message.user.id != lastViewedUser.dataset.userId) {
                        lastViewedUser = createUserContainer(message.user);
                        currentBlock.after(lastViewedUser);
                        currentBlock = lastViewedUser;
                    }

                    tempBlock = createMessageContainer(message);
                    currentBlock.after(tempBlock);
                    currentBlock = tempBlock;
                })

                this.messagesOffset += this.MESSAGES_LIMIT;
                this.isMessagesFetching = false;
            })
    }

    getLastViewedUser() {
        return this.panel.contentContainer.querySelector('.user-cards-container');
    }
}

export class Panel {
    container;
    contentContainer;

    constructor(container, contentContainer) {
        this.container = container;
        this.contentContainer = contentContainer;
    }
}


export class Input {
    ENTER_KEY_CODE = 9;
    htmlElement;

    constructor(htmlElement) {
        this.htmlElement = htmlElement;
    }

    resizeArea(minHeight, maxHeight) {
        let offsetHeight = 10;

        String(this.htmlElement.value).split("\n").forEach(function (s) {
            offsetHeight += 30;
        });

        let height = offsetHeight;
        height = Math.max(minHeight, height);
        height = Math.min(maxHeight, height);
        this.htmlElement.style.height = height + 'px';
    }

    handleEnterKey(event) {
        if (event.keyCode !== this.ENTER_KEY_CODE && event.shiftKey)
        {
            return;
        }

        event.preventDefault();
        sendMessage(this);
    }
}

function createUserContainer(user)
{
    let div = document.createElement('div')
    div.classList.value = 'mt-2 user-cards-container';
    div.dataset.userId = user.id;
    return div;
}

function createAvatarContainer(link) {
    let container = document.createElement('div');
    let avatar = document.createElement('div');

    container.classList.value = 'flex items-center h-full';
    avatar.classList.value = 'avatar rounded-full w-8 h-8 bg-slate-500';
    avatar.style.backgroundImage = `url(${link})`;

    container.append(avatar);

    return container;
}

function createMessageContainer(message)
{
    let container = document.createElement('div');
    container.classList.value = 'message-card w-[80%] mt-2 relative';
    let messageHeader = document.createElement('div');
    messageHeader.classList.value = 'text-[12px] flex items-end gap-2 font-bold mb-2';

    let phoneContainer = document.createElement('span');
    phoneContainer.innerHTML = message.user.phone;
    let nameContainer = document.createElement('span');
    nameContainer.innerHTML = message.user.name;

    messageHeader.append(createAvatarContainer(message.user.avatar.link), phoneContainer, nameContainer);
    container.append(messageHeader);

    if (message.attachment) {
        let attachmentContainer = document.createElement('img');
        attachmentContainer.src = message.attachment.link;
        attachmentContainer.classList.value = 'sm:max-w-[380px] sm:max-h-[380px] rounded-md';
        attachmentContainer.alt = 'image';
        container.append(attachmentContainer);
    }

    let messageContent = document.createElement('div');
    messageContent.classList.value = 'text-[15px]';
    messageContent.innerHTML = message.text;
    let metaMessageContent = document.createElement('span');
    metaMessageContent.append('absolute bottom-1 right-1 text-slate-500 text-[12px]');

    if (message.is_edited) {
        metaMessageContent.innerHTML = 'изменено <i class="far fa-edit"></i>' + message.date;
    }

    messageContent.append(metaMessageContent);
    container.append(messageContent);

    if (message.is_mine) {
        messageHeader.classList.add('flex-row-reverse');
        container.classList.add('mine', 'ml-auto');
    }

    return container;
}

function createDayContainer(date)
{
    let container = document.createElement('div');
    container.classList.value = 'flex justify-center sticky top-0 mt-4 z-10';
    let day = document.createElement('div');
    day.classList.value = 'day-container text-center w-[120px] h-[40px] bg-gray-200 text-gray-800 font-bold ' +
        'text-sm font-medium p-2.5 rounded-full dark:bg-gray-700 dark:text-gray-300';
    day.dataset.rawDay = date;

    let dayName = new Date(date);
    let now = new Date();

    var today = new Date(now.getFullYear(), now.getMonth(), now.getDate()).valueOf();
    var other = dayName.valueOf();

    if (other < today - DAY_IN_MICROSECONDS * 5) {
        dayName = `${dayName.getDate()}.${dayName.getMonth() + 1}.${dayName.getFullYear()}`;
    } else if (other < today - DAY_IN_MICROSECONDS * 2) { // 24*60*60*1000
        dayName = DAYS[dayName.getDay()];
    } else if (other < today - DAY_IN_MICROSECONDS) { // 24*60*60*1000
        dayName = 'Позавчера';
    } else if (other < today) {
        dayName = 'Вчера';
    } else {
        dayName = 'Сегодня';
    }

    day.innerHTML = dayName;
    container.append(day);

    return container;
}

function sendMessage(input)
{

}
