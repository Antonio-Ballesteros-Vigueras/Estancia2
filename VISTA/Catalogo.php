<?php
include '../MODELO/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

if ($_SESSION['tipo_usuario'] !== 'cliente') {
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
    <title>Cliente</title>
    <link rel="stylesheet" href="../VISTA/CSS/Catalogo_Cliente.css">
</head>
<body>

<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="">
    </div>
    <ul>
        <div class="items">            
            <li><a href="../VISTA/index_cliente.php"> <img src="../VISTA/IMG/inicio-icon.png" alt="Inicio" class="social-iconI"> <br>
            </a></li>
            <li><a href="">Perfil de: <?php echo $userEmail; ?></a></li>
            <li><a href="../CONTROLADOR/logout.php" class="btn">Cerrar Sesión</a></li>
        </div>            
    </ul>
</nav>

<section class="contacto">
    <div class="contact-item2D social-media">
        <p>
            <a href="../VISTA/Catalogo.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-icon"> <br>Catálogo
            </a>
        </p>
    </div>
    <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Vista_Create_Maquila.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-icon"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Vista_Read_Cotizaciones.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-icon"> <br>Cotizaciones
            </a>
        </p>
    </div>    
</section>

<section class="bienvenida">
    <h1>Catálogo de Suplementos</h1>
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
    </form>
</div>

<div class="catalogo">
    <?php
    include '../MODELO/db.php';

    $categoria = isset($_GET['Categoria']) ? $_GET['Categoria'] : '';

    $sql = "SELECT * FROM Productos";
    if ($categoria != '') {
        $sql .= " WHERE Categoria = '" . mysqli_real_escape_string($conn, $categoria) . "'";
    }

    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        while ($producto = mysqli_fetch_assoc($resultado)) {
            echo '<div class="producto">';
            
            echo '<img src="../VISTA/IMG/' . $producto['Foto'] . '" alt="Foto del producto">';
            
            echo '<h3>' . htmlspecialchars($producto['Nombre']) . '</h3>';
            
            echo '<p><strong>ID Producto:</strong> ' . htmlspecialchars($producto['IDProducto']) . '</p>';

            echo '<p><strong>Categoría:</strong> ' . htmlspecialchars($producto['Categoria']) . '</p>';

            echo '<p><strong>Descripción:</strong> ' . htmlspecialchars($producto['Descripcion']) . '</p>';
            
            echo '<p><strong>Presentación:</strong> ' . htmlspecialchars($producto['Presentacion']) . '</p>';
            
            echo '<p><strong>Ingredientes:</strong> ' . htmlspecialchars($producto['Ingredientes']) . '</p>';
            
            echo '<p><strong>Modo de uso:</strong> ' . htmlspecialchars($producto['ModoDeUso']) . '</p>';
            
            echo '<p><strong>Sabor:</strong> ' . htmlspecialchars($producto['Sabor']) . '</p>';
            
            echo '<p><strong>Recomendado para:</strong> ' . htmlspecialchars($producto['RecomendadoPara']) . '</p>';
            
            echo '<p><strong>Recomendado como:</strong> ' . htmlspecialchars($producto['RecomendadoComo']) . '</p>';
            
            echo '<p><strong>Precio:</strong> <span>$' . number_format($producto['Precio'], 2) . '</span></p>';

            echo '<br><a href="../CONTROLADOR/Create_Cotizacion_Unidad.php?IDProducto=' . $producto['IDProducto'] . '"><img src="../VISTA/IMG/cotizar-Unidad-icon.png" alt="Actualizar" width="40" height="40"><p>Cotizar Unidades</p></a>';
        
            echo '<a href="../CONTROLADOR/Create_Cotizacion_Lote.php?IDProducto=' . $producto['IDProducto'] . '"><img src="../VISTA/IMG/cotizar-lote-icon.png" alt="Actualizar" width="40" height="40"><p>Cotizar Lote</p></a>';
        
            echo '</div>';
        }
    } else {
        echo '<p>No hay productos disponibles.</p>';
    }

    mysqli_close($conn);
    ?>
</div>
</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
