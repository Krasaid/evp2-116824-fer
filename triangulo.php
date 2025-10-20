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
        if (!($ladoA + $ladoB > $ladoC && 
              $ladoA + $ladoC > $ladoB && 
              $ladoB + $ladoC > $ladoA)) {
            
            $errores['geometrico'] = "Error: Los lados no pueden formar un triángulo (desigualdad triangular no cumplida).";
        
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
    <style>
        .error { color: red; font-weight: bold; }
        .resultado { border: 2px solid green; padding: 15px; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Ejercicio 3: Clasificación de Triángulos</h1>

    <form method="POST" action="triangulo.php">
        
        <label for="ladoA">Lado A:</label>
        <input type="number" step="0.01" name="ladoA" id="ladoA" value="<?php echo $_POST['ladoA'] ?? ''; ?>" required>
        <?php if (!empty($errores['ladoA'])) echo "<p class='error'>{$errores['ladoA']}</p>"; ?>
        
        <label for="ladoB">Lado B:</label>
        <input type="number" step="0.01" name="ladoB" id="ladoB" value="<?php echo $_POST['ladoB'] ?? ''; ?>" required>
        <?php if (!empty($errores['ladoB'])) echo "<p class='error'>{$errores['ladoB']}</p>"; ?>
        
        <label for="ladoC">Lado C:</label>
        <input type="number" step="0.01" name="ladoC" id="ladoC" value="<?php echo $_POST['ladoC'] ?? ''; ?>" required>
        <?php if (!empty($errores['ladoC'])) echo "<p class='error'>{$errores['ladoC']}</p>"; ?>
        
        <br><br>
        <button type="submit">Clasificar</button>
    </form>
    
    <?php if (!empty($errores['geometrico'])): ?>
        <p class="error"><?php echo $errores['geometrico']; ?></p>
    <?php elseif (!empty($resultado_clasificacion)): ?>
        <div class="resultado">
            <h2>Resultado:</h2>
            <p style="font-size: 1.2em;"><?php echo $resultado_clasificacion; ?></p>
        </div>
    <?php endif; ?>

</body>
</html>