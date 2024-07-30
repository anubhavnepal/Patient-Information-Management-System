// script.js

document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function(event) {
        const uniqueId = document.getElementById('unique_id').value.trim();
        const password = document.getElementById('password').value.trim();

        if (uniqueId === '' || password === '') {
            alert('Please fill in all fields.');
            event.preventDefault();
        }
    });
});
