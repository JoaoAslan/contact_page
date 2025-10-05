import { showNotification } from "./uiService.js"

const form = document.querySelector('form');
 
form.addEventListener('submit', (e) => {
    e.preventDefault();
    showNotification();

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
})