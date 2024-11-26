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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Admministrador</title>
    <link rel="stylesheet" href="../VISTA/CSS/Crear_Administrador.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../VISTA/JS/Validaciones_Crear_Administrador.js" defer></script>
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
            <a href="../VISTA/Vista_GestionarCatalogo.php">
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
            <a href="../VISTA/Vista_Update_Maquila.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-iconD"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCotizaciones.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Respaldo_DB.php">
                <img src="../VISTA/IMG/respaldo-icon.png" alt="Instagram" class="social-iconD"> <br>Base de datos
            </a>
        </p>
    </div>
</section>

<section class="texto">
    <h1>Crear Administrador</h1>
</section><br>


<section class="login">
            <div>
                <img src="../VISTA/IMG/Logo1.png" alt="">
            </div>          
            <br><h2>Registra los datos del nuevo Administrador</h2>
<form method="POST" name="Formulario_Registrar_Administrador" id="Formulario_Registrar_Administrador" action="../CONTROLADOR/Create_Administrador.php" onsubmit="return validarRegistro()">
    <div>
        <label>
            Nombres *:
        </label>
        <input type="text" name="Nombres" id="Nombres" required 
                pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                title="¡Ingresa nombre(s) válido(s)!"><br><br>
    </div>


    <div>
        <label>
            Apellido Paterno *:
        </label>
        <input type="text" name="Apellido_Paterno" id="Apellido_Paterno" required 
                    pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                    title="¡Ingresa un Apellido válido!"><br><br>
    </div>


    <div>
        <label>
            Apellido Materno *:
        </label>
        <input type="text" name="Apellido_Materno" id="Apellido_Materno" required 
                    pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                    title="¡Ingresa un Apellido válido!"><br><br>
    </div>


    <div>
        <label>
            Fecha de Nacimiento *:
        </label>
        <input type="date" name="Fecha_Nacimiento" id="Fecha_Nacimiento" required><br><br>
    </div>


    <div>
        <label>
            Teléfono *:
        </label>
        <input type="text" name="Telefono" id="Telefono" required 
                   pattern="^\d{10}$"
                   title="Ingresa solo números! (10 dígitos)"><br><br> 
    </div>


    <div>
        <label>
            Correo Electrónico *:
        </label>
        <input type="email" name="Correo_Electronico" id="Correo_Electronico" required
        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
        title="El correo debe ser válido y contener un '.' después del '@'."><br><br> 
    </div>

    <br>

    <div>                    
        <input type="submit" value="Registrar Administrador" name="Registrar_Administrador">                    
    </div> 

</form>
</section>    
</section>



<?php
if (isset($_GET['error'])) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Correo en uso",
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
