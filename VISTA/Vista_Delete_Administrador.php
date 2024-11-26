<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

$userEmail = $_SESSION['correo_usuario'];
echo "<h1>INICIASTE SESION COMO: " . $userEmail. "</h1>";

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naturales ARTROM</title>
    <link rel="stylesheet" href="../VISTA/CSS/Index.css">
    <script src="Static/js/Carruselindex.js" defer></script>
    </head>
<body>

<h1>INDEX DE ADMINISTRADOR</h1>

<h2><a href="../VISTA/Vista_GestionarAdministradores.php">Gestionar Administradores</a></h2>



<H2><a href="../CONTROLADOR/logout.php">Cerrar Sesion</a></H2>


    <?php include 'includes/footer.php'; ?>

</body>
</html>
