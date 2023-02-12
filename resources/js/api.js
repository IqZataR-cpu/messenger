let csrfTokenContainer = document.querySelector('#csrf_token');
let csrfToken = null;

if (csrfTokenContainer) {
    csrfToken = csrfTokenContainer.getAttribute('value')
}

export async function getCurrentUser() {
    return fetch('/me', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : csrfToken,
            'Accept': 'application/json'
        },
    });
}

export async function getChatMessages(id, messagesOffset) {
    return fetch(`/chats/${id}/messages?offset=${messagesOffset}`)
}

export async function sentMessage(message, attachments, chatId) {
    const url = `/chats/${chatId}/sent-message`
    let formData = new FormData();

    formData.append('message', message)
    attachments.forEach(attachment => formData.append('attachments[]', attachment))

    return fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : csrfToken,
            'Accept': 'application/json'
        },
        body: formData
    })
}

export async function getContacts()
{
    return fetch(`/contacts`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : csrfToken,
            'Accept': 'application/json'
        },
    })
}

export async function findContacts(search)
{
    return fetch(`/contacts/search`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({'search': search})
    })
}

export async function addContact(id)
{
    return fetch(`/contacts/add`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({'contact_id': id})
    })
}
