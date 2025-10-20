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
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Gris claro */
            color: #333; /* Gris oscuro */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .triangulo-container {
            background-color: #ffffff; /* Blanco */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra gris */
            width: 100%;
            max-width: 500px;
            text-align: left;
        }
        h1, h2 {
            color: #555; /* Gris medio */
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #666; /* Gris */
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc; /* Gris claro */
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #fafafa; /* Gris muy claro */
            color: #333;
        }
        input[type="number"]:focus {
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
            margin-top: 20px;
        }
        button:hover {
            background-color: #666; /* Gris más oscuro */
        }
        .error {
            color: #d9534f; /* Rojo grisáceo para errores */
            font-weight: bold;
            margin-bottom: 15px;
        }
        .resultado {
            border: 1px solid #ccc; /* Gris claro */
            padding: 20px;
            margin-top: 30px;
            background-color: #fafafa; /* Gris muy claro */
            border-radius: 4px;
        }
        .resultado h2 {
            color: #555; /* Gris medio */
        }
        .resultado p {
            color: #333; /* Gris oscuro */
            font-size: 1.2em;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="triangulo-container">
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
            
            <button type="submit">Clasificar</button>
        </form>
        
        <?php if (!empty($errores['geometrico'])): ?>
            <p class="error"><?php echo $errores['geometrico']; ?></p>
        <?php elseif (!empty($resultado_clasificacion)): ?>
            <div class="resultado">
                <h2>Resultado:</h2>
                <p><?php echo $resultado_clasificacion; ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
