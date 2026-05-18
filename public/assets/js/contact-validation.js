document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('contactForm');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        var name = form.querySelector('[name="sender_name"]').value.trim();
        var email = form.querySelector('[name="sender_email"]').value.trim();
        var subject = form.querySelector('[name="subject"]').value.trim();
        var message = form.querySelector('[name="message_body"]').value.trim();
        var errors = [];

        if (!name) errors.push('Name is required.');
        if (!email || !/^\S+@\S+\.\S+$/.test(email)) errors.push('Valid email is required.');
        if (!subject) errors.push('Subject is required.');
        if (!message) errors.push('Message is required.');

        if (errors.length > 0) {
            event.preventDefault();
            alert(errors.join('
'));
        }
    });
});
