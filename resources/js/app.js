import axios from "axios";

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.baseURL = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port + "/";

const feedbackForm = document.getElementById('feedbackForm');

if (feedbackForm) {
    document.getElementById('feedbackSubmit').addEventListener('click', e => {
        e.preventDefault();

        const submitButton = e.target;
        const emailInput = document.querySelector('input[name=email]');
        const mailSendSuccessContainer = document.getElementById('mailSubscribeSendSuccess');
        const mailSendFailContainer = document.getElementById('mailSubscribeSendFail');
        const formErrorsContainer = document.getElementById('formSubscribeErrors');

        submitButton.setAttribute('disabled', true);
        mailSendFailContainer.style.display = 'none';
        mailSendSuccessContainer.style.display = 'none';
        mailSendFailContainer.style.display = 'none';
        formErrorsContainer.style.display = 'none';
        formErrorsContainer.innerHTML = '';

        axios.post('form/feedback', {
            email: emailInput.value
        }).then(response => {
            if (response.data && response.data.status) {
                if (response.data.status === 'success') {
                    mailSendSuccessContainer.style.display = 'block';
                    emailInput.value = '';
                }

                if (response.data.status === 'error') {
                    mailSendFailContainer.style.display = 'block';
                }
            }
        }).catch(error => {
            const response = error.response;

            let errorText = '';
            if (response.status && response.status === 422) {
                const errors = response.data.errors;
                for (const i in errors) {
                    errorText = errors[i] + '<br>';
                }
            }

            formErrorsContainer.style.display = 'block';
            formErrorsContainer.innerHTML = errorText;
        }).finally(() => {
            submitButton.removeAttribute('disabled');
        });
    });
}

const contactForm = document.getElementById('contactForm');

if (contactForm) {
    document.getElementById('contactSubmit').addEventListener('click', e => {
        e.preventDefault();

        const submitButton = e.target;
        const nameInput = document.querySelector('input[name=name]');
        const emailInput = document.querySelector('input[name=email]');
        const textInput = document.querySelector('textarea[name=message]');
        const mailSendSuccessContainer = document.getElementById('mailSendSuccess');
        const mailSendFailContainer = document.getElementById('mailSendFail');
        const formErrorsContainer = document.getElementById('formErrors');

        submitButton.setAttribute('disabled', true);
        mailSendFailContainer.style.display = 'none';
        mailSendSuccessContainer.style.display = 'none';
        formErrorsContainer.style.display = 'none';
        formErrorsContainer.innerHTML = '';

        axios.post('form/contact', {
            name: nameInput.value,
            email: emailInput.value,
            text: textInput.value
        }).then(response => {
            if (response.data && response.data.status) {
                if (response.data.status === 'success') {
                    mailSendSuccessContainer.style.display = 'block';
                    nameInput.value = '';
                    emailInput.value = '';
                    textInput.value = '';
                }

                if (response.data.status === 'error') {
                    mailSendFailContainer.style.display = 'block';
                }
            }
        }).catch(error => {
            const response = error.response;

            let errorText = '';
            if (response.status && response.status === 422) {
                const errors = response.data.errors;
                for (const i in errors) {
                    errorText += errors[i] + '<br>';
                }
            }

            formErrorsContainer.style.display = 'block';
            formErrorsContainer.innerHTML = errorText;
        }).finally(() => {
            submitButton.removeAttribute('disabled');
        });
    });
}
