<?php
include '../MODELO/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

if ($_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: ../VISTA/Login.php");
    exit();
}

$userEmail = $_SESSION['correo_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naturales ARTROM</title>
    <link rel="stylesheet" href="../VISTA/CSS/Solicitud_Cliente.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<body>

<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="">
    </div>
    <ul>
        <div class="items">            
            <li><a href="../VISTA/index_administrador.php"> <img src="../VISTA/IMG/inicio-icon.png" alt="Inicio" class="social-iconI"> <br>
            </a></li>
            <li><a href="">Perfil de: <?php echo $userEmail; ?></a></li>
            <li><a href="../CONTROLADOR/logout.php" class="btn">Cerrar Sesión</a></li>
        </div>            
    </ul>
</nav>

<section class="contactoD">
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCatalogo.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-iconD"> <br>Catálogo
            </a>
        </p>
    </div>
    <div class="contact-item2D social-mediaD">
        <p>
            <a href="../VISTA/Gestionar_Usuarios.php">
                <img src="../VISTA/IMG/usuario-icon.png" alt="Instagram" class="social-iconD"> <br>Usuarios
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_Update_Maquila.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-iconD"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCotizaciones.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Respaldo_DB.php">
                <img src="../VISTA/IMG/respaldo-icon.png" alt="Instagram" class="social-iconD"> <br>Base de datos
            </a>
        </p>
    </div>
</section>

<section class="texto">
    <h1>Lista de Solicitudes de Registro de Clientes</h1>
</section>

<table class="table table-success table-striped-columns">
    <thead>
        <tr>
            <th><p>Nombres</p></th>
            <th><p>Apellido Paterno</p></th>
            <th><p>Apellido Materno</p></th>
            <th><p>Fecha de Nacimiento</p></th>
            <th><p>Teléfono</p></th>
            <th><p>Cédula</p></th>
            <th><p>Correo Electrónico</p></th>
        </tr>
    <thead>

    <?php
        $sql = "SELECT *FROM PreRegistroClientes";
        $execute=mysqli_query($conn, $sql);
        while($rows=mysqli_fetch_array($execute)){
    ?>
            <tr>
                <th> <?php echo $rows['Nombres']; ?> </th>
                <th> <?php echo $rows['ApellidoPaterno']; ?> </th>
                <th> <?php echo $rows['ApellidoMaterno']; ?> </th>
                <th> <?php echo $rows['FechaNacimiento']; ?> </th>
                <th> <?php echo $rows['Telefono']; ?> </th>
                <th> <?php echo $rows['Cedula']; ?> </th>
                <th> <?php echo $rows['CorreoElectronico']; ?> </th>
                <th><a href="../CONTROLADOR/Create_Cliente.php?IDCliente=<?php echo $rows['IDCliente']?>"><img src="../VISTA/IMG/autorizar-icon.png" width="30" height="30"></a></th>
                <th><a href="#" onclick="confirmarEliminacion(<?php echo $rows['IDCliente']; ?>)"><img src="../VISTA/IMG/eliminar-icon.png" width="30" height="30"></a></th>
            </tr>
    <?php } ?>
</table>

<?php include 'includes/footer.php'; ?>

<script>
function confirmarEliminacion(idCliente) {
    Swal.fire({
        title: '¿Estás seguro de eliminar esta solicitud de registro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("../CONTROLADOR/Delete_PreRegistro.php?IDCliente=" + idCliente)
                .then(response => {
                    if (response.ok) {
                        Swal.fire(
                            'Eliminado',
                            'Solicitud de preregistro eliminada con éxito.',
                            'success'
                        ).then(() => {
                            window.location.reload(); 
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            'No se pudo eliminar la solicitud.',
                            'error'
                        );
                    }
                });
        } else {
            Swal.fire(
                'Cancelado',
                'La eliminación ha sido cancelada.',
                'info'
            );
        }
    });
}
</script>

</body>
</html>
