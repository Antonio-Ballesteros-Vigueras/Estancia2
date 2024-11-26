<?php
include '../MODELO/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['backupFile'])) {
    $host = 'localhost';
    $user = 'root';
    $password = ''; // Asegúrate de poner aquí la contraseña de MySQL si la tienes
    $database = 'naturalesARTROM';
    $backupFile = $_FILES['backupFile']['tmp_name'];
    $errorLogFile = $database . '_restore_error.log';

    // Ruta completa al comando mysql
    $mysqlPath = 'mysql';

    // Comando para restaurar la base de datos con registro de errores
    if (!empty($password)) {
        $command = "$mysqlPath -h $host -u $user -p$password $database < $backupFile";
    } else {
        $command = "$mysqlPath -h $host -u $user $database < $backupFile";
    }

    // Ejecutar el comando
    exec($command . ' 2>&1', $output, $returnVar);

    if ($returnVar !== 0) {
        echo 'Error al restaurar la base de datos:<br>';
        echo 'Código de error: ' . $returnVar . '<br>';
        echo 'Detalles del error: ' . implode("\n", $output) . '<br>';
        echo 'Comando ejecutado: ' . $command . '<br>';
        echo 'Revisa el archivo de registro de errores: ' . $errorLogFile . '<br>';
        exit();
    }

    header('Location: ../VISTA/Respaldo_DB.php?restore=success'); 
    exit();
}
?>
