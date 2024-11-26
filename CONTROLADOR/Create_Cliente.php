<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include '../MODELO/db.php';
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

// Verificar si el usuario tiene el rol correcto
if ($_SESSION['tipo_usuario'] !== 'administrador') {
    // Si no es administrador, redirigirlo al inicio de sesión o mostrar un mensaje de acceso denegado
    header("Location: ../VISTA/Login.php");
    exit();
}

// Obtener el correo del usuario para mostrar en la vista
$userEmail = $_SESSION['correo_usuario'];
?>

<?php
include '../MODELO/db.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
?>



<?php

// PARA HACER LA CONSULTA DE LOS DATOS DE PREREGISTRO DE CLIENTE
if (isset($_GET['IDCliente'])) {
    $ID_Cliente = $_GET['IDCliente'];
    $SQL = "SELECT * FROM PreRegistroClientes WHERE IDCliente=$ID_Cliente;";
    $resultado = mysqli_query($conn, $SQL);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_array($resultado);
        $nombres = $fila['Nombres'];
        $apellidoPaterno = $fila['ApellidoPaterno'];
        $apellidoMaterno = $fila['ApellidoMaterno'];
        $fechaNacimiento = $fila['FechaNacimiento'];
        $telefono = $fila['Telefono'];
        $cedula = $fila['Cedula'];
        $correoElectronico = $fila['CorreoElectronico'];
    }
} else {
    echo "No existen registros";
}






// PARA ACCIONAR EL BOTÓN
if (isset($_POST['Registrar'])) {
    $IDCliente = $_GET['IDCliente'];
    $nombres = $_POST['Nombres'];
    $apellidoPaterno = $_POST['Apellido_Paterno'];
    $apellidoMaterno = $_POST['Apellido_Materno'];
    $fechaNacimiento = $_POST['Fecha_Nacimiento'];
    $telefono = $_POST['Telefono'];
    $cedula = $_POST['Cedula'];
    $correoElectronico = $_POST['Correo_Electronico'];
    $contrasena = bin2hex(random_bytes(4)); // Generar una contraseña aleatoria de 8 caracteres
    $tipoUsuario = "Cliente";

    // Verificar si el correo ya existe en la tabla 'Clientes'
    $sqlCheck = "SELECT * FROM Clientes WHERE CorreoElectronico = '$correoElectronico'";
    $resultCheck = mysqli_query($conn, $sqlCheck);

    if (mysqli_num_rows($resultCheck) > 0) {
        // Si el correo ya existe, mostrar una alerta de SweetAlert2 y no registrar
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Correo ya registrado',
                text: 'Este correo electrónico ya está registrado. No se puede registrar nuevamente.'
            });
        </script>";
    } else {
        // Insertar los datos en la tabla 'Clientes'
        $sql = "INSERT INTO Clientes (Nombres, ApellidoPaterno, ApellidoMaterno, FechaNacimiento, Telefono, Cedula, CorreoElectronico, Contrasena, TipoUsuario) VALUES ('$nombres', '$apellidoPaterno', '$apellidoMaterno', '$fechaNacimiento', '$telefono', '$cedula', '$correoElectronico', '$contrasena', '$tipoUsuario')";
        
        if (mysqli_query($conn, $sql)) {

            // Eliminar de 'PreRegistroClientes' después de un registro exitoso en 'Clientes'
            $deleteSQL = "DELETE FROM PreRegistroClientes WHERE CorreoElectronico = '$correoElectronico'";
            mysqli_query($conn, $deleteSQL);


            // Preparar el contenido del correo para enviar las credenciales
            $mail = new PHPMailer(true);

            try {
                // Configuración del servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'ballesterosvigueras@gmail.com';
                $mail->Password = 'wvzmuhskuvrasenh';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587; 

                // Configuración del remitente y destinatario
                $mail->setFrom('ballesterosvigueras@gmail.com', 'NaturalesARTROM');
                $mail->addAddress($correoElectronico, $nombres);

                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Naturales ARTROM - Credenciales de acceso';
                $mail->Body = "<p>Hola $nombres,</p>
                            <p>Has sido registrado como nuevo cliente en Naturales ARTROM.</p>
                            <p>Aquí tienes tus credenciales de acceso:</p>
                            <p><strong>Usuario:</strong> $correoElectronico</p>
                            <p><strong>Contraseña:</strong> $contrasena</p>";

                // Enviar el correo
                if ($mail->send()) {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Registro exitoso',
                            text: 'Las credenciales se han enviado al correo electrónico registrado.'
                        }).then(() => {
                            window.location.href = '../VISTA/Vista_PreRegistro_Cliente.php';
                        });
                    </script>";
                }
            } catch (Exception $e) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al enviar el correo: {$mail->ErrorInfo}'
                    });
                </script>";
            }

            // Redirigir a la vista de prerregistro después de un pequeño retraso
            sleep(2);
            header("Location: ../VISTA/Vista_PreRegistro_Cliente.php");
            exit();
        } else {
            echo "Error al registrar: " . mysqli_error($conn);
        }
    }
}
?>









<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Admministrador</title>
    <link rel="stylesheet" href="../VISTA/CSS/Create_Cliente.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../VISTA/JS/Create_Cliente.js" defer></script>
    </head>
<body>




<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="">
    </div>
    <ul>
        <div class="items">            
            <!-- Mostrar el correo del usuario en la barra de navegación -->
            <li><a href="../VISTA/index_administrador.php"> <img src="../VISTA/IMG/inicio-icon.png" alt="Inicio" class="social-iconI"> <br>
            </a></li>
            <li><a href="">Perfil de: <?php echo $userEmail; ?></a></li>
            <li><a href="../CONTROLADOR/logout.php" class="btn">Cerrar Sesión</a></li>
        </div>            
    </ul>
</nav>

<!-- Sección del Dashbord-->
<section class="contactoD">
    <!-- Gestionar Catálogo -->
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCatalogo.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-iconD"> <br>Catálogo
            </a>
        </p>
    </div>
    <!-- Gestionar Usuarios -->
    <div class="contact-item2D social-mediaD">
        <p>
            <a href="../VISTA/Gestionar_Usuarios.php">
                <img src="../VISTA/IMG/usuario-icon.png" alt="Instagram" class="social-iconD"> <br>Usuarios
            </a>
        </p>
    </div>
    <!-- Gestionar Maquilas -->
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_Update_Maquila.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-iconD"> <br>Maquilas
            </a>
        </p>
    </div>
    <!-- Gestionar Cotizaciones -->
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCotizaciones.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div>
    <!-- Respaldo de la Base de datos -->
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Respaldo_DB.php">
                <img src="../VISTA/IMG/respaldo-icon.png" alt="Instagram" class="social-iconD"> <br>Base de datos
            </a>
        </p>
    </div>
</section>
<!---------------------------------------------------->

<section class="texto">
    <h1>Registar solicitud del Cliente</h1>
</section><br>


<section class="login">
            <div>
                <img src="../VISTA/IMG/Logo1.png" alt="">
            </div>          
            <br><h2>¡Revisa los datos del Cliente!</h2>
<form method="POST" name="Formulario_Registrar_Cliente" id="Formulario_Registrar_Cliente" action="../CONTROLADOR/Create_Cliente.php?IDCliente=<?php echo $_GET['IDCliente']; ?>" onsubmit="return validarRegistro()">
<div>
        <label>
            Nombres:
        </label>
        <input type="text" name="Nombres" id="Nombres" value="<?php echo $nombres; ?>" required 
                pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                title="¡Ingresa nombre(s) válido(s)!"><br><br>
    </div>


    <div>
        <label>
            Apellido Paterno:
        </label>
        <input type="text" name="Apellido_Paterno" id="Apellido_Paterno" value="<?php echo $apellidoPaterno; ?>" required 
                    pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                    title="¡Ingresa un Apellido válido!"><br><br>
    </div>


    <div>
        <label>
            Apellido Materno:
        </label>
        <input type="text" name="Apellido_Materno" id="Apellido_Materno" value="<?php echo $apellidoMaterno; ?>" required 
                    pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                    title="¡Ingresa un Apellido válido!"><br><br>
    </div>


    <div>
        <label>
            Fecha de Nacimiento:
        </label>
        <input type="date" name="Fecha_Nacimiento" id="Fecha_Nacimiento" value="<?php echo $fechaNacimiento; ?>" required><br><br>
    </div>


    <div>
        <label>
            Teléfono:
        </label>
        <input type="text" name="Telefono" id="Telefono" value="<?php echo $telefono; ?>" required 
                   pattern="^\d{10}$"
                   title="Ingresa solo números! (10 dígitos)"><br><br> 
    </div>


    <div>
        <label>
            Cédula:
        </label>
        <input type="text" name="Cedula" id="Cedula" value="<?php echo $cedula; ?>" required 
                   pattern="^\d{8}$"
                   title="Ingresa solo números! (8 dígitos)"><br><br> 
    </div>


    <div>
        <label>
            CorreoElectrónico:
        </label>
        <input type="email" name="Correo_Electronico" id="Correo_Electronico" value="<?php echo $correoElectronico; ?>" required readonly>
    </div>

    <br>

    <div>                    
        <input type="submit" value="Registrar" name="Registrar">                    
    </div> 

</form>

</section>    
</section>


</body>
</html>
