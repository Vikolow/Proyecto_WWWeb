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
        <a href="perfil.php" class="btn-login">
            <img src="img/Perfil.png" alt="Login">
        </a>
    </header>
    <main class="mainCategorias">

        <?php

        //Iniciamos la sesión
        session_start();

        //Esta función recoje el valor de la url para ejecutar la consulta correctamente
        if(isset($_REQUEST['id_art'])){
            $_SESSION['id_art'] = $_REQUEST['id_art'];
        }        

        //Incluimos la pagina de conexión con la base de datos.
        include("GestionBD/conexion.php");
            
        //Creamos la sentencia de la base de datos que recoje los datos del articulo y la ejecuta.
        $Consulta_Selecta="SELECT * FROM articulos WHERE id_articulo = {$_SESSION['id_art']} ;";
        $Resultado_Selecto=mysqli_query($conn,$Consulta_Selecta);
        $Array_Selecto=mysqli_fetch_assoc($Resultado_Selecto);

        //Creamos la sentencia de la base de datos que recoje los datos del usuario activo y la ejecuta.
        $Consulta_fav="SELECT * FROM favoritos WHERE id_usuario = {$_SESSION['id_usuario']} AND id_articulo = {$_SESSION['id_art']} ;";
        $Resultado_fav=mysqli_query($conn,$Consulta_fav);
        $Array_fav=mysqli_fetch_assoc($Resultado_fav);

        echo "<h1 class='tituloArticulos'>{$Array_Selecto['titulo']}</h1>";

        //Pinta el boton de favoritos depede de si el usuario lo tiene marcado o no
        if(mysqli_num_rows($Resultado_fav)>0){

            //Botón desActivarFavorito
            echo "<form method='POST' action=''>";
            echo    "<button type='submit' name='desActivarFavorito' class='desActivarFavorito' value=''> ⭐ </button>";
            echo "</form>";
            echo "</div>";

        }else{

            //Botón activarFavorito
            echo "<form method='POST' action=''>";
            echo    "<button type='submit' name='activarFavorito' class='desActivarFavorito' value=''> ☆ </button>";
            echo "</form>";
            echo "</div>";

        }

        echo "<h4 class='categoria'>Categoría: {$Array_Selecto['id_categoria']} </h4>";

        if(!file_exists($Array_Selecto['foto'])){
            echo "<img class='imgArticuloPrincipalImpreso' src='img/articulo.jpg' alt=''/>";
        }else{
            echo "<img class='imgArticuloPrincipalImpreso' src='{$Array_Selecto['foto']}' alt=''/>";
        }

        echo "<div class='CajaContenido'>";
        echo "<a class='contenidoArticulo'>{$Array_Selecto['contenido']}</a>";
        echo "</div>";

        //Función que Asigna el favorito
        if(isset($_REQUEST['activarFavorito'])){
            $anadir_favorito = "INSERT INTO favoritos (id_usuario, id_articulo) VALUES ( {$_SESSION['id_usuario']}, {$_SESSION['id_art']});";
            mysqli_query($conn,$anadir_favorito);
            header("Location: articulo.php");
        }

        //Función que elimina el favorito
        if(isset($_REQUEST['desActivarFavorito'])){
            $eliminar_favorito = "DELETE FROM favoritos WHERE id_usuario = {$_SESSION['id_usuario']} AND id_articulo = {$_SESSION['id_art']} ;";
            mysqli_query($conn,$eliminar_favorito);
            header("Location: articulo.php");
            }
        
        ?>

    </main>
</body>