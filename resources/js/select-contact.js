import {createChat, getContacts} from './api'
import {createContactBlock} from './add-contact'

let contactModal = document.querySelector('.select-contact-form');
let contactModalWaitingElement = contactModal.querySelector('.waiting-element');
let delay = null;

contactModal.addEventListener('show', e => {
    if (delay) {
        clearTimeout(delay);
    }

    contactModalWaitingElement.classList.remove('hidden');

    delay = setTimeout(() => {
        getContacts()
            .then(resp => resp.json())
            .then(resp => {
                contactModal.lastElementChild.lastElementChild.innerHTML = '';

                if (resp.length === 0) {
                    let notFoundContainer = document.createElement('div');
                    notFoundContainer.innerHTML = 'Контактов не найдено'
                    notFoundContainer.classList.value = 'flex justify-center items-center text-emerald-600 font-16 mt-4 ';
                    contactModal.lastElementChild.lastElementChild.append(notFoundContainer);
                    contactModalWaitingElement.classList.add('hidden');

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
                createChat([contact.id])
                    .then(resp => {
                        if (resp.status === 500) {
                            throw new Error(resp.message);
                        }

                        return resp.json()
                    })
                    .then(() => {
                        let successContainer = document.createElement('div');
                        successContainer.innerHTML = 'Успешно'
                        successContainer.classList.value = 'flex justify-center items-center text-emerald-600 font-16';
                        contactContainer.before(successContainer);
                        contactContainer.remove();
                        window.location.reload();
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
                        }, 1000)

                        throw exception;
                    })
            })

            contactsGroup.append(contactContainer);
        }

        container.append(contactsGroup);
    }

    return container;
}
