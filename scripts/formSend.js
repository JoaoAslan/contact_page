import { showNotification } from "./uiService.js"

const form = document.querySelector('form');
 
form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    const result = await fetchData(data);
    if (result.success) {
        showNotification();
    }
    console.log(result);
});

async function fetchData(data) {
    try {
        const response = await fetch('http://localhost/projeto_contact/formValidation.php', {
            method: "POST",
            cors: "*",
            headers: {
                "Content-Type": "application/json; charset=utf-8"
            },
            "body": JSON.stringify(data)
        });
        const result = response.json();
        return result;
    } catch (err) {
        console.error('Error on fetching formValidation.php: ', err);
        return {
            "success": false,
            "message": "Error on fetching...",
        }
    };
}