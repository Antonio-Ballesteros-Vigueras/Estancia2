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
    if(isset($_GET['IDAdministrador'])){
        $ID_Administrador = $_GET['IDAdministrador'];
        $SQL = "SELECT *FROM Administradores WHERE IDAdministrador=$ID_Administrador;";
        $resultado = mysqli_query($conn, $SQL);

        if(mysqli_num_rows($resultado)==1){
            $fila = mysqli_fetch_array($resultado);
            $nombres = $fila['Nombres'];
            $apellidoPaterno = $fila['ApellidoPaterno'];
            $apellidoMaterno = $fila['ApellidoMaterno'];
            $fechaNacimiento = $fila['FechaNacimiento'];
            $telefono = $fila['Telefono'];
        }
    }else{
        echo"No existen registros";
    }

    if(isset($_POST['Actualizar'])){
        $IDAdministrador = $_GET['IDAdministrador'];
        $nombres = $_POST['Nombres'];
        $apellidoPaterno = $_POST['Apellido_Paterno'];
        $apellidoMaterno = $_POST['Apellido_Materno'];
        $fechaNacimiento = $_POST['Fecha_Nacimiento'];
        $telefono = $_POST['Telefono'];

        $sql = "UPDATE Administradores SET Nombres='$nombres', ApellidoPaterno='$apellidoPaterno', ApellidoMaterno='$apellidoMaterno', FechaNacimiento='$fechaNacimiento', Telefono='$telefono' WHERE IDAdministrador=$IDAdministrador;";
        if (mysqli_query($conn, $sql)) {
            sleep(2);
            header("Location: ../VISTA/Vista_Update_Administrador.php");
            exit();
        } else {
            echo "Error al actualizar: " . mysqli_error($conn);
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Admministrador</title>
    <link rel="stylesheet" href="../VISTA/CSS/Update_Administrador.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../VISTA/JS/Update_Administrador.js" defer></script>
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
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Gestionar_Catalogo.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-iconD"> <br>Catálogo
            </a>
        </p>
    </div>
    <div class="contact-item2D social-mediaD">
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
    <h1>Actualizar Administrador</h1>
</section><br>


<section class="login">
            <div>
                <img src="../VISTA/IMG/Logo1.png" alt="">
            </div>          
            <br><h2>Actualiza los datos del Administrador</h2>
<form method="POST" name="Formulario_Actualizar_Administrador" id="Formulario_Actualizar_Administrador" action="../CONTROLADOR/Update_Administrador.php?IDAdministrador=<?php echo $_GET['IDAdministrador']; ?>" onsubmit="return validarRegistro()">
    <div>
        <label>
            Nombres *:
        </label>
        <input type="text" name="Nombres" id="Nombres" value="<?php echo $nombres; ?>" required 
                pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                title="¡Ingresa nombre(s) válido(s)!"><br><br>
    </div>


    <div>
        <label>
            Apellido Paterno *:
        </label>
        <input type="text" name="Apellido_Paterno" id="Apellido_Paterno" value="<?php echo $apellidoPaterno; ?>" required 
                    pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                    title="¡Ingresa un Apellido válido!"><br><br>
    </div>


    <div>
        <label>
            Apellido Materno *:
        </label>
        <input type="text" name="Apellido_Materno" id="Apellido_Materno" value="<?php echo $apellidoMaterno; ?>" required 
                    pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                    title="¡Ingresa un Apellido válido!"><br><br>
    </div>


    <div>
        <label>
            Fecha de Nacimiento *:
        </label>
        <input type="date" name="Fecha_Nacimiento" id="Fecha_Nacimiento" value="<?php echo $fechaNacimiento; ?>" required><br><br>
    </div>


    <div>
        <label>
            Teléfono *:
        </label>
        <input type="text" name="Telefono" id="Telefono" value="<?php echo $telefono; ?>" required 
                   pattern="^\d{10}$"
                   title="Ingresa solo números! (10 dígitos)"><br><br> 
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