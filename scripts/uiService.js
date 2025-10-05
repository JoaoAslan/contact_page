const box_notify = document.querySelector('.notification');
const btn_send = document.querySelector('.btn-submit');

function showNotification() {
    box_notify.classList.add('show');
    setTimeout(() => {
        box_notify.classList.remove('show');
    }, 5000)
}

btn_send.addEventListener('click', (e) => {
    e.preventDefault();
    showNotification();
});