<?php
include '../../MODELO/db.php'; // Asegúrate de que la ruta es correcta

// Establecer los encabezados para exportar el archivo Excel
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="Reporte_Clientes_Mas_Productos_Unidad_Cotizo_Ultimo_Mes.xls"');
header('Pragma: no-cache');
header('Expires: 0');

// Consulta SQL para obtener los clientes que más productos han cotizado en el último mes
$consulta = "
    SELECT 
        c.CorreoElectronico AS Cliente,  -- Usamos 'CorreoElectronico' para identificar al cliente
        p.Nombre AS Producto,
        SUM(cu.Cantidad) AS TotalCotizado
    FROM CotizacionUnidad cu
    JOIN Clientes c ON cu.IDCliente = c.IDCliente
    JOIN Productos p ON cu.IDProducto = p.IDProducto
    WHERE cu.FechaDeCotizacion >= CURDATE() - INTERVAL 1 MONTH
    GROUP BY c.CorreoElectronico, p.Nombre  -- Agrupamos por correo electrónico del cliente y nombre del producto
    ORDER BY TotalCotizado DESC;
";

$result = mysqli_query($conn, $consulta);

// Crear la tabla en formato HTML
echo "<table border='1' style='border-collapse: collapse;'>";

// Título del reporte
echo "<tr>
        <td colspan='3' style='text-align:center; font-size:32px; font-weight:bold; background-color: #FF8C00; color: white;'>REPORTE DE CLIENTES QUE MAS COTIZARON Y QUE PRODUCTOS, EN EL ULTIMO MES POR UNIDAD</td>
      </tr>";

// Encabezados de la tabla
echo "<tr>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>CLIENTE</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>PRODUCTO</th>
        <th style='background-color: #FFDAB9; color: black; font-size: 24px; font-weight: bold;'>TOTAL UNIDADES COTIZADAS</th>
      </tr>";

// Imprimir los datos
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
            <td>" . $row['Cliente'] . "</td>
            <td>" . $row['Producto'] . "</td>
            <td>" . $row['TotalCotizado'] . "</td>
          </tr>";
}

// Cerrar la tabla
echo "</table>";
exit;
?>
