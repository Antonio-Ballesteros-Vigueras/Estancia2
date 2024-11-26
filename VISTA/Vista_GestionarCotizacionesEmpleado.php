<?php
include '../MODELO/db.php';
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="../VISTA/CSS/Gestionar_Usuarios.css">
    <script src="Static/js/Carruselindex.js" defer></script>
</head>
<body>

<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="">
    </div>
    <ul>
        <div class="items">            
            <li><a href="../VISTA/index_empleado.php"> <img src="../VISTA/IMG/inicio-icon.png" alt="Inicio" class="social-iconI"> <br>
            </a></li>
            <li><a href="">Perfil de: <?php echo $userEmail; ?></a></li>
            <li><a href="../CONTROLADOR/logout.php" class="btn">Cerrar Sesión</a></li>
        </div>            
    </ul>
</nav>

<section class="contactoD">
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCatalogoEmpleado.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-iconD"> <br>Catálogo
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_Update_MaquilaEmpleado.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-iconD"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-item2D social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCotizacionesEmpleado.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div>
</section>
<section class="texto">
    <h1>Gestión de Cotizaciones</h1>
</section>

<section class="contacto">
   
    <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Vista_Update_Cotizacion_Unidad_Empleado.php">
                <img src="../VISTA/IMG/unidad-icon.png" alt="Instagram" class="social-icon"> <br>Editar Cotizaciones Por Unidad
            </a>
        </p>
    </div>
    <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Vista_Update_Cotizacion_Lote_Empleado.php">
                <img src="../VISTA/IMG/lote-icon.png" alt="Instagram" class="social-icon"> <br>Editar Cotizaciones Por Lote
            </a>
        </p>
    </div>


</section>
<?php include 'includes/footer.php'; ?>

</body>
</html>
