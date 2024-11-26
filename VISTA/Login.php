<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Naturales ARTROM</title>
    <link rel="stylesheet" href="../VISTA/CSS/Login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="VISTA/JS/Validaciones_Login.php" defer></script>
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
            <li><a href="../VISTA/Registrarme.php" class="btn">Registrarme</a></li>
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
    <h2>¡Inicia Sesión!</h2>
    <p>Así podrás visualizar nuestro catálogo de suplementos.</p>        
    </section>

    <section class="login">
    <div>
            <img src="../VISTA/IMG/Logo1.png" alt="">
        </div>   
        <h2><br>Bienvenido(a) a Naturales ARTROM</h2>
        <form method="POST" name="frm_login" id="frm_login" action="../CONTROLADOR/validacion_usuario.php" onsubmit="return validarLogin()">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" pattern="^(?=.*[a-z])(?=.*\d)[a-z0-9]+$" title="La contraseña debe contener solo letras minúsculas y números."required><br><br>

            <input type="submit" value="Iniciar Sesión"><br>
            <br><p>ó</p><br>
            <a href="../VISTA/Registrarme.php" class="btn">Regístrate ahora</a>

        </form>
        
</div> 
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        if (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error de inicio de sesión',
                text: decodeURIComponent(error),
                confirmButtonText: 'Intentar de nuevo'
            });
        }
    });
</script>

    </section>

    <?php include '../VISTA/INCLUDES/footer.php'; ?>

</body>

</html>
