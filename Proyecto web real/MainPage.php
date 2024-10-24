<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPN</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="img/favicon.png" />
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<?php

    //Iniciamos la sesion del usuario y le asignamos un valor 0 para establecer que no ha iniciado sesión
    session_start();

    //En caso de que se pulse el boton de enviar se ejecutará este codigo
    if (isset($_REQUEST['Registrar'])){

        //Incluimos la función de conexión con la base de datos
        include("GestionBD/conexion.php");

        //Recojemos todos los datos de los campos
        $Registro_correo=$_REQUEST['correo'];
        $Registro_contraseña=$_REQUEST['contra'];

        //Creamos la consulta, la lanzamos a la base de datos y la almacenamos como un array asociativo
        $consulta_login = "SELECT * FROM usuarios WHERE email = '$Registro_correo' ;";
        $Resultado_consulta_correo = mysqli_query($conn, $consulta_login);
        $row=mysqli_fetch_assoc($Resultado_consulta_correo);

        //comprobamos que existe una cuenta asociada a el correo introducido
        if(mysqli_num_rows($Resultado_consulta_correo) > 0) {

            //comprobamos que la contraseña introducida concuerda con la insertada por el usuario
            if($row['password']==$Registro_contraseña){
            //Si el usuario y contraseña son correctos, se creara la sesión y se mostrará el catálogo de productos.

                //Creamos la sesion.
                $_SESSION['id_usuario'] = $row['id_usuario'];
                $_SESSION['clase'] = $row['nombre'];

                //Refresca la pagina
                header("Location: MainPage.php");

            }else{
                //Si la contraseña introducida no es la correcta, se informará de esto al usuario.
                ?>
                    <script>
                        alert('Error: La contraseña no existe');
                    </script>
                <?php
            }
        } else{
            //caso de que no exista el usuario, se mostrará un mensaje indicado que el usuario no existe.
            ?>
            <script>
                alert('Error: El usuario no existe');
            </script>
            <?php

        }
    }

    //Función que elimina la sesión activa de la pagina 
    if (isset($_REQUEST['desinvocador'])){
        session_destroy();
        header("Location: Mainpage.php");
    }

?>

    <div class="cajaInvocador">

        <!-- Boton vinculado a la función que cierra la sesión -->
        <form action="">
        <input type="submit" class="registro" name="desinvocador" value="Azan putero cura la cordura">
        </form>

        <button class="invocador">Azan putero invocador del login</button>

        <?php 
            // Mostrar información de la sesión
            echo "ID_Usuario: " . $_SESSION['id_usuario'] . "<br>";
            echo "tipo de usuario: " . $_SESSION['clase'] . "<br>";
            //session_destroy();
        ?>

    </div>

    <header class="heathermain">
        <a href="index.html" class="btn-back">Volver</a>
        <div class="logo"><img class="logoimg" src="img/Logo_IPN.png"></div>
        <a href="login.html" class="btn-login">
            <img src="img/Perfil.png" alt="Login">
        </a>
    </header>

    <main>
        <div class="masServicios">
            <a href="herramientas.html" class="masServicios">Herramientas</a>
        </div>
        <div class="filtros">
            <a href="#" class="masServicios">Filtros</a>
            <a href="#" class="masServicios">Filtros</a>
            <a href="#" class="masServicios">Filtros</a>
        </div>
        <article class="articuloPrincipal">
            <div class="contenidoPrincipal">
                <img class="imgArticuloPrincipal" src="img/articulo.jpg" alt=""/>
                <div class="textoArticuloPrincipal">
                    <h1 class="tituloArticuloPrincipal">Título artículo principal</h1>
                    <h5 class="descripcion">Hola. Esta es la descripción que tendrá el artículo principal. Espero que os guste</h5>
                </div>
            </div>
        </article>

        <!-- CATALOGO DINAMICO -->
        <article class="articulosSecundarios">

            <?php

            //Incluimos la pagina de conexión con la base de datos.
            include("GestionBD/conexion.php");
            
            //Creamos la sentencia de la base de datos y la ejecuta.
            $Consulta_Articulos="SELECT * FROM articulos;";
            $Resultado_Articulos=mysqli_query($conn,$Consulta_Articulos);

            //Condicional que realiza la función mientras la consulta debuelva un resultado.
            if(mysqli_num_rows($Resultado_Articulos)>0){

                while($Array_Articulos=mysqli_fetch_assoc($Resultado_Articulos)){

                    echo "<div class='contenedorImagenTexto'>";
                    echo "<img class='imgArticulo' src='img/articulo.jpg' alt=''/>";
                    echo "<div class='contenedorTexto'>";
                    echo "<h1> {$Array_Articulos['titulo']} </h1>";
                    echo "<a> {$Array_Articulos['contenido']} </a>";
                    echo "</div>";
                    echo "<button class='registro' >Leer más</button>";
                    echo "</div>";

                }
            }

            ?>

        </article>

    </main>
    <div class="anuncios"></div>
    <footer>
        <p class="copyright">Copyright</p>
    </footer>

    <!-- Link al documento js -->
    <script src="./Js/index.js"></script>

</body>
</html>