<?php
include '../MODELO/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

// Recoger los datos del formulario de registro
$nombres = $_POST['Nombres'];
$apellidoPaterno = $_POST['Apellido_Paterno'];
$apellidoMaterno = $_POST['Apellido_Materno'];
$fechaNacimiento = $_POST['Fecha_Nacimiento'];
$telefono = $_POST['Telefono'];
$correoElectronico = $_POST['Correo_Electronico'];
$contrasena = bin2hex(random_bytes(4)); // Generar una contraseña aleatoria de 8 caracteres
$tipoUsuario = "Administrador";

// Verificar si el correo ya existe en la tabla 'Administradores'
$sqlCheck = "SELECT * FROM Administradores WHERE CorreoElectronico = '$correoElectronico'";
$resultCheck = mysqli_query($conn, $sqlCheck);

if (mysqli_num_rows($resultCheck) > 0) {
    // Si el correo ya existe, redirigir con mensaje de error
    $error = "Este correo electrónico ya está registrado.";
    header("Location: ../VISTA/Vista_Create_Administrador.php?error=" . urlencode($error));
    exit();
} else {
    // Insertar los datos en la tabla 'Administradores'
    $sql = "INSERT INTO Administradores(Nombres, ApellidoPaterno, ApellidoMaterno, FechaNacimiento, Telefono, CorreoElectronico, Contrasena, TipoUsuario) 
            VALUES('$nombres', '$apellidoPaterno', '$apellidoMaterno', '$fechaNacimiento', '$telefono', '$correoElectronico', '$contrasena', '$tipoUsuario')";
    $execute = mysqli_query($conn, $sql);

    if ($execute) {
        // Preparar y enviar el correo de confirmación
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ballesterosvigueras@gmail.com'; //CORREO DE LA EMPRESA O ADMINISTRADOR
            $mail->Password = 'wvzmuhskuvrasenh';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configuración del remitente y destinatario
            $mail->setFrom('ballesterosvigueras@gmail.com', 'NaturalesARTROM'); //CORREO DE LA EMPRESA
            $mail->addAddress($correoElectronico, $nombres); //CORREO Y NOMBRES DEL CLIENTE QUE SOLICITA SU REGISTRO

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Naturales ARTROM - Credenciales de acceso';
            $mail->Body = "<p>Hola $nombres,</p>
                            <p>Has sido registrado en Naturales ARTROM.</p>
                            <p>Aquí tienes tus credenciales de acceso:</p>
                            <p><strong>Usuario:</strong> $correoElectronico</p>
                            <p><strong>Contraseña:</strong> $contrasena</p>";

            // Enviar el correo
            if ($mail->send()) {
                // Redirigir con mensaje de éxito
                $success = "Administrador registrado con éxito. Las credenciales han sido enviadas al correo electrónico.";
                header("Location: ../VISTA/Vista_Create_Administrador.php?success=" . urlencode($success));
                exit();
            }
        } catch (Exception $e) {
            // Redirigir con mensaje de error de correo
            $error = "Hubo un problema al enviar el correo: " . $mail->ErrorInfo;
            header("Location: ../VISTA/Vista_Create_Administrador.php?error=" . urlencode($error));
            exit();
        }
    } else {
        // Redirigir con mensaje de error de base de datos
        $error = "Error en el registro: " . mysqli_error($conn);
        header("Location: ../VISTA/Vista_Create_Administrador.php?error=" . urlencode($error));
        exit();
    }
}
?>
