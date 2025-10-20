<?php
// Define la constante PI para precisión
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
        .calculadora-container {
            background-color: #ffffff; /* Blanco */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra gris */
            width: 100%;
            max-width: 600px;
            text-align: left;
        }
        h1, h2, h3 {
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
            margin-bottom: 15px;
        }
        .resultado {
            border: 1px solid #ccc; /* Gris claro */
            padding: 20px;
            margin-top: 30px;
            background-color: #fafafa; /* Gris muy claro */
            border-radius: 4px;
        }
        .resultado h3 {
            color: #555; /* Gris medio */
        }
        .resultado p {
            color: #333; /* Gris oscuro */
            margin: 10px 0;
        }
        hr {
            border: 0;
            border-top: 1px solid #ddd; /* Gris muy claro */
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="calculadora-container">
        <h1>Ejercicio 2: Cálculo de Área y Volumen</h1>

        <form method="POST" action="calculadora.php">
            
            <h2>Rectángulo</h2>
            <label for="base">Base (b):</label>
            <input type="number" step="0.01" name="base" id="base" value="<?php echo $_POST['base'] ?? ''; ?>" required>
            <?php if (!empty($errores['base'])) echo "<p class='error'>{$errores['base']}</p>"; ?>
            
            <label for="altura">Altura (h):</label>
            <input type="number" step="0.01" name="altura" id="altura" value="<?php echo $_POST['altura'] ?? ''; ?>" required>
            <?php if (!empty($errores['altura'])) echo "<p class='error'>{$errores['altura']}</p>"; ?>
            
            <hr>

            <h2>Cilindro</h2>
            <label for="radio">Radio (r):</label>
            <input type="number" step="0.01" name="radio" id="radio" value="<?php echo $_POST['radio'] ?? ''; ?>" required>
            <?php if (!empty($errores['radio'])) echo "<p class='error'>{$errores['radio']}</p>"; ?>
            
            <label for="altura_cilindro">Altura del Cilindro (h):</label>
            <input type="number" step="0.01" name="altura_cilindro" id="altura_cilindro" value="<?php echo $_POST['altura_cilindro'] ?? ''; ?>" required>
            <?php if (!empty($errores['altura_cilindro'])) echo "<p class='error'>{$errores['altura_cilindro']}</p>"; ?>
            
            <button type="submit">Calcular</button>
        </form>
        
        <?php if (!empty($resultados)): ?>
            <div class="resultado">
                <h2>Resultados</h2>
                
                <?php if (isset($resultados['rectangulo_area'])): ?>
                    <h3>Rectángulo</h3>
                    <p>Área: <strong><?php echo $resultados['rectangulo_area']; ?></strong></p>
                    <p>Perímetro: <strong><?php echo $resultados['rectangulo_perimetro']; ?></strong></p>
                <?php endif; ?>

                <?php if (isset($resultados['cilindro_volumen'])): ?>
                    <h3>Cilindro</h3>
                    <p>Volumen: <strong><?php echo $resultados['cilindro_volumen']; ?></strong></p>
                    <p>Área Total: <strong><?php echo $resultados['cilindro_area_total']; ?></strong></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

