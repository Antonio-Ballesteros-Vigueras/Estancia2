<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Naturales ARTROM</title>
    <link rel="stylesheet" href="../VISTA/CSS/Contacto.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="VISTA/JS/validaciones_login.php" defer></script>
</head>
<body>

<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="Logo de la empresa">
    </div>
    <ul class="nav-links">
        <div class="left-items">
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="../VISTA/Nosotros.php">Nosotros</a></li>
        </div>
        <div class="right-items">
            <li><a href="../VISTA/Login.php" class="btn">Iniciar Sesión</a></li>
            <li><a href="../VISTA/Registrarme.php" class="btn-dos">Registrarme</a></li>
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
    <h2>¡Contáctanos!</h2>
    <p>Aquí podrás encontrar todos nuestros sitios de contacto.</p>        
    </section>


    <section class="contacto">
    <div class="contact-item">
        <h3>Teléfonos</h3>
        <p>
            <a href="tel:+527773194201">777 319 4201</a><br>
            <a href="tel:+527773194232">777 319 4232</a>
        </p>
        <img src="../VISTA/IMG/phone-icon.png" alt="Telefono" class="social-icon2">

    </div>

    <div class="contact-item social-media">
        <h3>WhatsApp</h3>
        <p>
            <a href="https://api.whatsapp.com/message/7NKLYR5RNBCNL1?autoload=1&app_absent=0" target="_blank">
            <img src="../VISTA/IMG/w-icon.png" alt="WhatsApp" class="social-icon">  <br>Envíanos un mensaje por WhatsApp
            </a>
        </p>
    </div>

    <div class="contact-item">
        <h3>Horarios de Oficina</h3>
        <img src="../VISTA/IMG/cd-icon.png" alt="Calendario" class="social-icon2">
        <br><a>Lunes a Viernes: 8:00 AM - 5:00 PM</a><br>
        <a>Sábado y Domingo: Cerrado</a><br>
    </div>

    <div class="contact-item social-media">
        <h3>Síguenos en Redes Sociales</h3>
        <p>
            <a href="https://www.instagram.com/naturales.artrom/" target="_blank">
                <img src="../VISTA/IMG/ig-icon.png" alt="Instagram" class="social-icon"> Instagram
            </a>
            <a href="https://www.facebook.com/naturalesartrom" target="_blank">
                <img src="../VISTA/IMG/fb-icon.png" alt="Facebook" class="social-icon"> Facebook
            </a>
        </p>
    </div>

        <div class="contact-item social-media">
        <p>
            <a href="../VISTA/Registrarme.php">
                <img src="../VISTA/IMG/formu-icon.png" alt="Instagram" class="social-icon"> <br>Comenzar formulario
            </a>
        </p>
                <h3>Envíanos tus datos!</h3>
    </div>
</section>

    </section>
    <?php include '../VISTA/INCLUDES/footer.php'; ?>

</body>

</html>
