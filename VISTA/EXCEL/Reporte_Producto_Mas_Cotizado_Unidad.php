<?php
include '../../MODELO/db.php'; // Asegúrate de que la ruta es correcta

// Establecer los encabezados para exportar el archivo Excel
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="Reporte_Productos_Mas_Cotizados_Unidad.xls"');
header('Pragma: no-cache');
header('Expires: 0');

// Consulta SQL
$consulta = "
    SELECT 
        Nombre AS Producto,
        SUM(Cantidad) AS TotalCantidad
    FROM CotizacionUnidad
    GROUP BY Nombre
    ORDER BY TotalCantidad DESC
    LIMIT 10;
";

$result = mysqli_query($conn, $consulta);

// Crear la tabla en formato HTML
echo "<table border='1' style='border-collapse: collapse;'>";

// Título del reporte
echo "<tr>
        <td colspan='2' style='text-align:center; font-size:32px; font-weight:bold; background-color: #FF8C00; color: white;'>REPORTE DE PRODUCTOS MAS COTIZADOS POR UNIDAD</td>
      </tr>";

// Encabezados de la tabla
echo "<tr>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>PRODUCTO</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>TOTAL COTIZADO</th>
      </tr>";

// Imprimir los datos
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
            <td>" . $row['Producto'] . "</td>
            <td>" . $row['TotalCantidad'] . "</td>
          </tr>";
}

// Cerrar la tabla
echo "</table>";
exit;
?>
