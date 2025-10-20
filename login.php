<?php
// Inicia la sesión para manejar el estado de autenticación
session_start();

// Define las credenciales válidas (puedes cambiarlas)
$usuario_valido = "admin";
$contrasena_valida = "12345"; // ¡En un proyecto real, nunca guardes contraseñas sin hashear!

$error = "";

// 1. Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // 2. Validación de campos vacíos
    if (empty($usuario) || empty($contrasena)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // 3. Validación de credenciales
        if ($usuario === $usuario_valido && $contrasena === $contrasena_valida) {
            // Credenciales correctas: Inicia la sesión y redirige al panel
            $_SESSION['autenticado'] = true;
            $_SESSION['usuario'] = $usuario;
            
            // Redirección
            header("Location: panel.php");
            exit;
        } else {
            // Credenciales incorrectas
            $error = "Usuario o contraseña incorrectos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
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
        .login-container {
            background-color: #ffffff; /* Blanco */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra gris */
            width: 300px;
            text-align: center;
        }
        h1 {
            color: #555; /* Gris medio */
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #666; /* Gris */
            text-align: left;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc; /* Gris claro */
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #fafafa; /* Gris muy claro */
            color: #333;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #999; /* Gris más oscuro */
            outline: none;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #888; /* Gris */
            color: #fff; /* Blanco */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #666; /* Gris más oscuro */
        }
        .error {
            color: #d9534f; /* Rojo grisáceo para errores, pero manteniendo escala de grises con un toque */
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Inicio de Sesión</h1>

        <?php 
        // Muestra el mensaje de error si existe
        if (!empty($error)) {
            echo "<p class='error'>" . $error . "</p>";
        }
        ?>

        <form method="POST" action="login.php">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>