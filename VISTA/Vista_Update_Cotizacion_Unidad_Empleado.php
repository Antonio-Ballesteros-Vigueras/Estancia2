<?php
include '../MODELO/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

if ($_SESSION['tipo_usuario'] !== 'empleado') {
    header("Location: ../VISTA/Login.php");
    exit();
}

$userEmail = $_SESSION['correo_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Maquila</title>
    <link rel="stylesheet" href="../VISTA/CSS/Editar_Maquila.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<body>

<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="">
    </div>
    <ul>
        <div class="items">            
            <li><a href="../VISTA/index_empleado.php"> <img src="../VISTA/IMG/inicio-icon.png" alt="Inicio" class="social-iconI"> <br>
            </a></li>
            <li><a href="">Perfil de: <?php echo $userEmail; ?></a></li>
            <li><a href="../CONTROLADOR/logout.php" class="btn">Cerrar Sesión</a></li>
        </div>            
    </ul>
</nav>

<section class="contactoD">
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCatalogoEmpleado.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-iconD"> <br>Catálogo
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_Update_MaquilaEmpleado.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-iconD"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-item2D social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCotizacionesEmpleado.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div>
</section>

<section class="texto-filtros-container">
    <section class="texto">
        <h1>Solicitud de Cotizaciones por Unidad</h1>
    </section>
    <section class="filtros">
        <h3>Filtro de búsqueda por Estado</h3><br>
        <form action="" method="GET">
            <label for="estado">Estado:</label>
            <select id="estado" name="estado">
                <option value="">Todos</option>
                <option value="Rechazada" <?php if(isset($_GET['estado']) && $_GET['estado'] == 'Rechazada') echo 'selected'; ?>>Rechazada</option>
                <option value="Pendiente" <?php if(isset($_GET['estado']) && $_GET['estado'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
                <option value="Revisada" <?php if(isset($_GET['estado']) && $_GET['estado'] == 'Revisada') echo 'selected'; ?>>Revisada</option>
            </select>
            <br><br>
            <input type="submit" value="Aplicar filtros">
            <button type="button" onclick="location.href='Vista_Update_Cotizacion_Unidad_Empleado.php'">Volver</button>
        </form>
    </section>
</section>

<section class="reportes">
<hr>
<h3>Reportes</h3>
<a href="../VISTA/EXCEL/Reporte_Total_Cotizaciones_Unidad_Por_Cliente.php">Total de cotizaciones por unidades de clientes</a>
<a href="../VISTA/EXCEL/Reporte_Producto_Mas_Cotizado_Unidad.php">Producto más cotizado por unidad</a>
<a href="../VISTA/EXCEL/Reporte_Cliente_Mas_Productos_Cotizo_Unidad.php">Cliente que más productos cotizó por unidad en el último mes</a>
<hr>
</section>

<table class="table">
    <thead>
        <tr>
            <th><p>ID Cotización</p></th>
            <th><p>Tipo</p></th>
            <th><p>ID Producto</p></th>
            <th><p>Nombre</p></th>
            <th><p>Cantidad Unidades</p></th>
            <th><p>Fecha De Cotizacion</p></th>
            <th><p>ID Cliente</p></th>
            <th><p>Cliente</p></th>
            <th><p>Estado</p></th>
            <th><p>SI</p></th>
            <th><p>NO</p></th>
            <th><p>Delete</p></th>
            <th><p>Exportar Cotización en Excel</p></th>
        </tr>
    <thead>

    <?php
        $estado = isset($_GET['estado']) ? $_GET['estado'] : '';

        $sql = "SELECT * FROM CotizacionUnidad WHERE 1=1";

        if (!empty($estado)) {
            $sql .= " AND Estado = '$estado'";
        }

        $execute = mysqli_query($conn, $sql);
        while ($rows = mysqli_fetch_array($execute)) {
    ?>
            <tr>
                <th> <?php echo $rows['IDCotizacion']; ?> </th>
                <th> <?php echo $rows['Tipo']; ?> </th>
                <th> <?php echo $rows['IDProducto']; ?> </th>
                <th> <?php echo $rows['Nombre']; ?> </th>
                <th> <?php echo $rows['Cantidad']; ?> </th>
                <th> <?php echo $rows['FechaDeCotizacion']; ?> </th>
                <th> <?php echo $rows['IDCliente']; ?> </th>
                <th> <?php echo $rows['Usuario']; ?> </th>
                <th> <?php echo $rows['Estado']; ?> </th>
                <th><a href="#" onclick="confirmarRevisada(<?php echo $rows['IDCotizacion']; ?>)"><img src="../VISTA/IMG/revisado-icon.png" width="30" height="30"></a></th>
                <th><a href="#" onclick="confirmarRechazo(<?php echo $rows['IDCotizacion']; ?>)"><img src="../VISTA/IMG/rechazo-icon.png" width="30" height="30"></a></th>
                <th><a href="#" onclick="confirmarEliminacion(<?php echo $rows['IDCotizacion']; ?>)"><img src="../VISTA/IMG/eliminar-icon.png" width="30" height="30"></a></th>
                <th><a href="../VISTA/EXCEL/Reporte_Cotizacion_Unidad_Individual.php?IDCotizacion=<?php echo $rows['IDCotizacion']?>"><img src="../VISTA/IMG/excel.png" width="30" height="30"></a></th>
            </tr>
    <?php } ?>
</table>

<?php include 'includes/footer.php'; ?>

<script>
function confirmarEliminacion(idCotizacion) {
    Swal.fire({
        title: '¿Estás seguro de eliminar esta cotización?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("../CONTROLADOR/Delete_Cotizacion_Unidad_Empleado.php?IDCotizacion=" + idCotizacion)
                .then(response => {
                    if (response.ok) {
                        Swal.fire(
                            'Eliminado',
                            'cotización eliminada con éxito.',
                            'success'
                        ).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            'No se pudo eliminar la cotización.',
                            'error'
                        );
                    }
                });
        } else {
            Swal.fire(
                'Cancelado',
                'La eliminación ha sido cancelada.',
                'info'
            );
        }
    });
}
</script>

<script>
function confirmarRevisada(idCotizacion) {
    Swal.fire({
        title: '¿Estás seguro de marcar como "Revisada" esta cotización?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Revisada',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("../CONTROLADOR/Update_Cotizacion_Unidad_Revisada_Empleado.php?IDCotizacion=" + idCotizacion)
                .then(response => {
                    if (response.ok) {
                        Swal.fire(
                            'Revisada',
                            'Cambio de estatus con éxito.',
                            'success'
                        ).then(() => {
                            window.location.reload(); 
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            'No se pudo cambiar el estatus de la cotización.',
                            'error'
                        );
                    }
                });
        } else {
            Swal.fire(
                'Cancelado',
                'El cambio de estatus ha sido cancelado.',
                'info'
            );
        }
    });
}
</script>

<script>
function confirmarRechazo(idCotizacion) {
    Swal.fire({
        title: '¿Estás seguro de marcar como "Rechazo" esta cotización?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Rechazo',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("../CONTROLADOR/Update_Cotizacion_Unidad_Rechazada_Empleado.php?IDCotizacion=" + idCotizacion)
                .then(response => {
                    if (response.ok) {
                        Swal.fire(
                            'Rechazada',
                            'Cambio de estatus con éxito.',
                            'success'
                        ).then(() => {
                            window.location.reload(); 
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            'No se pudo cambiar el estatus de la cotización.',
                            'error'
                        );
                    }
                });
        } else {
            Swal.fire(
                'Cancelado',
                'El cambio de estatus ha sido cancelado.',
                'info'
            );
        }
    });
}
</script>

</body>
</html>