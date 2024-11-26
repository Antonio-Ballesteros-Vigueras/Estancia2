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
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="../VISTA/CSS/Crear_ProductoEmpleado.css">
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
    <h1>Registrar Producto</h1>
</section><br>

<section class="login">
            <div>
                <img src="../VISTA/IMG/Logo1.png" alt="">
            </div>          
            <br><h2>Registra los datos del Producto</h2>
<form method="POST" name="Formulario_Registrar_Producto" id="Formulario_Registrar_Producto" action="../CONTROLADOR/Create_Producto_Empleado.php" enctype="multipart/form-data">
<div>
        <label>
            Nombre *:
        </label>
        <input type="text" name="Nombre" id="Nombre" required><br><br>
    </div>


    <div>
    <label for="Categoria">Categoría *:</label>
    <select name="Categoria" id="Categoria" required>
        <option value="" disabled selected>Seleccione una categoría</option>
        <option value="Suplementos dietarios">Suplementos dietarios</option>
        <option value="Control de peso">Control de peso</option>
        <option value="Nutraceuticos">Nutracéuticos</option>
        <option value="Desintoxicantes">Desintoxicantes</option>
    </select>
    <br><br>
</div>

<div> <label> Descripción: </label><textarea name="Descripcion" id="Descripcion"></textarea><br><br> </div>

<div>
    <label>
        Presentación *:
    </label>
    <textarea name="Presentacion" id="Presentacion" required></textarea><br><br>
</div>

    <div> <label> Ingredientes *: </label>  <textarea name="Ingredientes" id="Ingredientes" required></textarea><br><br> </div>

    <div> <label> Modo de Uso: </label><textarea name="Modo_Uso" id="Modo_Uso"></textarea><br><br> </div>

    <div>
        <label>
            Sabor:
        </label>
        <input type="text" name="Sabor" id="Sabor" ><br><br> 
    </div>


    <div> <label> Recomendado Para: </label>  <textarea name="Recomendado_Para" id="Recomendado_Para"></textarea><br><br> </div> 
    
    <div> <label> Recomendado Como: </label>  <textarea name="Recomendado_Como" id="Recomendado_Como"></textarea><br><br> </div>


    <div>
    <label for="Precio">Precio *:</label>
    <input type="text" 
           name="Precio" 
           id="Precio" 
           required 
           pattern="^\d+(\.\d{1,2})?$" 
           title="El precio debe ser un número entero o con hasta 2 decimales. Ejemplo: 1234 o 1234.12"><br><br>
</div>

<div>
    <label for="Foto_Producto">Foto del Producto *:</label>
    <input type="file" 
           id="Foto_Producto" 
           name="Foto_Producto" 
           accept="image/*" 
           required 
           title="Por favor, sube una imagen del producto."><br><br>
</div>



    <br>

    <div>                    
        <input type="submit" value="Registrar Producto" name="Registrar_Producto">                    
    </div> 

</form>
</section>    
</section>


<?php
if (isset($_GET['error'])) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Producto existente en el catálogo.",
            text: "' . htmlspecialchars($_GET['error']) . '",
            confirmButtonText: "Intentar de nuevo",
            confirmButtonColor: "#3085d6",
        });
    </script>';
}
?>

<?php
if (isset($_GET['success'])) {
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Registro exitoso",
            text: "' . htmlspecialchars($_GET['success']) . '",
            confirmButtonText: "Aceptar",
            confirmButtonColor: "#28a745",
        });
    </script>';
}
?>

<?php include 'includes/footer.php'; ?>

</body>
</html>
