<?php
include '../MODELO/db.php';
?>

<?php

    if(isset($_GET['IDEmpleado'])){
        $ID_Empleado = $_GET['IDEmpleado'];
        $sql = "DELETE FROM Empleados WHERE IDEmpleado=$ID_Empleado;";
        $execute = mysqli_query($conn, $sql);
        sleep(1);
        header("Location: ../VISTA/Vista_Update_Empleado.php");
    }   

?>