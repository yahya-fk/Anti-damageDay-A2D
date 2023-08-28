const buttons = document.querySelectorAll('.div-link');
const forms = document.querySelectorAll('.div-container');

buttons.forEach(button => {
    button.addEventListener('click', () => {
        const target = button.getAttribute('data-target');
        forms.forEach(form => {
            if (form.id === target) {
                form.style.display="block"
            } else {
                form.style.display="none"
            }
        });
    });
});


