<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Correo</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Bienvenido</h1>

    <?php
    session_start();

    if (isset($_SESSION['correo'])) {
        $correo = $_SESSION['correo'];
        echo "<p>El correo es: " . htmlspecialchars($correo) . "</p>";
        unset($_SESSION['correo']);
    } else {
        echo "<p>No se encontró ningún correo en la sesión.</p>";
    }
    ?>

</body>
</html>
