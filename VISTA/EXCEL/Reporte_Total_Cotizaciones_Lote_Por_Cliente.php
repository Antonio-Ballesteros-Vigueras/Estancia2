<?php
include '../../MODELO/db.php'; // Verifica la ruta correcta

// Establecer los encabezados para exportar el archivo Excel
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="Reporte_Cotizaciones_Por_Cliente_Lote.xls"');
header('Pragma: no-cache');
header('Expires: 0');

// Obtener el parámetro de fecha del formulario
if (!isset($_GET['fecha']) || empty($_GET['fecha'])) {
    die("No se proporcionó una fecha válida.");
}

$fecha = $_GET['fecha']; // Formato: YYYY-MM
list($anio, $mes) = explode('-', $fecha);

// Validar que los valores sean numéricos y válidos
if (!is_numeric($anio) || !is_numeric($mes) || $mes < 1 || $mes > 12) {
    die("La fecha proporcionada no es válida.");
}

// Consulta SQL para obtener los totales de cotizaciones filtrados por mes y año
$consulta = "
SELECT 
    Usuario,
    COUNT(*) AS TotalCotizaciones,
    SUM(CASE WHEN Estado = 'Revisada' THEN 1 ELSE 0 END) AS Revisadas,
    SUM(CASE WHEN Estado = 'Pendiente' THEN 1 ELSE 0 END) AS Pendientes,
    SUM(CASE WHEN Estado = 'Rechazada' THEN 1 ELSE 0 END) AS Rechazadas
FROM CotizacionLote
WHERE YEAR(FechaDeCotizacion) = $anio AND MONTH(FechaDeCotizacion) = $mes
GROUP BY Usuario;
";

$result = mysqli_query($conn, $consulta);

// Verificar si hay resultados
if (!$result || mysqli_num_rows($result) == 0) {
    die("No hay datos para el mes y año seleccionados.");
}

// Crear la tabla en formato HTML para Excel
echo "<table border='1' style='border-collapse: collapse;'>";

// Título del reporte
echo "<tr>
        <td colspan='5' style='text-align:center; font-size:32px; font-weight:bold; background-color: #FF8C00; color: white;'>REPORTE DE COTIZACIONES POR LOTES POR CLIENTE - $mes/$anio</td>
      </tr>";

// Encabezados de la tabla
echo "<tr>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Usuario</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Total Cotizaciones</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Revisadas</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Pendientes</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Rechazadas</th>
      </tr>";

// Imprimir los datos obtenidos de la consulta
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
            <td>" . $row['Usuario'] . "</td>
            <td>" . $row['TotalCotizaciones'] . "</td>
            <td>" . $row['Revisadas'] . "</td>
            <td>" . $row['Pendientes'] . "</td>
            <td>" . $row['Rechazadas'] . "</td>
          </tr>";
}

// Cerrar la tabla después de los datos
echo "</table>";
exit;
?>
