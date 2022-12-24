let csrfToken = document.querySelector('#csrf_token').getAttribute('value');

export async function getCurrentUser() {
    return fetch('/me');
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
