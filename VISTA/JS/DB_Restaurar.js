document.addEventListener("DOMContentLoaded", function() {
    const formRestaurar = document.getElementById("formRestaurar");

    formRestaurar.addEventListener("submit", function(event) {
        event.preventDefault(); 

        Swal.fire({
            title: '¿Estás seguro de restaurar este archivo SQL?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, restaurar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                formRestaurar.submit(); 
            }
        });
    });

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('restore') === 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Base de datos restaurada',
            text: 'La base de datos se ha restaurado exitosamente.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Cerrar'
        }).then(() => {
            window.history.replaceState({}, document.title, window.location.pathname);
        });
    }
});
