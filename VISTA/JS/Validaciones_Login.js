function validarLogin() {
    const email = document.getElementById("email").value;

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email && !emailRegex.test(email)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, ingresa un correo electrónico válido.'
        });
        return false; 
    }

    return true; 
}
