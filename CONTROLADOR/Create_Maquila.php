<?php
include '../MODELO/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

$userEmail = $_SESSION['correo_usuario'];
$descripcion = $_POST['Descripcion'];
$fechaRegistro = $_POST['Fecha_Registro'];
$idCliente = $_SESSION['usuario'];
$estado = "Pendiente";

// Insertar los datos en la tabla 'Maquila'
$sql = "INSERT INTO Maquila(Descripcion, FechaDeRegistro, idCliente, Usuario, Estado) VALUES('$descripcion', '$fechaRegistro', '$idCliente', '$userEmail', '$estado')";
$execute = mysqli_query($conn, $sql);

// Si la inserción en la base de datos fue exitosa, proceder a enviar el correo
if ($execute) {
    // Configurar PHPMailer para enviar el correo con los datos de la maquila
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
        $mail->setFrom($userEmail, 'Cliente Naturales ARTROM'); // Correo del cliente como remitente
        $mail->addAddress('phoo220053@upemor.edu.mx');        // Correo de la empresa

        // Asunto y cuerpo del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nueva Solicitud de Maquila';
        $mail->Body = "
            <h3>Datos de la maquila registrada:</h3>
            <p><strong>Cliente:</strong> $idCliente</p>
            <p><strong>Correo del Cliente:</strong> $userEmail</p>
            <p><strong>Descripción:</strong> $descripcion</p>
            <p><strong>Fecha de Registro:</strong> $fechaRegistro</p>
            <p><strong>Estado:</strong> $estado</p>
        ";

        // Enviar el correo
        $mail->send();

        $success = "La solicitud de maquila ha sido registrada y será revisada por un administrador.";
        header("Location: ../VISTA/Vista_Create_Maquila.php?success=" . urlencode($success));
        exit();
    } catch (Exception $e) {
        $error = "Error al enviar la solicitud: {$mail->ErrorInfo}";
        header("Location: ../VISTA/Vista_Create_Maquila.php?error=" . urlencode($error));
        exit();
    }
} else {
    echo "Error al guardar los datos en la base de datos.";
}

// Redirigir al usuario después de un pequeño retraso
sleep(1);
header("Location: ../VISTA/Vista_Create_Maquila.php");
?>
