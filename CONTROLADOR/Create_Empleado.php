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
$cargo = $_POST['Cargo'];
$correoElectronico = $_POST['Correo_Electronico'];
$contrasena = bin2hex(random_bytes(4)); // Generar una contraseña aleatoria de 8 caracteres
$tipoUsuario = "Empleado";

// Verificar si el correo ya existe en la tabla 'Empleados'
$sqlCheck = "SELECT * FROM Empleados WHERE CorreoElectronico = '$correoElectronico'";
$resultCheck = mysqli_query($conn, $sqlCheck);

if (mysqli_num_rows($resultCheck) > 0) {
    // Si el correo ya existe, redirigir con mensaje de error
    $error = "Este correo electrónico ya está registrado.";
    header("Location: ../VISTA/Vista_Create_Empleado.php?error=" . urlencode($error));
    exit();
} else {
    // Insertar los datos en la tabla 'Empleados'
    $sql = "INSERT INTO Empleados(Nombres, ApellidoPaterno, ApellidoMaterno, FechaNacimiento, Telefono, Cargo, CorreoElectronico, Contrasena, TipoUsuario) 
            VALUES('$nombres', '$apellidoPaterno', '$apellidoMaterno', '$fechaNacimiento', '$telefono', '$cargo', '$correoElectronico', '$contrasena', '$tipoUsuario')";
    $execute = mysqli_query($conn, $sql);

    if ($execute) {
        // Preparar el contenido del correo para enviar la contraseña
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
                            <p>Has sido registrado en Naturales ARTROM.</p>
                            <p>Aquí tienes tus credenciales de acceso:</p>
                            <p><strong>Usuario:</strong> $correoElectronico</p>
                            <p><strong>Contraseña:</strong> $contrasena</p>";

            // Enviar el correo
            if ($mail->send()) {
                $success = "Empleado registrado con éxito. Las credenciales han sido enviadas al correo electrónico.";
                header("Location: ../VISTA/Vista_Create_Empleado.php?success=" . urlencode($success));
                exit();
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
    } else {
        echo "Error en el registro: " . mysqli_error($conn);
    }
}
?>
