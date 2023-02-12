let modalOpenBtns = document.querySelectorAll('.modal-open-button');

modalOpenBtns.forEach(modalOpenBtn => {
    modalOpenBtn.addEventListener('click', e => {
        let modal = document.querySelector(`.${modalOpenBtn.dataset.target}`);
        modal.style.display = 'flex';
        modal.dispatchEvent(new Event('show'));
    })
})

let modalCloseBtns = document.querySelectorAll('.modal-close-button');

modalCloseBtns.forEach(modalCloseBtn => {
    modalCloseBtn.addEventListener('click', e => {
        let modal = modalCloseBtn.parentElement.parentElement;
        modal.style.display = 'none';
        modal.dispatchEvent(new Event('hide'));
    })
})

