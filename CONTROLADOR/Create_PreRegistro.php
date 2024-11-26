<?php
include '../MODELO/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

// Recoger los datos del formulario de registro
$nombres = $_POST['nombre'];
$apellidoPaterno = $_POST['apellidoPaterno'];
$apellidoMaterno = $_POST['apellidoMaterno'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$telefono = $_POST['telefono'];
$cedula = $_POST['cedula'];
$correoElectronico = $_POST['email'];

// Verificar si se ha subido un archivo (foto o PDF)
$fileTmpPath = $_FILES['cedulaArchivo']['tmp_name'];
$fileName = $_FILES['cedulaArchivo']['name'];
$fileSize = $_FILES['cedulaArchivo']['size'];
$fileType = $_FILES['cedulaArchivo']['type'];

// Insertar los datos en la tabla 'PreRegistroClientes'
$sql = "INSERT INTO PreRegistroClientes(Nombres, ApellidoPaterno, ApellidoMaterno, FechaNacimiento, Telefono, Cedula, CorreoElectronico) 
        VALUES('$nombres', '$apellidoPaterno', '$apellidoMaterno', '$fechaNacimiento', '$telefono', '$cedula', '$correoElectronico')";
$execute = mysqli_query($conn, $sql);

// Si la inserción en la base de datos fue exitosa, proceder a enviar el correo
if ($execute) {
    // Configurar PHPMailer para enviar el correo con los datos del formulario y el archivo adjunto
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

        // Remitente y destinatario
        $mail->setFrom($correoElectronico);
        $mail->addAddress('phoo220053@upemor.edu.mx');  //CORREO DE LA EMPRESA O ADMINISTRADOR

        // Asunto y cuerpo del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo Solicitud de Registro de Cliente';
        $mail->Body = "
            <h3>Datos del cliente que desea unirse a NaturalesARTROM</h3>
            <p><strong>Nombre(s):</strong> $nombres</p>
            <p><strong>Apellido Paterno:</strong> $apellidoPaterno</p>
            <p><strong>Apellido Materno:</strong> $apellidoMaterno</p>
            <p><strong>Fecha de Nacimiento:</strong> $fechaNacimiento</p>
            <p><strong>No. Teléfono:</strong> $telefono</p>
            <p><strong>Cédula Profesional:</strong> $cedula</p>
            <p><strong>Correo Electrónico:</strong> $correoElectronico</p>
        ";

        // Adjuntar el archivo (foto o PDF)
        if ($fileTmpPath) {
            $mail->addAttachment($fileTmpPath, $fileName);  // Adjuntar el archivo
        }

        // Enviar el correo
        $mail->send();

        // Redirigir con mensaje de éxito
        $success = "Los datos han sido enviados correctamente y serán revisados por un administrador.";
        header("Location: ../VISTA/Registrarme.php?success=" . urlencode($success));
        exit();
    } catch (Exception $e) {
        $error = "Error al enviar el correo: {$mail->ErrorInfo}";
        header("Location: ../VISTA/Registrarme.php?error=" . urlencode($error));
        exit();
    }
} else {
    // Redirigir con mensaje de error
    $error = "Error al guardar los datos en la base de datos.";
    header("Location: ../VISTA/Registrarme.php?error=" . urlencode($error));
    exit();
}
?>
