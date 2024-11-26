<?php
include '../MODELO/db.php';

// Recoger los datos del formulario
$nombre = $_POST['Nombre'];
$categoria = $_POST['Categoria'];
$descripcion = $_POST['Descripcion'];
$presentacion = $_POST['Presentacion'];
$ingredientes = $_POST['Ingredientes'];
$modoUso = $_POST['Modo_Uso'];
$sabor = $_POST['Sabor'];
$recomendadoPara = $_POST['Recomendado_Para'];
$recomendadoComo = $_POST['Recomendado_Como'];
$precio = $_POST['Precio'];

// Manejar la subida del archivo
$fotoRuta = null; // Inicializar variable para evitar errores
if (isset($_FILES['Foto_Producto']) && $_FILES['Foto_Producto']['error'] === UPLOAD_ERR_OK) {
    // Crear un nombre único para la imagen
    $fotoNombre = uniqid() . '_' . basename($_FILES['Foto_Producto']['name']);
    
    // Definir el directorio de destino
    $directorioDestino = '../VISTA/IMG/' . $fotoNombre;

    // Mover el archivo subido al directorio destino
    if (move_uploaded_file($_FILES['Foto_Producto']['tmp_name'], $directorioDestino)) {
        // Guardar solo el nombre del archivo en la base de datos
        $fotoRuta = $fotoNombre; // Guardar solo el nombre del archivo
    } else {
        $error = "Error al subir la foto.";
        header("Location: ../VISTA/Vista_Create_Producto.php?error=" . urlencode($error));
        exit(); // Detener la ejecución en caso de error
    }
}

// Verificar si el producto ya existe en la base de datos
$sqlCheck = "SELECT * FROM Productos WHERE Nombre = '$nombre'";
$resultCheck = mysqli_query($conn, $sqlCheck);

if (mysqli_num_rows($resultCheck) > 0) {
    // Si el producto ya existe, redirigir con mensaje de error
    $error = "Este producto ya está registrado.";
    header("Location: ../VISTA/Vista_Create_Producto.php?error=" . urlencode($error));
    exit();
} else {
    // Consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO Productos (Nombre, Categoria, Descripcion, Presentacion, Ingredientes, ModoDeUso, Sabor, RecomendadoPara, RecomendadoComo, Precio, Foto) 
            VALUES ('$nombre', '$categoria', '$descripcion', '$presentacion', '$ingredientes', '$modoUso', '$sabor', '$recomendadoPara', '$recomendadoComo', '$precio', '$fotoRuta')";

    $execute = mysqli_query($conn, $sql);

    if ($execute) {
        // Redirigir con mensaje de éxito
        $success = "Producto registrado correctamente.";
        header("Location: ../VISTA/Vista_Create_Producto.php?success=" . urlencode($success));
        exit();
    } else {
        // Redirigir con mensaje de error
        $error = "Error al registrar el producto: " . mysqli_error($conn);
        header("Location: ../VISTA/Vista_Create_Producto.php?error=" . urlencode($error));
        exit();
    }
}
?>
