<?php
include '../../MODELO/db.php'; // Verifica que la ruta sea correcta

// Obtener el ID de la maquila desde la URL
$idCotizacion = isset($_GET['IDCotizacion']) ? $_GET['IDCotizacion'] : 0;

if ($idCotizacion == 0) {
    die("ID de cotizacion no válido.");
}

// Establecer los encabezados para exportar el archivo Excel
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="Reporte_Cotizacion_Unidad_' . $idCotizacion . '.xls"');
header('Pragma: no-cache');
header('Expires: 0');

// Consultar los datos de la maquila
$consulta = "SELECT * FROM CotizacionUnidad WHERE IDCotizacion = $idCotizacion";
$result = mysqli_query($conn, $consulta);

// Si hay datos, obtener el correo del usuario
if ($row = mysqli_fetch_array($result)) {
    $usuario = $row['Usuario']; // Correo del usuario
} else {
    die("No se encontraron datos.");
}

// Crear la tabla en formato HTML
echo "<table border='1' style='border-collapse: collapse;'>";


// Título con el correo del cliente
echo "<tr>
        <td colspan='9' style='text-align:center; font-size:32px; font-weight:bold; background-color: #FF8C00; color: white;'>REPORTE DE COTIZACION POR UNIDAD SOLICITADA POR EL CLIENTE: $usuario</td>
      </tr>";

// Cabecera de la tabla con los nombres de los campos
echo "<tr>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>ID Cotizacion</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Tipo</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>ID Producto</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Nombre</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Cantidad Unidades</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Fecha de Cotizacion</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>ID Cliente</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Usuario</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Estado</th>
      </tr>";

// Volver al inicio de la consulta para obtener los resultados de nuevo
mysqli_data_seek($result, 0);

// Imprimir los datos de la maquila en la tabla
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
            <td>" . $row['IDCotizacion'] . "</td>
            <td>" . $row['Tipo'] . "</td>
            <td>" . $row['IDProducto'] . "</td>
            <td>" . $row['Nombre'] . "</td>
            <td>" . $row['Cantidad'] . "</td>
            <td>" . $row['FechaDeCotizacion'] . "</td>
            <td>" . $row['IDCliente'] . "</td>
            <td>" . $row['Usuario'] . "</td>
            <td>" . $row['Estado'] . "</td>
          </tr>";
}

// Cerrar la tabla después de los datos
echo "</table>";
exit;
?>
