<?php
$errores = [];
$resultado_clasificacion = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Recolección de datos
    $ladoA = filter_input(INPUT_POST, 'ladoA', FILTER_VALIDATE_FLOAT);
    $ladoB = filter_input(INPUT_POST, 'ladoB', FILTER_VALIDATE_FLOAT);
    $ladoC = filter_input(INPUT_POST, 'ladoC', FILTER_VALIDATE_FLOAT);

    // --- 2. Validación de Numéricos y Positivos ---
    if ($ladoA === false || $ladoA <= 0) {
        $errores['ladoA'] = "Lado A debe ser un número positivo.";
    }
    if ($ladoB === false || $ladoB <= 0) {
        $errores['ladoB'] = "Lado B debe ser un número positivo.";
    }
    if ($ladoC === false || $ladoC <= 0) {
        $errores['ladoC'] = "Lado C debe ser un número positivo.";
    }
    
    // Si la validación inicial es exitosa:
    if (empty($errores)) {
        
        // --- 3. Validación de Desigualdad Triangular ---
        // La suma de dos lados debe ser siempre mayor que el tercer lado.
        if (!($ladoA + $ladoB > $ladoC && 
              $ladoA + $ladoC > $ladoB && 
              $ladoB + $ladoC > $ladoA)) {
            
            $errores['geometrico'] = "Error Geométrico: Los lados no pueden formar un triángulo (desigualdad triangular no cumplida).";
        
        } else {
            // --- 4. Clasificación Final (Solo si es un triángulo válido) ---
            
            if ($ladoA == $ladoB && $ladoB == $ladoC) {
                $resultado_clasificacion = "Equilátero (Tres lados iguales) 🟢";
            } 
            elseif ($ladoA == $ladoB || $ladoA == $ladoC || $ladoB == $ladoC) {
                $resultado_clasificacion = "Isósceles (Dos lados iguales) 🟡";
            } 
            else {
                $resultado_clasificacion = "Escaleno (Tres lados distintos) 🔴";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Clasificador de Triángulos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen m-0 p-6">
    <div class="triangulo-container bg-white p-8 rounded-xl shadow-2xl w-full max-w-md text-left">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-3">🔺 Ejercicio 3: Clasificación de Triángulos</h1>

        <form method="POST" action="triangulo.php">
            
            <div class="mb-4">
                <label for="ladoA" class="block text-sm font-medium text-gray-700 mb-1">Longitud Lado A:</label>
                <input 
                    type="number" 
                    step="0.01" 
                    name="ladoA" 
                    id="ladoA" 
                    value="<?php echo $_POST['ladoA'] ?? ''; ?>" 
                    required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition duration-150"
                    placeholder="Ej: 5.0"
                >
                <?php if (!empty($errores['ladoA'])) echo "<p class='text-red-600 text-sm mt-1 font-medium'>{$errores['ladoA']}</p>"; ?>
            </div>
            
            <div class="mb-4">
                <label for="ladoB" class="block text-sm font-medium text-gray-700 mb-1">Longitud Lado B:</label>
                <input 
                    type="number" 
                    step="0.01" 
                    name="ladoB" 
                    id="ladoB" 
                    value="<?php echo $_POST['ladoB'] ?? ''; ?>" 
                    required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition duration-150"
                    placeholder="Ej: 5.0"
                >
                <?php if (!empty($errores['ladoB'])) echo "<p class='text-red-600 text-sm mt-1 font-medium'>{$errores['ladoB']}</p>"; ?>
            </div>
            
            <div class="mb-4">
                <label for="ladoC" class="block text-sm font-medium text-gray-700 mb-1">Longitud Lado C:</label>
                <input 
                    type="number" 
                    step="0.01" 
                    name="ladoC" 
                    id="ladoC" 
                    value="<?php echo $_POST['ladoC'] ?? ''; ?>" 
                    required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition duration-150"
                    placeholder="Ej: 7.0"
                >
                <?php if (!empty($errores['ladoC'])) echo "<p class='text-red-600 text-sm mt-1 font-medium'>{$errores['ladoC']}</p>"; ?>
            </div>
            
            <button 
                type="submit"
                class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition duration-300 ease-in-out mt-4"
            >
                🔍 Clasificar Triángulo
            </button>
        </form>
        
        <?php if (!empty($errores['geometrico'])): ?>
            <div class="mt-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <p class="font-bold">❌ Error en la Geometría</p>
                <p><?php echo $errores['geometrico']; ?></p>
            </div>
        <?php elseif (!empty($resultado_clasificacion)): ?>
            <div class="resultado mt-6 p-6 border-2 border-indigo-400 bg-indigo-50 rounded-lg text-center">
                <h2 class="text-xl font-bold text-indigo-800 mb-2">Clasificación Obtenida:</h2>
                <p class="text-2xl font-extrabold text-gray-800"><?php echo $resultado_clasificacion; ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>