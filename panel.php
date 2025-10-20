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
            background-color: #f0f0f0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .panel-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h1 {
            color: #555;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            margin-bottom: 30px;
        }
        .menu a { /* Estilo para los enlaces de los ejercicios */
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: #5cb85c; /* Un verde para destacar los enlaces de menú */
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }
        .menu a:hover {
            background-color: #4cae4c;
        }
        .logout-link { /* Estilo específico para el botón de Cerrar Sesión */
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #888;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }
        .logout-link:hover {
            background-color: #666;
        }
    </style>
</head>
<body>
    <div class="panel-container">
        <h1>Bienvenido/a al Panel Principal, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>

        <p>Selecciona el ejercicio que deseas revisar:</p>

        <div class="menu">
            <a href="calculadora.php">Ejercicio 2: Cálculo de Área y Volumen</a>
            <a href="triangulo.php">Ejercicio 3: Clasificación de Triángulos</a>
        </div>
        <a href="panel.php?logout=true" class="logout-link">Cerrar Sesión</a>
    </div>
</body>
</html>