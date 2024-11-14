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

    // Comprobar si la variable de sesión ya está definida
    if (!isset($_SESSION['sesionActiva'])) {

        // Si no está definida, asignarle el valor predeterminado de 1
        $_SESSION['sesionActiva'] = 0;
    }
    

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
                $_SESSION['clase'] = $row['id_rol'];

                //Asignamos que la sesión está activa
                $_SESSION['sesionActiva'] = 1;

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
        $_SESSION['sesionActiva'] = 0;
    }

    //Incluimos la función de conexión con la base de datos
    include("GestionBD/conexion.php");

    //Función que elimina un articulo
    if (isset($_REQUEST['id_elimart'])){

        //Recojemos el dato que envia el boton para conocer el id del articulo a eliminar
        $id_art = $_REQUEST['id_elimart'];

        //Creamos la sentencia SQL
        $elimArticulo= "DELETE FROM articulos WHERE id_articulo = '$id_art' ;";

        //Ejecutamos la sentencia
        if(mysqli_query($conn, $elimArticulo)){
            ?> <script> alert("El articulo ha sido eliminado") </script>; <?php
        }
    }

?>

    <div class="cajaInvocador">

        <?php 
            // Mostrar información de la sesión
            echo "ID_Usuario: " . $_SESSION['id_usuario'] . "<br>";
            echo "tipo de usuario: " . $_SESSION['clase'] . "<br>";
            //session_destroy();
        ?>

    </div>

    <header class="headermain">
        <form action="">
            <input type="submit" class="btn-back" name="desinvocador" value="Logout">
        </form>
        <div class="logo">
            <a href="MainPage.php" class="logo">
                <img class="logoimg" src="img/Logo_IPN.png">
            </a>
        </div>

        <div>

        <?php

        //Dependiendo de si la sesión está activa o la funcio e imagen del botón cambia
        if($_SESSION['sesionActiva'] == 0){
            echo"<a class='invocador btn-login'>";
            echo"<img src='img/Perfilote.png'>";
            echo"</a>";
        }else{
            echo"<a class='btn-login' href='MainPage.php'>";
            echo"<img src='img/Perfilote_dark_green.png'>";
            echo"</a>";
        }

        //En caso de que el usuario registrado sea de tipo admin, crea un botón para acceder a la pagina
        //Comprovamos que haya una sesión activa
        if(($_SESSION['sesionActiva'] == 1)){

            //Comprueva si el susuario es admin
            if($_SESSION['clase'] == 1){
                echo"<a class='btn-login' href='perfil.php'>";
                echo"<img src='img/Perfilote.png'>";
                echo"</a>";
            }
        }
        
        ?>

        </div>

    </header>

    <main>
        
        <!-- Heather -->
        </div class="contenedorMasServicios">
            <div class="masServicios">
                <a href="herramientas.html" class="masServicios">Herramientas</a>
            </div>
        <div>
            
        <div class="linea"></div>

        <!-- Caja de articulo principal -->
        <article class="articuloPrincipal">
            <div class="contenidoPrincipal">
                <img class="imgArticuloPrincipal" src="img/articulo.jpg" alt=""/>
                <div class="textoArticuloPrincipal">
                    <h1 class="tituloArticuloPrincipal">Título artículo principal</h1>
                    <h5 class="descripcion">Hola. Esta es la descripción que tendrá el artículo principal. Espero que os guste</h5>
                </div>
            </div>
        </article>

        <?php

        //Funcion que modifica unas variables que modifican la consulta
        $categoriaActiva="";

        //Añade categoria1
        if (isset($_REQUEST['Categoria1'])){
            $categoriaActiva="WHERE id_categoria = 1";
        }

        //Añade categoria2
        if (isset($_REQUEST['Categoria2'])){
            $categoriaActiva="WHERE id_categoria = 2";
        }

        //Añade categoria3
        if (isset($_REQUEST['Categoria3'])){
            $categoriaActiva="WHERE id_categoria = 3";
        }

        //Limpiar categorias
        if (isset($_REQUEST['CategoriaL'])){
            $categoriaActiva="";
        }


        ?>

        <!-- Botones de Categoria -->
        <div class="botonesCategorias">

            <form action="" class="form_categorias">
                <input type="submit" class="btn-back" name="Categoria1" value="Categoria1">
            </form>

            <form action="" class="form_categorias">
                <input type="submit" class="btn-back" name="Categoria2" value="Categoria2">
            </form>

            <form action="" class="form_categorias">
                <input type="submit" class="btn-back" name="Categoria3" value="Categoria3">
            </form>

            <form action="" class="form_categorias">
                <input type="submit" class="btn-back" name="CategoriaL" value="Limpiar Categoria">
            </form>

        </div>

        <!-- CATALOGO DINAMICO -->
        <article class="articulosSecundarios">

            <?php

            //Incluimos la pagina de conexión con la base de datos.
            include("GestionBD/conexion.php");
            
            //Creamos la sentencia de la base de datos y la ejecuta.
            $Consulta_Articulos="SELECT * FROM articulos $categoriaActiva ;";
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
                    echo "<div class='abrazoBotones'>";

                    if($_SESSION['sesionActiva'] == 0){
                        echo "<button name='id_art' class='registro invocador' value=''>Leer más</button>";
                    }else{
                        echo "<form method='POST' action='articulo.php'>";
                        echo "<button type='submit' name='id_art' class='registro' value='{$Array_Articulos['id_articulo']}'>Leer más</button>";
                        echo "</form> ";
                    }

                    if(($_SESSION['sesionActiva'] == 1)){

                        if($_SESSION['clase'] == 1){
                            echo "<form method='POST' action='MainPage.php'>";
                            //echo "<a name='' href = 'MainPage.php?IdArticulo={$Array_Articulos['id_articulo']}'> Eliminar </a>";
                            echo "<button type='submit' name='id_elimart' class='registro2' value='{$Array_Articulos['id_articulo']}'>Eliminar</button>";
                            echo "</form> ";
                        }
                    }

                    echo "</div>";
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