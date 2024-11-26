<?php
include '../MODELO/db.php';
?>

<?php

    if(isset($_GET['IDCliente'])){
        $ID_Cliente = $_GET['IDCliente'];
        $sql = "DELETE FROM Clientes WHERE IDCliente=$ID_Cliente;";
        $execute = mysqli_query($conn, $sql);
        sleep(1);
        header("Location: ../VISTA/Vista_Update_Cliente.php");
    }   

?>