require('./bootstrap');

/**
 * Preview uploaded image
 */
const attachmentInput = document.querySelector('.attachment-input');
attachmentInput.addEventListener('change', function (event) {
    const output = document.querySelector('.attachment-preview');

    if (event.target.files.length == 0) {
        output.style.display = 'none';
        return;
    }

    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src) // free memory
    }

    output.style.display = 'block';
});

/**
 * Form submission
 */
const messageForm = document.querySelector('.message-form');
messageForm.addEventListener('submit', async function (event) {
    event.preventDefault();

    const textInput = document.querySelector('.text-input');

    attachmentInput.classList.remove('is-invalid');
    textInput.classList.remove('is-invalid');

    try {
        const formData = new FormData(event.target);

        await window.axios.post('/api/messages', formData);

        if (formData.get('id')) {
            window.location.href = '/';
        } else {
            window.location.reload();
        }

    } catch (e) {
        if (e.response.status == 422) {
            event.target.classList.add('is-invalid');

            if (e.response.data.errors.attachment) {
                const attachmentInput = document.querySelector('.attachment-input');
                attachmentInput.classList.add('is-invalid');
                attachmentInput.parentElement.querySelector('.invalid-feedback').textContent = e.response.data.errors.attachment[0];
            }

            if (e.response.data.errors.text) {
                textInput.classList.add('is-invalid');
                textInput.parentElement.querySelector('.invalid-feedback').textContent = e.response.data.errors.text[0];
            }
        }
    }
});