<?php
session_start();

// 1. Verificación de autenticación
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    // Si no está autenticado, redirige al login
    header("Location: login.php");
    exit;
}

// Lógica de cierre de sesión (se activa al hacer clic en el enlace)
if (isset($_GET['logout'])) {
    // Destruye todas las variables de sesión
    session_unset();
    // Destruye la sesión
    session_destroy();
    // Redirige al login
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel Principal</title>
    </head>
<body>
    <h1>Bienvenido/a al Panel Principal, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>

    <p>Aquí va el contenido de tu panel principal.</p>

    <a href="panel.php?logout=true">Cerrar Sesión</a>
</body>
</html>