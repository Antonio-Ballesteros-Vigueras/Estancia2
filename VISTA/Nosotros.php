<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - Naturales ARTROM</title>
    <link rel="stylesheet" href="../VISTA/CSS/Nosotros.css">
</head>
<body>
    
<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="Logo de la empresa">
    </div>
    <ul class="nav-links">
        <div class="left-items">
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="../VISTA/index_cliente.php">Catálogo</a></li>
            <li><a href="../VISTA/Contacto.php">Contacto</a></li>
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


    <section class="nosotros">
    <div class="about">
        <h2>Sobre Nosotros</h2>
        <p><strong>Naturales ARTROM es una empresa 100% mexicana con más de 20 años de experiencia en el desarrollo, producción e innovación en el área de suplementos alimenticios.
        Nuestros productos actualmente tienen presencia en toda la República Mexicana y son de venta exclusiva para médicos y nutriólogos. </strong></p>
    </div>
    </section>

    <section class="nosotros2">
    <div class="about2">
        <h2>Misión</h2>
        <p><strong>Gracias a nuestra experiencia en el mercado ofrecemos productos de la más alta calidad y valor nutricional.
        Para ello utilizamos los mejores ingredientes disponibles en el mercado, para asegurar la total satisfacción de nuestros clientes y de los consumidores de nuestros productos.</strong></p>
    </div>   
    </section> 

    <section class="nosotros3">
    <div class="about3">
        <h2>Visión</h2>
        <p><strong>En Naturales ARTROM, buscamos continuamente la mejora de nuestros productos como de nuestros procesos, 
            siempre rigiéndonos bajo los mas estrictos controles de calidad para proporcionar una mejor experiencia para nuestros clientes y consumidores. </strong></p>
    </div>     
    </section>

    <?php include 'includes/footer.php'; ?>

</body>

</html>
