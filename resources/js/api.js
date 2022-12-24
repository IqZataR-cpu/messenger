let csrfToken = document.querySelector('#csrf_token').getAttribute('value');

export async function getCurrentUser() {
    return fetch('/me');
}

export async function getChatMessages(id, messagesOffset) {
    return fetch(`/chats/${id}/messages?offset=${messagesOffset}`)
}

export async function sentMessage(message, attachments, chatId) {
    const url = `/chats/${chatId}/sent-message`

    const data = {
        _token: csrfToken,
        message: message,
        attachments: attachments,
    };

    return fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
}
