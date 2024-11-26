<?php
include '../MODELO/db.php';
?>

<?php

    if(isset($_GET['IDCotizacion'])){
        $ID_Cotizacion = $_GET['IDCotizacion'];
        $sql = "DELETE FROM CotizacionLote WHERE IDCotizacion=$ID_Cotizacion;";
        $execute = mysqli_query($conn, $sql);
        sleep(1);
        header("Location: ../VISTA/Vista_Update_Cotizacion_Unidad.php");
    }   

?>