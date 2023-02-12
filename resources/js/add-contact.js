import {findContacts, addContact} from './api'

let contactModal = document.querySelector('.add-contact-form');
let contactModalWaitingElement = contactModal.querySelector('.waiting-element');
let contactModalSearch = document.querySelector('.add-contact-form-search');
let delay = null;

contactModalSearch.addEventListener('keydown', e => {
    if (delay) {
        clearTimeout(delay);
    }

    contactModalWaitingElement.classList.remove('hidden');

    delay = setTimeout(() => {
        findContacts(contactModalSearch.value)
            .then(resp => resp.json())
            .then(resp => {
                contactModal.lastElementChild.lastElementChild.innerHTML = '';

                if (!resp) {
                    return;
                }

                contactModal.lastElementChild.lastElementChild.append(renderContacts(resp))
                contactModalWaitingElement.classList.add('hidden');
            })
    }, 200)
})

function renderContacts(contacts) {
    let container = document.createElement('div');

    for (const contactsGroupName in contacts) {
        let contactsGroup = document.createElement('div');
        let contactsGroupNameContainer = document.createElement('div');
        contactsGroupNameContainer.classList.value = 'h-16 flex items-center text-emerald-600 ti-[30px]';
        contactsGroupNameContainer.innerHTML = contactsGroupName;

        contactsGroup.append(contactsGroupNameContainer);

        for (const contact of contacts[contactsGroupName]) {
            let contactContainer = createContactBlock(contact);

            contactContainer.addEventListener('click', () => {
                addContact(contact.id)
                    .then(resp => {
                        if (resp.status === 500) {
                            throw new Error(response.message);
                        }

                        return resp.json()
                    })
                    .then(() => {
                        let successContainer = document.createElement('div');
                        successContainer.innerHTML = 'Успешно'
                        successContainer.classList.value = 'flex justify-center items-center text-emerald-600 font-16';
                        contactContainer.before(successContainer);
                        contactContainer.remove();

                        setTimeout(() => {
                            contactContainer.remove();
                            successContainer.remove();

                            if (contactsGroup.children.length <= 1) {
                                contactsGroup.remove();
                            }
                        }, 2000)
                    })
                    .catch((exception) => {
                        let errorContainer = document.createElement('div');
                        errorContainer.innerHTML = 'Ошибка'
                        errorContainer.classList.value = 'flex justify-center items-center text-red-600 font-16';
                        contactContainer.before(errorContainer);
                        contactContainer.classList.add('hidden');

                        setTimeout(() => {
                            contactContainer.classList.remove('hidden');
                            errorContainer.remove();
                        }, 2000)

                        throw exception;
                    })
            })

            contactsGroup.append(contactContainer);
        }

        container.append(contactsGroup);
    }

    return container;
}

function createContactBlock(contact) {
    let contactContainer = document.createElement('div');
    contactContainer.id = `contact-${contact.id}`
    contactContainer.classList.value = "contact-tab hover:bg-slate-100 cursor-pointer px-2 flex";
    contactContainer.dataset.contactId = contact.id;

    contactContainer.append(
        createAvatarContainer(
            contact.avatar.hasOwnProperty('link')
                ? contact.avatar.link
                : ''
        )
    );
    contactContainer.append(createContactDescriptionContainer(contact.name, contact.description, contact.login))

    return contactContainer;
}

function createAvatarContainer(link) {
    let container = document.createElement('div');
    let avatar = document.createElement('div');

    container.classList.value = 'flex items-center h-full py-4';
    avatar.classList.value = 'avatar rounded-full w-12 h-12 bg-slate-500';

    if (link) {
        avatar.style.backgroundImage = `url(${link})`;
    }

    container.append(avatar);

    return container;
}

function createContactDescriptionContainer(name, description, login) {
    let container = document.createElement('div');
    let nameContainer = document.createElement('div');
    let loginContainer = document.createElement('span');
    let descriptionContainer = document.createElement('div');

    container.classList.value = 'border-t flex-1 flex flex-col justify-center pl-2';
    loginContainer.classList.value = 'text-[12px] text-slate-600';
    descriptionContainer.classList.value = 'w-[400px] text-slate-500 text-[14px] ' +
        'text-ellipsis whitespace-nowrap overflow-hidden';

    nameContainer.innerHTML = name;
    loginContainer.innerHTML = ' (' + login + ')';
    descriptionContainer.innerHTML = description;

    container.append(nameContainer, descriptionContainer);
    nameContainer.append(loginContainer);

    return container;
}
