function validarRegistro() {
    const Nombres = document.getElementById("Nombres").value;
    const Apellido_Paterno = document.getElementById("Apellido_Paterno").value;
    const Apellido_Materno = document.getElementById("Apellido_Materno").value;
    const Fecha_Nacimiento = document.getElementById("Fecha_Nacimiento").value;
    const Telefono = document.getElementById("Telefono").value;
    const Correo_Electronico = document.getElementById("Correo_Electronico").value;

    const NombresRegex = /^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)?$/; 
    const ApellidoRegex = /^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$/;

    const CorreoRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!NombresRegex.test(Nombres)) {
        Swal.fire({
            icon: 'warning',
            title: '¡ERROR en Nombre!',
            text: '¡Ingresa máximo dos nombres válidos que inicien con mayúscula!'
        });
        return false;
    }

    if (!ApellidoRegex.test(Apellido_Paterno)) {
        Swal.fire({
            icon: 'warning',
            title: '¡ERROR en A.Paterno!',
            text: '¡Ingresa máximo un Apellido válido que inicie con mayúscula!'
        });
        return false;
    }

    if (!ApellidoRegex.test(Apellido_Materno)) {
        Swal.fire({
            icon: 'warning',
            title: '¡ERROR en A.Materno!',
            text: '¡Ingresa máximo un Apellido válido que inicie con mayúscula!'
        });
        return false;
    }

    const hoy = new Date();
    const fechaNacimientoObj = new Date(Fecha_Nacimiento);
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

    if (!CorreoRegex.test(Correo_Electronico)) {
        Swal.fire({
            icon: 'warning',
            title: '¡ERROR en Correo Electrónico!',
            text: '¡Ingresa un correo válido como ejemplo@gmail.com!'
        });
        return false;
    }

    return true; 
}
