<?php
include '../MODELO/db.php';
include 'includes/header.php';

session_start();

$email = $_POST['email'];
$password = $_POST['contrasena'];

$sqlAdministrador = "SELECT * FROM administradores WHERE CorreoElectronico = '$email' AND Contrasena = '$password'";
$executeAdministrador = mysqli_query($conn, $sqlAdministrador);

$sqlEmpleado = "SELECT * FROM empleados WHERE CorreoElectronico = '$email' AND Contrasena = '$password'";
$executeEmpleado = mysqli_query($conn, $sqlEmpleado);

$sqlCliente = "SELECT * FROM clientes WHERE CorreoElectronico = '$email' AND Contrasena = '$password'";
$executeCliente = mysqli_query($conn, $sqlCliente);

$redirectUrl = '';
$userType = '';

if ($rowAdministrador = mysqli_fetch_assoc($executeAdministrador)) {
    $_SESSION['usuario'] = $rowAdministrador['IDAdministrador'];
    $_SESSION['correo_usuario'] = $rowAdministrador['CorreoElectronico'];
    $_SESSION['tipo_usuario'] = 'administrador';
    $_SESSION['login_success'] = "¡Bienvenido Administrador!";  
    $redirectUrl = '../VISTA/index_administrador.php';
} elseif ($rowEmpleado = mysqli_fetch_assoc($executeEmpleado)) {
    $_SESSION['usuario'] = $rowEmpleado['IDEmpleado'];
    $_SESSION['correo_usuario'] = $rowEmpleado['CorreoElectronico'];
    $_SESSION['tipo_usuario'] = 'empleado';
    $_SESSION['login_success'] = "¡Bienvenido Empleado!";  
    $redirectUrl = '../VISTA/index_empleado.php';
} elseif ($rowCliente = mysqli_fetch_assoc($executeCliente)) {
    $_SESSION['usuario'] = $rowCliente['IDCliente'];
    $_SESSION['correo_usuario'] = $rowCliente['CorreoElectronico'];
    $_SESSION['tipo_usuario'] = 'cliente';
    $_SESSION['login_success'] = "¡Bienvenido Cliente!";  
    $redirectUrl = '../VISTA/index_cliente.php';
} else {
    $error = "Correo o contraseña incorrectos.";
    header("Location: ../VISTA/Login.php?error=" . urlencode($error));
    exit();
}

header("Location: $redirectUrl");
exit(); 
?>
