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

    // formData.append('_token', csrfToken)
    formData.append('message', message)
    formData.append('attachments', attachments)

    console.log(csrfToken) 

    return fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : csrfToken,
            'Content-Type': 'multipart/form-data; boundary=something',
            // 'Content-Type': 'multipart/form-data',
        },

        body: formData
    })
}
