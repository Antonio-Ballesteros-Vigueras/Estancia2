<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naturales ARTROM</title>
    <link rel="stylesheet" href="VISTA/CSS/Index.css">
    <script src="VISTA/JS/Carruselindex.js" defer></script>
</head>
<body>

<nav>
    <div class="logo">
        <img src="VISTA/IMG/Logo1.png" alt="Logo de la empresa">
    </div>
    <ul class="nav-links">
        <div class="left-items">
            <li><a href="VISTA/index_cliente.php">Catálogo</a></li>
            <li><a href="VISTA/Nosotros.php">Nosotros</a></li>
            <li><a href="VISTA/Contacto.php">Contacto</a></li>
        </div>
        <div class="right-items">
            <li><a href="VISTA/Login.php" class="btn">Iniciar Sesión</a></li>
            <li><a href="VISTA/Registrarme.php" class="btn-dos">Registrarme</a></li>
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

<section class="hero">
    <h2>Encuentra el próximo</h2>
    <div class="text-container">
        <p class="fade-text"><strong>suplemento para tus pacientes.</strong></p>
    </div>
    <div class="image-container">
        <img src="VISTA/IMG/img1.jpg" class="img large">
        <img src="VISTA/IMG/img2.jpeg" class="img medium">
        <img src="VISTA/IMG/img3.jpeg" class="img small">
        <img src="VISTA/IMG/img4.jpg" class="img bigsmall">
        <img src="VISTA/IMG/img5.jpeg" class="img small">
        <img src="VISTA/IMG/img6.jpg" class="img medium">
        <img src="VISTA/IMG/img7.jpg" class="img large">
    </div>
    <div class="fade-overlay"></div>
    <div><a href="VISTA/index_cliente.php" class="btn">Catálogo</a></div>
</section>

<section class="hero2">
    <section class="about">
        <h2>SOLUCIONES EFECTIVAS PARA LA PERDIDA DE PESO</h2>
        <p>Special Diet sustituto de desayuno y cena para dietas de control de peso.</p>
    </section>
    <div class="about-image-dos">
        <img src="VISTA/IMG/img2.jpeg" alt="Imagen de la primera sección">
    </div>
    <div class="about-image-tres">
        <img src="VISTA/IMG/img3.jpeg" alt="Imagen de la primera sección">
    </div>
    <div class="about-image">
        <img src="VISTA/IMG/img1.jpg" alt="Imagen de la primera sección">
    </div>
</section>

<section class="hero3">
    <section class="about2">
        <h2>LA OPCIÓN NATURAL PARA MÉDICOS Y NUTRIÓLOGOS</h2>
    </section>
    <div class="about-image2">
        <img src="VISTA/IMG/img8.jpeg" alt="Imagen de la swegunda sección">
    </div>
    <section class="about2-dos">
        <p>Suplementos naturales especialmente diseñados para cubrir los requerimentos nutricionales de tus pacientes además de ayudar a combatir diferentes padecimientos que afectan su salud.</p>
    </section>
</section>

<section class="hero4">
    <section class="about3">
        <h2>SUPLEMENTOS NATURALES, SEGUROS Y EFECTIVOS</h2>
        <p>Suplementos naturales para una salud óptima del paciente.</p>
        <a href="VISTA/index_cliente.php" class="btn">Conoce más</a>
    </section>
    <div class="about-image3">
        <img src="VISTA/IMG/img4.jpg" alt="Imagen de la tercera sección">
    </div>
    <div class="about-image3-dos">
        <img src="VISTA/IMG/img5.jpeg" alt="Imagen de la tercera sección">
    </div>
    <div class="about-image3-tres">
        <img src="VISTA/IMG/img6.jpg" alt="Imagen de la tercera sección">
    </div>
</section>

<?php include 'VISTA/INCLUDES/footer.php'; ?>

</body>
</html>
