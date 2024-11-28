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
    <link rel="stylesheet" href="../VISTA/CSS/Editar_MaquilaEmpleado.css">
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
    <div class="contact-item2D social-mediaD">
        <p>
            <a href="../VISTA/Vista_Update_MaquilaEmpleado.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-iconD"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCotizacionesEmpleado.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div>

</section>
<section class="texto-filtros-container">
    <section class="texto">
        <h1>Editar Maquilas</h1>
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
            <button type="button" onclick="location.href='Vista_Update_MaquilaEmpleado.php'">Volver</button>
        </form>
    </section>
</section>

<section class="reportes">
    <hr>
    <h3>Reportes</h3>
    
    <section class="botones-reportes">
        <!-- Primer botón para el modal -->
        <button onclick="mostrarModal()">Total de maquilas en el último mes</button>
        <div class="modal" id="modalTotalMaquilasUltimoMes" style="display: none;">
            <div class="modal-content">
                <h2>Total de maquilas en el último mes</h2>
                <p>Selecciona el mes y el año en el que se trabajará su reporte.</p>
                <form action="../VISTA/EXCEL/Reporte_Total_Maquilas_Ultimo_Mes.php" method="GET">
                    <label for="fecha">Mes y Año:</label>
                    <input type="month" id="fecha" name="fecha" required>
                    <br><br>
                    <img src="../VISTA/IMG/excel.png" alt="Inicio" class="social-iconI"><br>
                    <button type="submit">Generar reporte</button>
                </form>
                <br>
                <button type="button" onclick="cerrarModal('modalTotalMaquilasUltimoMes')">Cancelar</button>
            </div>
        </div>

        <!-- Segundo botón para el modal -->
        <button onclick="mostrarModal2()">Total de maquilas por cliente</button>
        <div class="modal" id="modalTotalMaquilasPorCliente" style="display: none;">
            <div class="modal-content">
                <h2>Total de maquilas por cliente</h2>
                <p>Selecciona el mes y el año en el que se trabajará su reporte.</p>
                <form action="../VISTA/EXCEL/Reporte_Total_Maquilas_Por_Cliente.php" method="GET">
                    <label for="fecha">Mes y Año:</label>
                    <input type="month" id="fecha" name="fecha" required>
                    <br><br>
                    <img src="../VISTA/IMG/excel.png" alt="Inicio" class="social-iconI"><br>
                    <button type="submit">Generar reporte</button>
                </form>
                <br>
                <button type="button" onclick="cerrarModal('modalTotalMaquilasPorCliente')">Cancelar</button>
            </div>
        </div>
    </section>
    <hr>
</section>

<script>
    function mostrarModal() {
        document.getElementById('modalTotalMaquilasUltimoMes').style.display = 'flex';
    }

    function cerrarModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    function mostrarModal2() {
        document.getElementById('modalTotalMaquilasPorCliente').style.display = 'flex';
    }
</script>


<table class="table">
    <thead>
        <tr>
            <th><p>ID Maquila</p></th>
            <th><p>Descripción</p></th>
            <th><p>Fecha de Registro</p></th>
            <th><p>ID Cliente que Solicitó</p></th>
            <th><p>Usuario</p></th>
            <th><p>Estado</p></th>
            <th><p>SI</p></th>
            <th><p>NO</p></th>
            <th><p>Delete</p></th>
            <th><p>Exportar Cotización en Excel</p></th>
        </tr>
    <thead>

    <?php
        $estado = isset($_GET['estado']) ? $_GET['estado'] : '';

        $sql = "SELECT * FROM Maquila WHERE 1=1";

        if (!empty($estado)) {
            $sql .= " AND Estado = '$estado'";
        }

        $execute = mysqli_query($conn, $sql);
        while ($rows = mysqli_fetch_array($execute)) {
    ?>
            <tr>
                <th> <?php echo $rows['IDMaquila']; ?> </th>
                <td class="descripcion"> <?php echo $rows['Descripcion']; ?> </td>
                <th> <?php echo $rows['FechaDeRegistro']; ?> </th>
                <th> <?php echo $rows['IDCliente']; ?> </th>
                <th> <?php echo $rows['Usuario']; ?> </th>
                <th> <?php echo $rows['Estado']; ?> </th>
                <th><a href="#" onclick="confirmarRevisada(<?php echo $rows['IDMaquila']; ?>)"><img src="../VISTA/IMG/revisado-icon.png" width="30" height="30"></a></th>
                <th><a href="#" onclick="confirmarRechazo(<?php echo $rows['IDMaquila']; ?>)"><img src="../VISTA/IMG/rechazo-icon.png" width="30" height="30"></a></th>
                <th><a href="#" onclick="confirmarEliminacion(<?php echo $rows['IDMaquila']; ?>)"><img src="../VISTA/IMG/eliminar-icon.png" width="30" height="30"></a></th>
                <th><a href="../VISTA/EXCEL/Reporte_Maquila_Individual.php?IDMaquila=<?php echo $rows['IDMaquila']?>"><img src="../VISTA/IMG/excel.png" width="30" height="30"></a></th>
            </tr>
    <?php } ?>
</table>


<?php include 'includes/footer.php'; ?>

<script>
function confirmarEliminacion(idMaquila) {
    Swal.fire({
        title: '¿Estás seguro de eliminar esta maquila?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("../CONTROLADOR/Delete_Maquila_Empleado.php?IDMaquila=" + idMaquila)
                .then(response => {
                    if (response.ok) {
                        Swal.fire(
                            'Eliminado',
                            'Maquila eliminada con éxito.',
                            'success'
                        ).then(() => {
                            window.location.reload(); 
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            'No se pudo eliminar la maquila.',
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
function confirmarRevisada(idMaquila) {
    Swal.fire({
        title: '¿Estás seguro de marcar como "Revisada" esta maquila?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Revisada',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("../CONTROLADOR/Update_Maquila_Revisada_Empleado.php?IDMaquila=" + idMaquila)
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
                            'No se pudo cambiar el estatus de la maquila.',
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
function confirmarRechazo(idMaquila) {
    Swal.fire({
        title: '¿Estás seguro de marcar como "Rechazo" esta maquila?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Rechazo',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("../CONTROLADOR/Update_Maquila_Rechazada_Empleado.php?IDMaquila=" + idMaquila)
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
                            'No se pudo cambiar el estatus de la maquila.',
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
