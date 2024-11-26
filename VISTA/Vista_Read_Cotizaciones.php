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
    <title>Cliente</title>
    <link rel="stylesheet" href="../VISTA/CSS/Catalogo_Cliente.css">
    <link rel="stylesheet" href="../VISTA/CSS/Editar_Maquila.css">
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

<section class="contacto">
    <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Catalogo.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-icon"> <br>Catálogo
            </a>
        </p>
    </div>
    <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Vista_Create_Maquila.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-icon"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-item2D social-media">
        <p>
            <a href="../VISTA/Vista_Read_Cotizaciones.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-icon"> <br>Cotizaciones
            </a>
        </p>
    </div>     
</section>

<section class="bienvenida">
    <h1>Mis Cotizaciones por Unidad</h1>
</section>

<table class="table table-success table-striped-columns">
    <thead>
        <tr>
            <th><p>ID Cotización</p></th>
            <th><p>Tipo</p></th>
            <th><p>ID Producto</p></th>
            <th><p>Nombre</p></th>
            <th><p>Cantidad Unidades</p></th>
            <th><p>Fecha De Cotizacion</p></th>
            <th><p>ID Cliente</p></th>
            <th><p>Cliente</p></th>
            <th><p>Estado</p></th>
        </tr>
    <thead>

    <?php
        $sql = "SELECT *FROM CotizacionUnidad WHERE Usuario = '$userEmail'";
        $execute=mysqli_query($conn, $sql);
        while($rows=mysqli_fetch_array($execute)){
    ?>
            <tr>
                <th> <?php echo $rows['IDCotizacion']; ?> </th>
                <th> <?php echo $rows['Tipo']; ?> </th>
                <th> <?php echo $rows['IDProducto']; ?> </th>
                <th> <?php echo $rows['Nombre']; ?> </th>
                <th> <?php echo $rows['Cantidad']; ?> </th>
                <th> <?php echo $rows['FechaDeCotizacion']; ?> </th>
                <th> <?php echo $rows['IDCliente']; ?> </th>
                <th> <?php echo $rows['Usuario']; ?> </th>
                <th> <?php echo $rows['Estado']; ?> </th>
            </tr>
    <?php } ?>
</table>

<section class="bienvenida">
    <h1>Mis Cotizaciones por Lote</h1>
</section>

<table class="table table-success table-striped-columns">
    <thead>
        <tr>
            <th><p>ID Cotización</p></th>
            <th><p>Tipo</p></th>
            <th><p>ID Producto</p></th>
            <th><p>Nombre</p></th>
            <th><p>Cantidad Lotes</p></th>
            <th><p>Fecha De Cotizacion</p></th>
            <th><p>ID Cliente</p></th>
            <th><p>Cliente</p></th>
            <th><p>Estado</p></th>

        </tr>
    <thead>

    <?php
        $sql = "SELECT *FROM CotizacionLote WHERE Usuario = '$userEmail'";
        $execute=mysqli_query($conn, $sql);
        while($rows=mysqli_fetch_array($execute)){
    ?>
            <tr>
                <th> <?php echo $rows['IDCotizacion']; ?> </th>
                <th> <?php echo $rows['Tipo']; ?> </th>
                <th> <?php echo $rows['IDProducto']; ?> </th>
                <th> <?php echo $rows['Nombre']; ?> </th>
                <th> <?php echo $rows['Cantidad']; ?> </th>
                <th> <?php echo $rows['FechaDeCotizacion']; ?> </th>
                <th> <?php echo $rows['IDCliente']; ?> </th>
                <th> <?php echo $rows['Usuario']; ?> </th>
                <th> <?php echo $rows['Estado']; ?> </th>
            </tr>
    <?php } ?>
</table>

<?php include 'includes/footer.php'; ?>

</body>
</html>
