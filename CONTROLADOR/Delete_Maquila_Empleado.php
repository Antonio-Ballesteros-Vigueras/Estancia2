<?php
include '../MODELO/db.php';
?>

<?php

    if(isset($_GET['IDMaquila'])){
        $ID_Maquila = $_GET['IDMaquila'];
        $sql = "DELETE FROM Maquila WHERE IDMaquila=$ID_Maquila;";
        $execute = mysqli_query($conn, $sql);
        sleep(1);
        header("Location: ../VISTA/Vista_Update_MaquilaEmpleado.php");
    }   

?>