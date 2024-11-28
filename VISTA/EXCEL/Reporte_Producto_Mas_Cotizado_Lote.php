<?php
include '../../MODELO/db.php'; // Asegúrate de que la ruta es correcta

// Establecer los encabezados para exportar el archivo Excel
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="Reporte_Productos_Mas_Cotizados_Lote.xls"');
header('Pragma: no-cache');
header('Expires: 0');

// Verificar si el parámetro 'fecha' está presente
if (!isset($_GET['fecha'])) {
    die("No se especificó una fecha válida.");
}

// Obtener los valores de mes y año
$fecha = $_GET['fecha'];
list($anio, $mes) = explode('-', $fecha);

// Consulta SQL con filtro por mes y año
$consulta = "
    SELECT 
        Nombre AS Producto,
        SUM(Cantidad) AS TotalCantidad
    FROM CotizacionLote
    WHERE YEAR(FechaDeCotizacion) = $anio AND MONTH(FechaDeCotizacion) = $mes
    GROUP BY Nombre
    ORDER BY TotalCantidad DESC
    LIMIT 10;
";

$result = mysqli_query($conn, $consulta);

// Verificar si hay resultados
if (!$result || mysqli_num_rows($result) == 0) {
    die("No hay datos para el reporte en el mes y año especificados.");
}

// Crear la tabla en formato HTML para Excel
echo "<table border='1' style='border-collapse: collapse;'>";

// Título del reporte
echo "<tr>
        <td colspan='2' style='text-align:center; font-size:32px; font-weight:bold; background-color: #FF8C00; color: white;'>REPORTE DE PRODUCTOS MAS COTIZADOS POR LOTE</td>
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
