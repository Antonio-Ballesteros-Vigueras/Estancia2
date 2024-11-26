function validarRegistro() {
    const email = document.getElementById("email").value;
    const verificarEmail = document.getElementById("verificarEmail").value;
    const nombre = document.getElementById("nombre").value;
    const apellidoPaterno = document.getElementById("apellidoPaterno").value;
    const apellidoMaterno = document.getElementById("apellidoMaterno").value;
    const fechaNacimiento = document.getElementById("fechaNacimiento").value;
    const telefono = document.getElementById("telefono").value;
    const cedula = document.getElementById("cedula").value;
    const cedulaArchivo = document.getElementById("cedulaArchivo").files[0];

    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!emailRegex.test(email)) {
        Swal.fire({
            icon: 'error',
            title: '¡ERROR en Correo Electrónico!',
            text: '¡Ingresa un correo válido, como ejemplo@gmail.com!'
        });
        return false;
    }

    if (email !== verificarEmail) {
        Swal.fire({
            icon: 'error',
            title: '¡ERROR en Correo Electrónico!',
            text: '¡Los correos electrónicos no coinciden!'
        });
        return false;
    }

    const nombreRegex = /^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)?$/; 
    const apellidoRegex = /^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$/;

    if (!nombreRegex.test(nombre)) {
        Swal.fire({
            icon: 'warning',
            title: '¡ERROR en Nombre!',
            text: '¡Ingresa máximo dos nombres válidos que inicien con mayúscula!'
        });
        return false;
    }

    if (!apellidoRegex.test(apellidoPaterno)) {
        Swal.fire({
            icon: 'warning',
            title: '¡ERROR en A.Paterno!',
            text: '¡Ingresa máximo un Apellido válido que inicie con mayúscula!'
        });
        return false;
    }

    if (!apellidoRegex.test(apellidoMaterno)) {
        Swal.fire({
            icon: 'warning',
            title: '¡ERROR en A.Materno!',
            text: '¡Ingresa máximo un Apellido válido que inicie con mayúscula!'
        });
        return false;
    }

    const hoy = new Date();
    const fechaNacimientoObj = new Date(fechaNacimiento);
    const edad = hoy.getFullYear() - fechaNacimientoObj.getFullYear();
    const mes = hoy.getMonth() - fechaNacimientoObj.getMonth();
    const dia = hoy.getDate() - fechaNacimientoObj.getDate();

    if (edad < 18 || (edad === 18 && (mes < 0 || (mes === 0 && dia < 0)))) {
        Swal.fire({
            icon: 'warning',
            title: '¡ERROR en Fecha de Nacimiento!',
            text: '¡Debes tener al menos 18 años para registrarte!'
        });
        return false;
    }

    const fechaLimite = new Date('1940-01-01');
    if (fechaNacimientoObj < fechaLimite) {
        Swal.fire({
            icon: 'warning',
            title: '¡ERROR en Fecha de Nacimiento!',
            text: '¡Ingresa una Fecha lógica!'
        });
        return false;
    }

    if (cedulaArchivo.type !== "application/pdf") {
        Swal.fire({
            icon: 'warning',
            title: '¡ERROR en Archivo!',
            text: '¡El archivo debe ser un PDF!'
        });
        return false;
    }

    if (cedulaArchivo.size > 10485760) { 
        Swal.fire({
            icon: 'warning',
            title: '¡ERROR en Archivo!',
            text: '¡El archivo no debe exceder 10MB!'
        });
        return false;
    }

    return true;
}
