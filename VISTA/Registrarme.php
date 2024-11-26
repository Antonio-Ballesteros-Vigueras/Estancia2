<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarme - Naturales ARTROM</title>
    <link rel="stylesheet" href="../VISTA/CSS/Registrarme.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../VISTA/JS/Validaciones_Registrarme.js" defer></script>
</head>
<body>

<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="Logo de la empresa">
    </div>
    <ul class="nav-links">
        <div class="items">            
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="../VISTA/Nosotros.php">Nosotros</a></li>
            <li><a href="../VISTA/Contacto.php">Contacto</a></li>
            <li><a href="../VISTA/Login.php" class="btn">Iniciar Sesión</a></li>
        </div>            
    </ul>
    <div class="burger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>
</nav>
<script>
    const burger = document.querySelector('.burger');
    const navLinks = document.querySelector('.nav-links');

    burger.addEventListener('click', () => {
        navLinks.classList.toggle('nav-active');
        burger.classList.toggle('toggle');
    });
</script>


    <section class="formulario">
    <section class="text">
        <h2>¡Registra tus datos!</h2>
        <p>Así podrás visualizar nuestro catálogo de suplementos.</p>        
    </section>

    <section class="login">
        <div>
            <img src="../VISTA/IMG/Logo1.png" alt="">
        </div>          
        <h2>Te damos la Bienvenida a Naturales ARTROM</h2>
        <form action="../CONTROLADOR/Create_PreRegistro.php" method="POST" enctype="multipart/form-data" onsubmit="return validarRegistro()">

            <label for="nombre">Nombre(s)*:</label>
            <input type="text" id="nombre" name="nombre" required 
                pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                title="¡Ingresa nombre(s) válido(s)!"><br><br>

            <label for="apellidoPaterno">Apellido Paterno*:</label>
            <input type="text" id="apellidoPaterno" name="apellidoPaterno" required 
                pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                title="¡Ingresa un Apellido válido!"><br><br>

            <label for="apellidoMaterno">Apellido Materno*:</label>
            <input type="text" id="apellidoMaterno" name="apellidoMaterno" required 
                pattern="^(?!.*([a-zA-ZáéíóúÁÉÍÓÚÑñ])\1{2,})[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$"
                title="¡Ingresa un Apellido válido!"><br><br>

            <label for="fechaNacimiento">Fecha de Nacimiento*:</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" required><br><br>  

            <label for="telefono">No. Teléfono*:</label>
            <input type="text" id="telefono" name="telefono" required 
                pattern="^\d{10}$"
                title="Ingresa solo números! (10 dígitos)"><br><br>  

            <label for="cedula">Cédula Profesional*:</label>
            <input type="text" id="cedula" name="cedula" required 
                pattern="^\d{8}$"
                title="Ingresa solo números! (8 dígitos)"><br><br>    

            <label for="cedulaArchivo">Subir Cédula Profesional en PDF *:</label>
            <input type="file" id="cedulaArchivo" name="cedulaArchivo" required accept="application/pdf" onchange="mostrarNombreArchivo()"><br>
            <span id="nombreArchivo" style="color:black;" ></span><br><br> 

            <label for="email">Correo Electrónico*:</label>
            <input type="email" id="email" name="email" required 
                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                title="El correo debe ser válido y contener un '.' después del '@'."><br><br>          

            <label for="verificarEmail">Verificar Correo Electrónico*:</label>
            <input type="email" id="verificarEmail" name="verificarEmail" required><br><br>      

            <input type="submit" value="Enviar" name="Enviar"><br>
            <p>El número de cédula profesional proporcionado será verificado en la página de la SEP antes de dar el acceso a nuestro catálogo en línea.</p><br>
        </form>
    </section>    
</section>  

    <?php include '../VISTA/INCLUDES/footer.php'; ?>


    <script>
    function mostrarNombreArchivo() {
        var archivoInput = document.getElementById("cedulaArchivo");
        var nombreArchivo = archivoInput.files[0] ? archivoInput.files[0].name : "No se ha seleccionado un archivo";
        document.getElementById("nombreArchivo").textContent = nombreArchivo;
    }
</script>

<?php
if (isset($_GET['success'])) {
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Pre Registro exitoso",
            text: "' . htmlspecialchars($_GET['success']) . '",
            confirmButtonText: "Aceptar",
            confirmButtonColor: "#28a745",
        });
    </script>';
}
?>

</body>
</html>