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
    <title>Gestionar Clientes</title>
    <link rel="stylesheet" href="../VISTA/CSS/Gestionar_Clientes.css">
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
    <h1>Gestión de Clientes</h1>
</section>

<section class="contacto">
   
    <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Vista_PreRegistro_Cliente.php">
                <img src="../VISTA/IMG/solicitud-icon.png" alt="Instagram" class="social-icon"> <br>Solicitud de registro Cliente
            </a>
        </p>
    </div> 
    <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Vista_Update_Cliente.php">
                <img src="../VISTA/IMG/actualizar-icon.png" alt="Instagram" class="social-icon"> <br>Editar Cliente
            </a>
        </p>
    </div>

<?php include 'includes/footer.php'; ?>

</body>
</html>