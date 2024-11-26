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
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../VISTA/CSS/Catalogo_DashbordEmpleado.css">
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
    <div class="contact-item2D social-mediaD">
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
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCotizacionesEmpleado.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div>
</section>

<section class="texto">
    <h1>Editar Productos</h1>
</section>

<section class="catalogo-container">

<div class="filtros">
    <h3>Filtro de búsqueda por Categoría</h3><br>
    <form action="" method="GET">
        <label for="Categoria">Categoría:</label>
        <select id="Categoria" name="Categoria">
            <option value="">Todas</option>
            <option value="Suplementos dietarios" <?php if(isset($_GET['Categoria']) && $_GET['Categoria'] == 'Suplementos dietarios') echo 'selected'; ?>>Suplementos dietarios</option>
            <option value="Control de peso" <?php if(isset($_GET['Categoria']) && $_GET['Categoria'] == 'Control de peso') echo 'selected'; ?>>Control de peso</option>
            <option value="Nutraceuticos" <?php if(isset($_GET['Categoria']) && $_GET['Categoria'] == 'Nutraceuticos') echo 'selected'; ?>>Nutracéuticos</option>
            <option value="Desintoxicantes" <?php if(isset($_GET['Categoria']) && $_GET['Categoria'] == 'Desintoxicantes') echo 'selected'; ?>>Desintoxicantes</option>
        </select>
        <br><br>
        <input type="submit" value="Aplicar filtros">
        <button type="button" onclick="location.href='Vista_Update_Producto_Empleado.php'">Volver</button>
    </form>
</div>

<div class="catalogo">
    <?php
    include '../MODELO/db.php';

    $categoria = isset($_GET['Categoria']) ? $_GET['Categoria'] : '';

    if (!empty($categoria)) {
        $sql = "SELECT * FROM Productos WHERE Categoria = '$categoria'";
    } else {
        $sql = "SELECT * FROM Productos";
    }

    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        while ($producto = mysqli_fetch_assoc($resultado)) {
            echo '<div class="producto">';
            
            echo '<img src="../VISTA/IMG/' . htmlspecialchars($producto['Foto']) . '" alt="Foto del producto">';
            
            echo '<h3>' . htmlspecialchars($producto['Nombre']) . '</h3>';
            
            echo '<p><strong>ID Producto:</strong> ' . htmlspecialchars($producto['IDProducto']) . '</p>';

            echo '<p><strong>Categoria:</strong> ' . htmlspecialchars($producto['Categoria']) . '</p>';

            echo '<p><strong>Descripción:</strong> ' . htmlspecialchars($producto['Descripcion']) . '</p>';
            
            echo '<p><strong>Presentación:</strong> ' . htmlspecialchars($producto['Presentacion']) . '</p>';
            
            echo '<p><strong>Ingredientes:</strong> ' . htmlspecialchars($producto['Ingredientes']) . '</p>';
            
            echo '<p><strong>Modo de uso:</strong> ' . htmlspecialchars($producto['ModoDeUso']) . '</p>';
            
            echo '<p><strong>Sabor:</strong> ' . htmlspecialchars($producto['Sabor']) . '</p>';
            
            echo '<p><strong>Recomendado para:</strong> ' . htmlspecialchars($producto['RecomendadoPara']) . '</p>';
            
            echo '<p><strong>Recomendado como:</strong> ' . htmlspecialchars($producto['RecomendadoComo']) . '</p>';
            
            echo '<p><strong>Precio:</strong> <span>$' . number_format($producto['Precio'], 2) . '</span></p>';
        
            echo '<br><a href="../CONTROLADOR/Update_Producto_Empleado.php?IDProducto=' . htmlspecialchars($producto['IDProducto']) . '"><img src="../VISTA/IMG/actualizar-icon.png" alt="Actualizar" width="30" height="30"><p>Editar Suple.</p></a>';
        
            echo '<a href="#" onclick="confirmarEliminacionProducto(' . htmlspecialchars($producto['IDProducto']) . ')"><img src="../VISTA/IMG/eliminar-icon.png" alt="Eliminar" width="30" height="30"><p>Eliminar Suple.</p></a>';

            echo '</div>';
        }
    } else {
        echo '<p>No hay productos disponibles.</p>';
    }

    mysqli_close($conn);
    ?>
</div>
</section>

<script>
function confirmarEliminacionProducto(idProducto) {
    Swal.fire({
        title: '¿Estás seguro de eliminar este producto?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("../CONTROLADOR/Delete_Producto_Empleado.php?IDProducto=" + idProducto)
                .then(response => {
                    if (response.ok) {
                        Swal.fire(
                            'Eliminado',
                            'Producto eliminado con éxito.',
                            'success'
                        ).then(() => {
                            window.location.reload(); 
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            'No se pudo eliminar el producto.',
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

<?php include 'includes/footer.php'; ?>

</body>
</html>
