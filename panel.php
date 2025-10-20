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
    <title>Panel Principal | GEM.dev</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex justify-center items-center h-screen m-0">
    <div class="bg-white p-10 rounded-xl shadow-2xl w-full max-w-lg text-center">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-4">
            Bienvenido/a al Panel Principal, <span class="text-indigo-600"><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>!
        </h1>

        <p class="text-lg text-gray-600 mb-8">Selecciona el ejercicio que deseas revisar:</p>

        <div class="menu space-y-4">
            <a 
                href="calculadora.php" 
                class="block py-3 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-150"
            >
                📏 Ejercicio 2: Cálculo de Área y Volumen
            </a>
            <a 
                href="triangulo.php" 
                class="block py-3 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-150"
            >
                📐 Ejercicio 3: Clasificación de Triángulos
            </a>
        </div>
        
        <a 
            href="panel.php?logout=true" 
            class="logout-link inline-block mt-8 py-2 px-6 bg-gray-500 text-white font-medium rounded-lg hover:bg-gray-600 transition duration-150"
        >
            🚪 Cerrar Sesión
        </a>
    </div>
</body>
</html>