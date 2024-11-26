<?php
include '../MODELO/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../VISTA/Login.php");
    exit();
}

if ($_SESSION['tipo_usuario'] !== 'administrador') {
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
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="../VISTA/CSS/Respaldo_DB.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../VISTA/JS/DB_Restaurar.js"></script>
</head>
<body>

<nav>
    <div class="logo">
        <img src="../VISTA/IMG/Logo1.png" alt="">
    </div>
    <ul>
        <div class="items">            
            <li><a href="../VISTA/index_administrador.php"> <img src="../VISTA/IMG/inicio-icon.png" alt="Inicio" class="social-iconI"> <br>
            </a></li>
            <li><a href="">Perfil de: <?php echo htmlspecialchars($userEmail); ?></a></li>
            <li><a href="../CONTROLADOR/logout.php" class="btn">Cerrar Sesión</a></li>
        </div>            
    </ul>
</nav>

<section class="contactoD">
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCatalogo.php">
                <img src="../VISTA/IMG/catalogo-icon.png" alt="Instagram" class="social-iconD"> <br>Catálogo
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Gestionar_Usuarios.php">
                <img src="../VISTA/IMG/usuario-icon.png" alt="Instagram" class="social-iconD"> <br>Usuarios
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_Update_Maquila.php">
                <img src="../VISTA/IMG/maquila-icon.png" alt="Instagram" class="social-iconD"> <br>Maquilas
            </a>
        </p>
    </div>
    <div class="contact-itemD social-mediaD">
        <p>
            <a href="../VISTA/Vista_GestionarCotizaciones.php">
                <img src="../VISTA/IMG/cotizacion-icon.png" alt="Instagram" class="social-iconD"> <br>Cotizaciones
            </a>
        </p>
    </div>
    <div class="contact-item2D social-mediaD">
        <p>
            <a href="../VISTA/Respaldo_DB.php">
                <img src="../VISTA/IMG/respaldo-icon.png" alt="Instagram" class="social-iconD"> <br>Base de datos
            </a>
        </p>
    </div>
</section>

<section class="texto">
    <h1>1. Respaldo de la Base de Datos</h1>
</section>

<section>
    <p>
        Esta funcionalidad permite <strong>CREAR</strong> un respaldo completo de la base de datos actual.<br>
        El respaldo incluirá todas las tablas, datos y estructura de la base de datos del Catálogo, Usuarios, Cotizaciones etc <strong style="color:red;">(a  excepción de las imagenes)</strong>.
    </p>
    <button onclick="mostrarModal()">Respaldar ahora</button>

    <div class="modal" id="modalRespaldar">
        <div class="modal-content">
            <h2>Respaldar Base de Datos</h2>
            <p>Selecciona la base de datos que deseas respaldar y presiona el botón "Crear respaldo".</p>
            <p style="color:red;"><strong>(Se hará un respaldo total en "Descargas" de tu Equipo)</strong></p>
            <form action="../CONTROLADOR/Create_Respaldo.php" method="POST">
                <label for="database">Base de Datos:</label>
                <select id="database" name="database">
                    <option value="naturalesARTROM">naturalesARTROM</option>
                </select>
                <br><br>
                <img src="../VISTA/IMG/sql-icon.png" alt="Inicio" class="social-iconI">
                <button type="submit">Crear respaldo</button>
            </form>
            <br>
            <button type="button" onclick="cerrarModal('modalRespaldar')">Cancelar</button>
        </div>
    </div>

    <section class="texto">
    <h1>2. Restauración de la Base de Datos</h1>
</section>

    <p>
        Esta funcionalidad permite <strong>REEMPLAZAR</strong> un respaldo completo de la base de datos antiguo, por el actual.<br>
        El respaldo incluirá todas las tablas, datos y estructura de la base de datos del Catálogo, Usuarios, Cotizaciones etc <strong style="color:red;">(a  excepción de las imagenes)</strong> que se hayan almacenado en un repaldo generado anteriormente.
    </p>

    <div class="modal" id="modalRestaurar">
        <div class="modal-content">
            <h2>Restaurar Base de Datos</h2>
            <p>Selecciona el archivo de respaldo (SQL) para restaurar la base de datos.</p>
            <img src="../VISTA/IMG/advertencia-icon.png" alt="Inicio" class="social-iconI"><p style="color:red;"><strong>¡Selecciona con cuidado el Respaldo que reemplazará los datos actuales!</strong></p>
            <form id="formRestaurar" action="../CONTROLADOR/Cargar_Respaldo.php" method="POST" enctype="multipart/form-data">
                <label for="backupFile">Archivo de Respaldo:</label>
                <input type="file" id="backupFile" name="backupFile" accept=".sql" required><br><br>
                <button type="submit">Restaurar</button>
            </form>
            <br>
            <button type="button" onclick="cerrarModal('modalRestaurar')">Cancelar</button>
        </div>
    </div>

    <button onclick="mostrarModalRestaurar()">Restaurar ahora</button>

    <script>
        function mostrarModal() {
            document.getElementById('modalRespaldar').style.display = 'flex';
        }

        function cerrarModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function mostrarModalRestaurar() {
            document.getElementById('modalRestaurar').style.display = 'flex';
        }
    </script>

</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
