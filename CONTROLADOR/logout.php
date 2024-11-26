<?php include '../MODELO/db.php'?>
<?php include 'includes/header.php'?>

<?php

session_start();
session_destroy();

header("Location: ../VISTA/Login.php");


?>
