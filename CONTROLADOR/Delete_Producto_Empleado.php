<?php
include '../MODELO/db.php';

if (isset($_GET['IDProducto'])) {
    $ID_Producto = $_GET['IDProducto'];

    // Consultar la foto asociada al producto
    $consultaFoto = "SELECT Foto FROM Productos WHERE IDProducto = $ID_Producto";
    $resultadoFoto = mysqli_query($conn, $consultaFoto);

    if ($resultadoFoto && mysqli_num_rows($resultadoFoto) > 0) {
        $fila = mysqli_fetch_assoc($resultadoFoto);
        $rutaFoto = '../VISTA/IMG/' . $fila['Foto'];

        // Intentar eliminar el producto
        $sql = "DELETE FROM Productos WHERE IDProducto = $ID_Producto";
        $execute = mysqli_query($conn, $sql);

        if ($execute) {
            // Eliminar la foto si existe físicamente
            if (!empty($fila['Foto']) && file_exists($rutaFoto)) {
                unlink($rutaFoto); // Eliminar el archivo
            }
        }
    }

    // Redirigir después de la eliminación
    sleep(2);
    header("Location: ../VISTA/Vista_Update_Producto_Empleado.php");
    exit;
}
?>
