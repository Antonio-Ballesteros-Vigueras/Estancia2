<?php
include '../MODELO/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

if ($_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: ../VISTA/Login.php");
    exit();
}

$userEmail = $_SESSION['correo_usuario'];
?>

<?php
    if(isset($_GET['IDProducto'])){
        $ID_Producto = $_GET['IDProducto'];
        $SQL = "SELECT *FROM Productos WHERE IDProducto=$ID_Producto;";
        $resultado = mysqli_query($conn, $SQL);

        if(mysqli_num_rows($resultado)==1){
            $fila = mysqli_fetch_array($resultado);
            $nombre = $fila['Nombre'];
            $categoria = $fila['Categoria'];
            $descripcion = $fila['Descripcion'];
            $presentacion = $fila['Presentacion'];
            $ingredientes = $fila['Ingredientes'];
            $modoUso = $fila['ModoDeUso'];
            $sabor = $fila['Sabor'];
            $recomendadoPara = $fila['RecomendadoPara'];
            $recomendadoComo = $fila['RecomendadoComo'];
            $precio = $fila['Precio'];
            $foto = $fila['Foto'];
        }
    }else{
        echo"No existen registros";
    }

    if(isset($_POST['Actualizar'])){
        $ID_Producto = $_GET['IDProducto'];

        $nombre = $_POST['Nombre'];
        $categoria = $_POST['Categoria'];
        $descripcion = $_POST['Descripcion'];
        $presentacion = $_POST['Presentacion'];
        $ingredientes = $_POST['Ingredientes'];
        $modoUso = $_POST['Modo_Uso'];
        $sabor = $_POST['Sabor'];
        $recomendadoPara = $_POST['Recomendado_Para'];
        $recomendadoComo = $_POST['Recomendado_Como'];
        $precio = $_POST['Precio'];
        
        $SQL = "SELECT Foto FROM Productos WHERE IDProducto = $ID_Producto";
        $resultado = mysqli_query($conn, $SQL);
        $fila = mysqli_fetch_assoc($resultado);
        $fotoActual = $fila['Foto'];
    
        if (isset($_FILES['Foto_Producto']) && $_FILES['Foto_Producto']['error'] === UPLOAD_ERR_OK) {
            $fotoNombre = uniqid() . '_' . basename($_FILES['Foto_Producto']['name']);
            $directorioDestino = '../VISTA/IMG/' . $fotoNombre;
    
            if (move_uploaded_file($_FILES['Foto_Producto']['tmp_name'], $directorioDestino)) {
                $fotoRuta = $fotoNombre;
            } else {
                echo "Error al subir la foto.";
                exit;
            }
        } else {
            $fotoRuta = $fotoActual;
        }
    
        $sql = "UPDATE Productos 
                SET Nombre = '$nombre', 
                    Categoria = '$categoria', 
                    Descripcion = '$descripcion', 
                    Presentacion = '$presentacion', 
                    Ingredientes = '$ingredientes', 
                    ModoDeUso = '$modoUso', 
                    Sabor = '$sabor', 
                    RecomendadoPara = '$recomendadoPara', 
                    RecomendadoComo = '$recomendadoComo', 
                    Precio = '$precio', 
                    Foto = '$fotoRuta' 
                WHERE IDProducto = $ID_Producto";
    
        $execute = mysqli_query($conn, $sql);
    
        if ($execute) {
            echo "Producto actualizado correctamente.";
            sleep(2);
            header("Location: ../VISTA/Vista_Update_Producto.php");
        } else {
            echo "Error al actualizar el producto: " . mysqli_error($conn);
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../VISTA/CSS/Update_Administrador.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<body>




<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="">
    </div>
    <ul>
        <div class="items">            
            <li><a href="../VISTA/index_administrador.php"> <img src="../VISTA/IMG/inicio-icon.png" alt="Inicio" class="social-iconI"> <br>
            </a></li>
            <li><a href="">Perfil de: <?php echo $userEmail; ?></a></li>
            <li><a href="../CONTROLADOR/logout.php" class="btn">Cerrar Sesión</a></li>
        </div>            
    </ul>
</nav>

<section class="contactoD">
    <div class="contact-item2D social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCatalogo.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-iconD"> <br>Catálogo
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Gestionar_Usuarios.php">
                <img src="../VISTA/IMG/usuario-icon.png" alt="Instagram" class="social-iconD"> <br>Usuarios
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Gestionar_Maquilas.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-iconD"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Gestionar_Cotizaciones.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Respaldo_Database.php">
                <img src="../VISTA/IMG/respaldo-icon.png" alt="Instagram" class="social-iconD"> <br>Base de datos
            </a>
        </p>
    </div>
</section>

<section class="texto">
    <h1>Actualizar Producto</h1>
</section><br>


<section class="login">
            <div>
                <img src="../VISTA/IMG/Logo1.png" alt="">
            </div>          
            <br><h2>Actualiza los datos del Producto</h2>
<form method="POST" name="Formulario_Actualizar_Producto" id="Formulario_Actualizar_Producto" action="../CONTROLADOR/Update_Producto.php?IDProducto=<?php echo $_GET['IDProducto']; ?>" enctype="multipart/form-data">
    <div>
        <label>
            Nombre *:
        </label>
        <input type="text" name="Nombre" id="Nombre" value="<?php echo $nombre; ?>" required><br><br>
    </div>


    <div> <label for="Categoria">Categoría *:</label> <select name="Categoria" id="Categoria" required> <option value="" disabled <?php if (empty($categoria)) echo 'selected'; ?>>Seleccione una categoría</option> <option value="Suplementos dietarios" <?php if ($categoria == 'Suplementos dietarios') echo 'selected'; ?>>Suplementos dietarios</option> <option value="Control de peso" <?php if ($categoria == 'Control de peso') echo 'selected'; ?>>Control de peso</option> <option value="Nutraceuticos" <?php if ($categoria == 'Nutraceuticos') echo 'selected'; ?>>Nutracéuticos</option> <option value="Desintoxicantes" <?php if ($categoria == 'Desintoxicantes') echo 'selected'; ?>>Desintoxicantes</option> </select> <br><br> </div>

    <div>
    <label>
        Descripción:
    </label>
    <textarea name="Descripcion" id="Descripcion" required><?php echo $descripcion; ?></textarea><br><br>
</div>

<div>
    <label>
        Presentación *:
    </label>
    <textarea name="Presentacion" id="Presentacion" required><?php echo $presentacion; ?></textarea><br><br>
</div>

<div>
    <label>
        Ingredientes *:
    </label>
    <textarea name="Ingredientes" id="Ingredientes" required><?php echo $ingredientes; ?></textarea><br><br> 
</div>

<div>
    <label>
        Modo de Uso:
    </label>
    <textarea name="Modo_Uso" id="Modo_Uso"><?php echo $modoUso; ?></textarea><br><br> 
</div>



    <div>
        <label>
            Sabor:
        </label>
        <input type="text" name="Sabor" id="Sabor" value="<?php echo $sabor; ?>" ><br><br> 
    </div>


    <div>
    <label>
        Recomendado Para:
    </label>
    <textarea name="Recomendado_Para" id="Recomendado_Para"><?php echo $recomendadoPara; ?></textarea><br><br> 
</div>

<div>
    <label>
        Recomendado Como:
    </label>
    <textarea name="Recomendado_Como" id="Recomendado_Como"><?php echo $recomendadoComo; ?></textarea><br><br> 
</div>

    <div> <label> Precio *: </label> <input type="text" name="Precio" id="Precio" value="<?php echo $precio; ?>" required pattern="^\d+(\.\d{1,2})?$" title="El precio debe ser un número entero o con hasta 2 decimales. Ejemplo: 1234 o 1234.12"><br><br>

    <div>
        <label>Foto *:</label>
        <?php if ($foto != ''): ?>
            <img src="../VISTA/IMG/<?php echo $foto; ?>" alt="Foto del producto" width="100"><br><br>
        <?php endif; ?>

        <input type="file" name="Foto_Producto"><br><br>
        <small>Si no desea cambiar la foto, deje este campo vacío.</small><br><br>
    </div>

    <br>

    <div>                    
        <input type="submit" value="Actualizar" name="Actualizar">                    
    </div> 

</form>
</section>    
</section>


</body>
</html>