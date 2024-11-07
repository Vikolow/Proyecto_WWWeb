<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peligros WWWeb</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="img/favicon.png" />
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <header class="headermain">
        <a href="MainPage.php" class="btn-back">Volver</a>
        <div class="logo">
            <a href="MainPage.php" class="logo">
                <img class="logoimg" src="img/Logo_IPN.png">
            </a>
        </div>
        <a href="login.html" class="btn-login">
            <img src="img/Perfil.png" alt="Login">
        </a>
    </header>
    <main class="mainCategorias">

        <?php

        //Esta función recoje el valor de la url para ejecutar la consulta correctamente
        $id_art = $_REQUEST['id_art'];

        //Incluimos la pagina de conexión con la base de datos.
        include("GestionBD/conexion.php");
            
        //Creamos la sentencia de la base de datos y la ejecuta.
        $Consulta_Selecta="SELECT * FROM articulos WHERE id_articulo = $id_art ;";
        $Resultado_Selecto=mysqli_query($conn,$Consulta_Selecta);
        $Array_Selecto=mysqli_fetch_assoc($Resultado_Selecto);

        echo "<h1 class='tituloArticulos'>{$Array_Selecto['titulo']}</h1>";
        echo "<h4 class='categoria'>Categoría del artículo</h6>";
        echo "<img class='imgArticuloPrincipalImpreso' src='img/articulo.jpg'>";
        echo "<h4 class='categoria'>Autor</h6>";
        echo "<a class='contenidoArticulo'>{$Array_Selecto['contenido']}</h5>";

        ?>

    </main>
</body>