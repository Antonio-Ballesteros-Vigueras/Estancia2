<?php
include '../MODELO/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

if ($_SESSION['tipo_usuario'] !== 'cliente') {
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
    <title>Solicitar Maquila</title>
    <link rel="stylesheet" href="../VISTA/CSS/Crear_Maquila.css">
    <link rel="stylesheet" href="../VISTA/CSS/Editar_Maquila.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<body>

<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="">
    </div>
    <ul>
        <div class="items">            
            <li><a href="../VISTA/index_cliente.php"> <img src="../VISTA/IMG/inicio-icon.png" alt="Inicio" class="social-iconI"> <br>
            </a></li>
            <li><a href="">Perfil de: <?php echo $userEmail; ?></a></li>
            <li><a href="../CONTROLADOR/logout.php" class="btn">Cerrar Sesión</a></li>
        </div>            
    </ul>
</nav>

<section class="contactoD">
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Catalogo.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-iconD"> <br>Catálogo
            </a>
        </p>
    </div>
    <div class="contact-item2D social-mediaD">
        <p>
            <a href="../VISTA/Vista_Create_Maquila.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-iconD"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_Read_Cotizaciones.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div> 
</section>

<section class="texto">
    <h1>Mis Solicitudes de Maquilas</h1>
</section>

<table class="table table-success table-striped-columns">
    <thead>
        <tr>
            <th><p>ID Maquila</p></th>
            <th><p>Descripción</p></th>
            <th><p>Fecha de Registro</p></th>
            <th><p>ID Cliente que Solicitó</p></th>
            <th><p>Usuario</p></th>
            <th><p>Estado</p></th>
        </tr>
    <thead>

    <?php
        $sql = "SELECT *FROM Maquila WHERE Usuario = '$userEmail'";
        $execute=mysqli_query($conn, $sql);
        while($rows=mysqli_fetch_array($execute)){
    ?>
            <tr>
                <th> <?php echo $rows['IDMaquila']; ?> </th>
                <td class="descripcion"> <?php echo $rows['Descripcion']; ?> </td>
                <th> <?php echo $rows['FechaDeRegistro']; ?> </th>
                <th> <?php echo $rows['IDCliente']; ?> </th>
                <th> <?php echo $rows['Usuario']; ?> </th>
                <th> <?php echo $rows['Estado']; ?> </th>
            </tr>
    <?php } ?>
</table>

<?php include 'includes/footer.php'; ?>

</body>
</html>
