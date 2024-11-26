<?php
include '../../MODELO/db.php'; // Verifica la ruta correcta

// Establecer los encabezados para exportar el archivo Excel
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="Reporte_Maquilas_Por_Cliente.xls"');
header('Pragma: no-cache');
header('Expires: 0');

// Consulta para obtener los totales de maquilas por cliente y estado
$consulta = "
SELECT 
    Usuario,
    COUNT(*) AS TotalMaquilas,
    SUM(CASE WHEN Estado = 'Revisada' THEN 1 ELSE 0 END) AS Revisadas,
    SUM(CASE WHEN Estado = 'Rechazada' THEN 1 ELSE 0 END) AS Rechazadas,
    SUM(CASE WHEN Estado = 'Pendiente' THEN 1 ELSE 0 END) AS Pendientes
FROM Maquila
GROUP BY Usuario;
";
$result = mysqli_query($conn, $consulta);

// Verificar si hay resultados
if (!$result || mysqli_num_rows($result) == 0) {
    die("No hay datos para el reporte.");
}

// Crear la tabla en formato HTML para Excel
echo "<table border='1' style='border-collapse: collapse;'>";

// Título del reporte
echo "<tr>
        <td colspan='5' style='text-align:center; font-size:32px; font-weight:bold; background-color: #FF8C00; color: white;'>REPORTE DE MAQUILAS POR CLIENTE</td>
      </tr>";

// Encabezados de la tabla
echo "<tr>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Usuario</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Total Maquilas</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Revisadas</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Rechazadas</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>Pendientes</th>
      </tr>";

// Imprimir los datos obtenidos de la consulta
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
            <td>" . $row['Usuario'] . "</td>
            <td>" . $row['TotalMaquilas'] . "</td>
            <td>" . $row['Revisadas'] . "</td>
            <td>" . $row['Rechazadas'] . "</td>
            <td>" . $row['Pendientes'] . "</td>
          </tr>";
}

// Cerrar la tabla después de los datos
echo "</table>";
exit;
?>
