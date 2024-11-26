<?php
include '../MODELO/db.php';
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

// Verificar si el usuario tiene el rol de cliente
if ($_SESSION['tipo_usuario'] !== 'cliente') {
    // Si no es cliente, redirigir al inicio de sesión o a una página de acceso denegado
    header("Location: ../VISTA/Login.php");
    exit();
}

// Obtener el correo del usuario para mostrar en la vista
$userEmail = $_SESSION['correo_usuario'];
?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';


// PARA HACER LA CONSULTA DEL PRODUCTO
if (isset($_GET['IDProducto'])) {
    $ID_Producto = $_GET['IDProducto'];
    $SQL = "SELECT * FROM Productos WHERE IDProducto = $ID_Producto;";
    $resultado = mysqli_query($conn, $SQL);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_array($resultado);
        $nombre = $fila['Nombre'];
    } else {
        echo "No existen registros";
    }
}

// PARA ACCIONAR EL BOTÓN
if (isset($_POST['Enviar_Cotizacion'])) {
    $tipo = 'Lote';
    $estado = 'Pendiente';
    $idCliente = $_SESSION['usuario'];

    // Recoger los datos del formulario
    $nombre = $_POST['Nombre'];
    $cantidad = $_POST['Cantidad'];
    $fechaCotizacion = $_POST['Fecha_Cotizacion'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO CotizacionLote(Tipo, IDProducto, Nombre, Cantidad, FechaDeCotizacion, IDCliente, Usuario, Estado) 
            VALUES('$tipo', '$ID_Producto', '$nombre', '$cantidad', '$fechaCotizacion', '$idCliente', '$userEmail', '$estado')";
    $execute = mysqli_query($conn, $sql);

    if ($execute) {
        // Configurar PHPMailer para enviar el correo
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ballesterosvigueras@gmail.com';
            $mail->Password = 'wvzmuhskuvrasenh'; // Cambiar esto por una contraseña segura o usar variables de entorno
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            
            // Configurar la codificación
            $mail->CharSet = 'UTF-8';

            // Remitente y destinatario
            $mail->setFrom($userEmail, 'Cliente Naturales ARTROM');
            $mail->addAddress('phoo220053@upemor.edu.mx');

            // Asunto y cuerpo del correo
            $mail->isHTML(true);
            $mail->Subject = 'Nueva Cotización de Lote de Producto';
            $mail->Body = "
                <h3>Detalles de la Cotización de Productos por Lotes</h3>
                <p><strong>ID Producto:</strong> $ID_Producto</p>
                <p><strong>Nombre del Producto:</strong> $nombre</p>
                <p><strong>Cantidad de Lotes:</strong> $cantidad</p>
                <p><strong>Fecha de Cotización:</strong> $fechaCotizacion</p>
                <p><strong>ID Cliente:</strong> $idCliente</p>
                <p><strong>Cliente:</strong> $userEmail</p>
                <p><strong>Estado:</strong> $estado</p>
            ";

            // Enviar el correo
            $mail->send();
            echo 'La cotización se ha registrado y se ha enviado un correo electrónico a la empresa.';
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }

        // Redirigir al usuario
        sleep(2);
        header("Location: ../VISTA/Catalogo.php");
    } else {
        echo "Error al guardar los datos en la base de datos.";
    }
}
?>






<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cotizacion</title>
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
            <!-- Mostrar el correo del usuario en la barra de navegación -->
            <li><a href="../VISTA/index_cliente.php"> <img src="../VISTA/IMG/inicio-icon.png" alt="Inicio" class="social-iconI"> <br>
            </a></li>
            <li><a href="">Perfil de: <?php echo $userEmail; ?></a></li>
            <li><a href="../CONTROLADOR/logout.php" class="btn">Cerrar Sesión</a></li>
        </div>            
    </ul>
</nav>

<!-- Sección del Dashbord-->
<section class="contactoD">
    <!-- Gestionar Catálogo -->
    <div class="contact-item2D social-mediaD">
        <p>
            <a href="../VISTA/Catalogo.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-iconD"> <br>Catálogo
            </a>
        </p>
    </div>
    <!-- Gestionar Maquilas -->
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_Create_Maquila.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-iconD"> <br>Maquilas
            </a>
        </p>
    </div>
        <!-- Gestionar Cotizaciones -->
        <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_Read_Cotizaciones.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div> 
</section>
<!---------------------------------------------------->

<section class="texto">
    <h1>Cotizar Producto por Lote</h1>
</section>



<section class="login">
            <div>
                <img src="../VISTA/IMG/Logo1.png" alt="">
            </div>          
            <br><h2>Registra tu cotización</h2>
<form method="POST" name="Formulario_Registrar_Cotizacion_Lote" id="Formulario_Registrar_Cotizacion_Lote" action="../CONTROLADOR/Create_Cotizacion_Lote.php?IDProducto=<?php echo $_GET['IDProducto']; ?>">
    
    <div>
        <label>
            ID del Producto:
        </label>
        <input type="text" name="IDProducto" id="IDProducto" value="<?php echo $ID_Producto; ?>" readonly required><br><br>
    </div>

    <div>
        <label>
            Nombre:
        </label>
        <input type="text" name="Nombre" id="Nombre" value="<?php echo $nombre; ?>" readonly required><br><br>
    </div>


    <div>
        <label>
            Cantidad de Lotes:
        </label>
        <input type="number" name="Cantidad" id="Cantidad" required min="1" max="99" value="1" step="1"><br><br>
    </div>

    <script>
        // Previene la escritura manual en el campo, pero permite el uso de las flechas
        document.getElementById("Cantidad").addEventListener("keypress", function(event) {
            event.preventDefault();
        });
    </script>


    <div>
        <label>
            Fecha de Cotización:
        </label>
        <input type="date" name="Fecha_Cotizacion" id="Fecha_Cotizacion" readonly required><br><br>
    </div>





    <br>

    <div>                    
        <input type="submit" value="Enviar Cotización" name="Enviar_Cotizacion">                    
    </div> 

</form>
</section>    


<script>
// Establece la fecha actual basada en la zona horaria de la Ciudad de México
(function setFechaRegistro() {
    // Crear un objeto de fecha ajustado a la zona horaria de la Ciudad de México
    const ahora = new Date();
    const opciones = { timeZone: "America/Mexico_City", year: "numeric", month: "2-digit", day: "2-digit" };

    // Formatear la fecha según la zona horaria
    const fechaMX = new Intl.DateTimeFormat("en-CA", opciones).format(ahora); // "en-CA" para formato ISO (YYYY-MM-DD)

    // Asignar la fecha al campo
    document.getElementById('Fecha_Cotizacion').value = fechaMX;
})();
</script>

</body>
</html>