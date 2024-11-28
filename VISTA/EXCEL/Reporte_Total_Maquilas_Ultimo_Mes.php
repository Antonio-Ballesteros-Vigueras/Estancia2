<?php
include '../../MODELO/db.php'; // Verifica que la ruta sea correcta

// Establecer los encabezados para exportar el archivo Excel
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="Reporte_Maquilas_Segun_Fecha.xls"');
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
        COUNT(*) AS TotalMaquilas, 
        Estado
    FROM Maquila
    WHERE YEAR(FechaDeRegistro) = $anio AND MONTH(FechaDeRegistro) = $mes
    GROUP BY Estado;
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
        <td colspan='2' style='text-align:center; font-size:32px; font-weight:bold; background-color: #FF8C00; color: white;'>REPORTE DE MAQUILAS POR MES Y AÑO</td>
      </tr>";

// Encabezados de la tabla
echo "<tr>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Estado</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Total Maquilas</th>
      </tr>";

// Imprimir los datos obtenidos de la consulta
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
            <td>" . $row['Estado'] . "</td>
            <td>" . $row['TotalMaquilas'] . "</td>
          </tr>";
}

// Cerrar la tabla después de los datos
echo "</table>";
exit;
?>
