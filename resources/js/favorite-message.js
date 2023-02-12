document.addEventListener("DOMContentLoaded", function () {
    favoritesHandle();
});

function favoritesHandle() {
    let favorites = document.querySelectorAll('.favorites');

    favorites.forEach(function (favorite) {
        favorite.addEventListener('click', function (event) {
            let messageId = favorite.dataset.messageId;
            if (this.classList.contains('fa-regular')) {
                if (addToFavorites(messageId)) {
                    this.classList.remove("fa-regular");
                    this.classList.add("fa-solid");
                }
            } else {
                if (removeFromFavorites(messageId)) {
                    this.classList.remove("fa-solid");
                    this.classList.add("fa-regular");
                }
            }
        })
    })
}

async function addToFavorites(messageId) {
    return (await fetch('chats/favorite-messages/' + messageId + '/add')).ok;
}

async function removeFromFavorites(messageId) {
    return (await fetch('chats/favorite-messages/' + messageId + '/remove')).ok;
}
