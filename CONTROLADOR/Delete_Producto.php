<?php
include '../MODELO/db.php';

if (isset($_GET['IDProducto'])) {
    $ID_Producto = $_GET['IDProducto'];

    $consultaFoto = "SELECT Foto FROM Productos WHERE IDProducto = $ID_Producto";
    $resultadoFoto = mysqli_query($conn, $consultaFoto);

    if ($resultadoFoto && mysqli_num_rows($resultadoFoto) > 0) {
        $fila = mysqli_fetch_assoc($resultadoFoto);
        $rutaFoto = '../VISTA/IMG/' . $fila['Foto'];

        $sql = "DELETE FROM Productos WHERE IDProducto = $ID_Producto";
        $execute = mysqli_query($conn, $sql);

        if ($execute) {
            if (!empty($fila['Foto']) && file_exists($rutaFoto)) {
                unlink($rutaFoto); 
            }
        }
    }

    sleep(2);
    header("Location: ../VISTA/Vista_Update_Producto.php");
    exit;
}
?>
