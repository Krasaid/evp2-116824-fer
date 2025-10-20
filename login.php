<?php
// Inicia la sesión para manejar el estado de autenticación
session_start();

// Define las credenciales válidas
$usuario_valido = "admin";
$contrasena_valida = "12345"; 

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    if (empty($usuario) || empty($contrasena)) {
        $error = "Todos los campos son obligatorios.";
    } else {
   
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
    <title>Login | GEM.dev</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
    </style>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen m-0">
    <div class="bg-white p-10 rounded-xl shadow-2xl w-full max-w-md text-center">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-6">🔑 Iniciar Sesión</h1>

        <?php 
        // Muestra el mensaje de error si existe
        if (!empty($error)) {
            // Clase de error: Fondo rojo suave, texto rojo oscuro y padding.
            echo "<p class='error bg-red-100 text-red-700 p-3 rounded-lg mb-4 font-medium'>" . $error . "</p>";
        }
        ?>

        <form method="POST" action="login.php">
            <label for="usuario" class="block text-left text-sm font-medium text-gray-700 mb-1">Usuario:</label>
            <input 
                type="text" 
                id="usuario" 
                name="usuario" 
                required
                class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150"
                placeholder="Ingresa tu nombre de usuario"
            >

            <label for="contrasena" class="block text-left text-sm font-medium text-gray-700 mb-1">Contraseña:</label>
            <input 
                type="password" 
                id="contrasena" 
                name="contrasena" 
                required
                class="w-full p-3 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150"
                placeholder="Ingresa tu contraseña"
            >

            <button 
                type="submit" 
                class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition duration-300 ease-in-out"
            >
                🚀 Entrar al Panel
            </button>
        </form>
    </div>
</body>
</html>