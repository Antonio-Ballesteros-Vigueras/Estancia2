<?php
include '../MODELO/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $user = 'root';
    $password = ''; // Asegúrate de poner aquí la contraseña de MySQL si la tienes
    $database = 'naturalesARTROM';
    $backupFile = $database . '_' . date('Y-m-d_H-i-s') . '.sql';
    $errorLogFile = $database . '_error.log';

    // Ruta completa al comando mysqldump
    $mysqldumpPath = 'mysqldump';

    // Comando para generar el respaldo con registro de errores
    if (!empty($password)) {
        $command = "$mysqldumpPath --log-error=$errorLogFile -h $host -u $user -p$password $database > $backupFile";
    } else {
        $command = "$mysqldumpPath --log-error=$errorLogFile -h $host -u $user $database > $backupFile";
    }

    // Ejecutar el comando
    exec($command . ' 2>&1', $output, $returnVar);

    if ($returnVar !== 0) {
        echo 'Error al generar el respaldo:<br>';
        echo 'Código de error: ' . $returnVar . '<br>';
        echo 'Detalles del error: ' . implode("\n", $output) . '<br>';
        echo 'Comando ejecutado: ' . $command . '<br>';
        echo 'Revisa el archivo de registro de errores: ' . $errorLogFile . '<br>';
        exit();
    }

    // Eliminar el archivo de error si está vacío
    if (file_exists($errorLogFile) && filesize($errorLogFile) === 0) {
        unlink($errorLogFile);
    }

    // Forzar descarga del archivo
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
    header('Content-Length: ' . filesize($backupFile));

    // Leer el archivo y enviarlo al usuario
    readfile($backupFile);

    // Eliminar el archivo temporal
    unlink($backupFile);

    exit();
}
?>
