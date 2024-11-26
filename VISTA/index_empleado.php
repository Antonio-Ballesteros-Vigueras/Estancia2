<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

if ($_SESSION['tipo_usuario'] !== 'empleado') {
    header("Location: ../VISTA/Login.php");
    exit();
}

$userEmail = $_SESSION['correo_usuario'];

if (isset($_SESSION['login_success'])) {
    $message = $_SESSION['login_success'];
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
            window.onload = function() {
                Swal.fire({
                    icon: "success",
                    title: "' . $message . '",
                    showConfirmButton: false,
                    timer: 2000
                });
            };
          </script>';
    unset($_SESSION['login_success']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>
    <link rel="stylesheet" href="../VISTA/CSS/Index_Empleado.css">
    </head>
<body>

<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="">
    </div>
    <ul>
        <div class="items">            
            <li><a href="">Perfil de: <?php echo $userEmail; ?></a></li>
            <li><a href="../CONTROLADOR/logout.php" class="btn">Cerrar Sesión</a></li>
        </div>            
    </ul>
</nav>

<section class="contacto">
    <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Vista_GestionarCatalogoEmpleado.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-icon"> <br>Catálogo
            </a>
        </p>
    </div>

    <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Vista_Update_MaquilaEmpleado.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-icon"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Vista_GestionarCotizacionesEmpleado.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-icon"> <br>Cotizaciones
            </a>
        </p>
    </div>
</section>

<section class="bienvenida">
    <h1>¡Bienvenido Empleado!</h1>
</section>

    <?php include 'includes/footer.php'; ?>

</body>
</html>
