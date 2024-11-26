<?php
include '../MODELO/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

if ($_SESSION['tipo_usuario'] !== 'cliente') {
    header("Location: ../VISTA/Login.php");
    exit();
}

$userEmail = $_SESSION['correo_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Maquila</title>
    <link rel="stylesheet" href="../VISTA/CSS/Crear_Maquila.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<body>

<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="">
    </div>
    <ul>
        <div class="items">            
            <li><a href="../VISTA/index_cliente.php"> <img src="../VISTA/IMG/inicio-icon.png" alt="Inicio" class="social-iconI"> <br>
            </a></li>
            <li><a href="">Perfil de: <?php echo $userEmail; ?></a></li>
            <li><a href="../CONTROLADOR/logout.php" class="btn">Cerrar Sesión</a></li>
        </div>            
    </ul>
</nav>

<section class="contactoD">
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Catalogo.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-iconD"> <br>Catálogo
            </a>
        </p>
    </div>
    <div class="contact-item2D social-mediaD">
        <p>
            <a href="../VISTA/Vista_Create_Maquila.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-iconD"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_Read_Cotizaciones.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div> 
</section>

<section class="texto">
    <h1>Crear Maquila Personalizada</h1>
</section><br>

<section class="reportes">
<a href="../VISTA/Vista_Read_Maquilas.php">Ver mi solicitudes de maquilas</a>
<p>Entendemos que cada cliente tiene necesidades únicas. Por eso ofrecemos nuestro servicio de maquilas personalizadas, donde puedes proponernos la creación de un producto adaptado a tus especificaciones.</p>

<p>Solo necesitas describir las características e ingredientes que deseas, y nuestro equipo evaluará la viabilidad de desarrollarlo. Siempre buscamos ofrecer soluciones innovadoras, pero nos aseguramos de que cada proyecto cumpla con nuestros estándares de calidad y factibilidad.</p>

<p style="text-align:center;"><strong>¡Envíanos tu propuesta y trabajemos juntos para hacer realidad tu idea!</strong></p>
</section>



<section class="login">
    <div>
        <img src="../VISTA/IMG/Logo1.png" alt="">
    </div>          
    <br>
    <h2>Describe a tu maquila personalizada</h2>
    <form method="POST" name="Formulario_Registrar_Maquila" id="Formulario_Registrar_Maquila" action="../CONTROLADOR/Create_Maquila.php" onsubmit="return validarRegistro()">

        <div>
            <label>
                Fecha de Solicitud:
            </label>
            <input type="date" name="Fecha_Registro" id="Fecha_Registro" readonly required><br><br>
        </div>

        <div>
            <label>
                Descripción:
            </label>
            <textarea name="Descripcion" id="Descripcion" maxlength="2000" required></textarea><br><br>
        </div>

        <br>

        <div>                    
            <input type="submit" value="Enviar Solicitud" name="Registrar_Maquila">                    
        </div> 

    </form>

</section>

<script>
(function setFechaRegistro() {
    const ahora = new Date();
    const opciones = { timeZone: "America/Mexico_City", year: "numeric", month: "2-digit", day: "2-digit" };

    const fechaMX = new Intl.DateTimeFormat("en-CA", opciones).format(ahora); // "en-CA" para formato ISO (YYYY-MM-DD)

    document.getElementById('Fecha_Registro').value = fechaMX;
})();
</script>
  
<?php
if (isset($_GET['error'])) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "' . htmlspecialchars($_GET['error']) . '",
            confirmButtonText: "Intentar de nuevo",
            confirmButtonColor: "#3085d6",
        });
    </script>';
}
?>

<?php
if (isset($_GET['success'])) {
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Registro de solicitud de maquila exitoso",
            text: "' . htmlspecialchars($_GET['success']) . '",
            confirmButtonText: "Aceptar",
            confirmButtonColor: "#28a745",
        });
    </script>';
}
?>

<?php include 'includes/footer.php'; ?>

</body>
</html>
