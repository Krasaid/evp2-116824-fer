<?php
// Define la constante PI para precisión
// M_PI ya está definido en PHP por defecto, pero esta verificación es buena práctica.
if (!defined('M_PI')) {
    define('M_PI', 3.14159265358979323846);
}

$errores = [];
$resultados = [];

// 1. Validar y procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- Datos del Rectángulo ---
    $base = filter_input(INPUT_POST, 'base', FILTER_VALIDATE_FLOAT);
    $altura = filter_input(INPUT_POST, 'altura', FILTER_VALIDATE_FLOAT);

    // Validación general: numéricos y positivos
    if ($base === false || $base <= 0) {
        $errores['base'] = "La base debe ser un número positivo.";
    }
    if ($altura === false || $altura <= 0) {
        $errores['altura'] = "La altura debe ser un número positivo.";
    }

    // Calcular solo si las validaciones del rectángulo son correctas
    if (empty($errores['base']) && empty($errores['altura'])) {
        // Cálculo del Rectángulo
        $resultados['rectangulo_area'] = number_format($base * $altura, 2);
        $resultados['rectangulo_perimetro'] = number_format(2 * ($base + $altura), 2);
    }
    
    // --- Datos del Cilindro ---
    $radio = filter_input(INPUT_POST, 'radio', FILTER_VALIDATE_FLOAT);
    $altura_cilindro = filter_input(INPUT_POST, 'altura_cilindro', FILTER_VALIDATE_FLOAT);
    
    // Validación general: numéricos y positivos
    if ($radio === false || $radio <= 0) {
        $errores['radio'] = "El radio debe ser un número positivo.";
    }
    if ($altura_cilindro === false || $altura_cilindro <= 0) {
        $errores['altura_cilindro'] = "La altura del cilindro debe ser un número positivo.";
    }

    // Calcular solo si las validaciones del cilindro son correctas
    if (empty($errores['radio']) && empty($errores['altura_cilindro'])) {
        // Cálculo del Cilindro
        $resultados['cilindro_volumen'] = number_format(M_PI * pow($radio, 2) * $altura_cilindro, 2);
        $resultados['cilindro_area_total'] = number_format(2 * M_PI * $radio * ($radio + $altura_cilindro), 2);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Calculadora de Área y Volumen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen m-0 p-6">
    <div class="calculadora-container bg-white p-8 rounded-xl shadow-2xl w-full max-w-xl text-left">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-3">🧮 Ejercicio 2: Cálculo Geométrico</h1>

        <form method="POST" action="calculadora.php">
            
            <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
                <h2 class="text-2xl font-semibold text-indigo-700 mb-4">Rectángulo (Área y Perímetro)</h2>
                
                <div class="mb-4">
                    <label for="base" class="block text-sm font-medium text-gray-700 mb-1">Base (b):</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="base" 
                        id="base" 
                        value="<?php echo $_POST['base'] ?? ''; ?>" 
                        required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition duration-150"
                        placeholder="Ej: 10.5"
                    >
                    <?php if (!empty($errores['base'])) echo "<p class='text-red-600 text-sm mt-1'>{$errores['base']}</p>"; ?>
                </div>
                
                <div class="mb-4">
                    <label for="altura" class="block text-sm font-medium text-gray-700 mb-1">Altura (h):</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="altura" 
                        id="altura" 
                        value="<?php echo $_POST['altura'] ?? ''; ?>" 
                        required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition duration-150"
                        placeholder="Ej: 5.2"
                    >
                    <?php if (!empty($errores['altura'])) echo "<p class='text-red-600 text-sm mt-1'>{$errores['altura']}</p>"; ?>
                </div>
            </div>

            <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
                <h2 class="text-2xl font-semibold text-indigo-700 mb-4">Cilindro (Volumen y Área Total)</h2>

                <div class="mb-4">
                    <label for="radio" class="block text-sm font-medium text-gray-700 mb-1">Radio (r):</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="radio" 
                        id="radio" 
                        value="<?php echo $_POST['radio'] ?? ''; ?>" 
                        required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition duration-150"
                        placeholder="Ej: 4.0"
                    >
                    <?php if (!empty($errores['radio'])) echo "<p class='text-red-600 text-sm mt-1'>{$errores['radio']}</p>"; ?>
                </div>
                
                <div class="mb-4">
                    <label for="altura_cilindro" class="block text-sm font-medium text-gray-700 mb-1">Altura del Cilindro (h):</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="altura_cilindro" 
                        id="altura_cilindro" 
                        value="<?php echo $_POST['altura_cilindro'] ?? ''; ?>" 
                        required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition duration-150"
                        placeholder="Ej: 12.0"
                    >
                    <?php if (!empty($errores['altura_cilindro'])) echo "<p class='text-red-600 text-sm mt-1'>{$errores['altura_cilindro']}</p>"; ?>
                </div>
            </div>
            
            <button 
                type="submit"
                class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition duration-300 ease-in-out"
            >
                ✅ Calcular Áreas y Volúmenes
            </button>
        </form>
        
        <?php if (!empty($resultados)): ?>
            <div class="resultado mt-8 border-2 border-indigo-400 p-6 bg-indigo-50 rounded-lg">
                <h2 class="text-2xl font-bold text-indigo-800 mb-4">⭐ Resultados del Cálculo</h2>
                
                <?php if (isset($resultados['rectangulo_area'])): ?>
                    <h3 class="text-xl font-semibold text-gray-700 mt-4 mb-2">Rectángulo</h3>
                    <p class="text-lg text-gray-800">Área: <strong class="text-indigo-600"><?php echo $resultados['rectangulo_area']; ?></strong></p>
                    <p class="text-lg text-gray-800">Perímetro: <strong class="text-indigo-600"><?php echo $resultados['rectangulo_perimetro']; ?></strong></p>
                <?php endif; ?>

                <?php if (isset($resultados['cilindro_volumen'])): ?>
                    <h3 class="text-xl font-semibold text-gray-700 mt-4 mb-2 <?php echo (isset($resultados['rectangulo_area'])) ? 'border-t pt-4 mt-4 border-indigo-200' : ''; ?>">Cilindro</h3>
                    <p class="text-lg text-gray-800">Volumen: <strong class="text-indigo-600"><?php echo $resultados['cilindro_volumen']; ?></strong></p>
                    <p class="text-lg text-gray-800">Área Total: <strong class="text-indigo-600"><?php echo $resultados['cilindro_area_total']; ?></strong></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>