const box_notify = document.querySelector('.notification');

export function showNotification() {
    box_notify.classList.add('show');
    setTimeout(() => {
        box_notify.classList.remove('show');
    }, 5000)
}