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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Gris claro */
            color: #333; /* Gris oscuro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .panel-container {
            background-color: #ffffff; /* Blanco */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra gris */
            width: 400px;
            text-align: center;
        }
        h1 {
            color: #555; /* Gris medio */
            margin-bottom: 20px;
        }
        p {
            color: #666; /* Gris */
            margin-bottom: 30px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #888; /* Gris */
            color: #fff; /* Blanco */
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }
        a:hover {
            background-color: #666; /* Gris más oscuro */
        }
    </style>
</head>
<body>
    <div class="panel-container">
        <h1>Bienvenido/a al Panel Principal, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>

        <p>Aquí va el contenido de tu panel principal.</p>

        <a href="panel.php?logout=true">Cerrar Sesión</a>
    </div>
</body>
</html>
