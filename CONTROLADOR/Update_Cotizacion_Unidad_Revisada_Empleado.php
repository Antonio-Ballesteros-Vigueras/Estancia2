<?php
include '../MODELO/db.php';
?>

<?php

    if(isset($_GET['IDCotizacion'])){
        $ID_Cotizacion = $_GET['IDCotizacion'];
        $estado = "Revisada";
        $sql = "UPDATE CotizacionUnidad SET Estado='$estado' WHERE IDCotizacion=$ID_Cotizacion;";
        $execute = mysqli_query($conn, $sql);
        sleep(1);
        header("Location: ../VISTA/Vista_Update_Cotizacion_Unidad_Empleado.php");
    }   

?>
