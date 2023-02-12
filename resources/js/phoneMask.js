import IMask from 'imask';

export function mask() {
    const phoneElements = document.getElementsByClassName('phone');
    const maskOptions = {
        mask: '+7(000)000-00-00',
        lazy: false
    };
    for (let item of phoneElements) {
        new IMask(item, maskOptions)
    }
}

