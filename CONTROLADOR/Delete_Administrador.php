<?php
include '../MODELO/db.php';
?>

<?php

    if(isset($_GET['IDAdministrador'])){
        $ID_Administrador = $_GET['IDAdministrador'];
        $sql = "DELETE FROM Administradores WHERE IDAdministrador=$ID_Administrador;";
        $execute = mysqli_query($conn, $sql);
        sleep(1);
        header("Location: ../VISTA/Vista_Update_Administrador.php");
    }   

?>