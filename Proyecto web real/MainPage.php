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
        $Registro_contraseña=$_REQUEST['password'];

        //Creamos la consulta, la lanzamos a la base de datos y la almacenamos como un array asociativo
        $consulta_login = "SELECT * FROM usuarios WHERE email = '$Registro_correo' ;";
        $Resultado_consulta_correo = mysqli_query($conn, $consulta_login);
        $row=mysqli_fetch_assoc($Resultado_consulta_correo);

        //comprobamos que existe una cuenta asociada a el correo introducido
        if(mysqli_num_rows($Resultado_consulta_correo) > 0) {

            //comprobamos que la contraseña introducida concuerda con la insertada por el usuario
            if($row['Contraseña']==$Registro_contraseña){
            //Si el usuario y contraseña son correctos, se creara la sesión y se mostrará el catálogo de productos.

                //Creamos la sesion.
                $_SESSION['id_usuario'] = $row['id_Usuario'];
                $_SESSION['clase'] = $row['nombre'];

                //Refresca la pagina
                header("Location: MainPage.php");

            }else{
                //Si la contraseña introducida no es la correcta, se informará de esto al usuario.
                ?>
                    <script>
                        alert('Error: La contraseña no existe');
                        header("Location: PaginaError.php");
                    </script>
                <?php
            }
        } else{
            //caso de que no exista el usuario, se mostrará un mensaje indicado que el usuario no existe.
            ?>
            <script>
                alert('Error: El usuario no existe');
                header("Location: PaginaError.php");
            </script>
            <?php

        }
    }

?>

    <div class="cajaInvocador">
        <button class="invocador">Azan putero invocador del login</button>

        <button class="desinvocador">Azan putero elimina la sesion</button>

        <?php 
            // Mostrar información de la sesión
            echo "ID_Usuario: " . $_SESSION['id_usuario'] . "<br>";
            echo "tipo de usuario: " . $_SESSION['clase'] . "<br>";
        ?>

    </div>

    <header class="cabecera">
        <div class="superior">
            <a class="enlaceLogo" href="MainPage.php">
                <img class="logoimg" src="img/Logo_IPN.png" alt="Logo"/>
            </a>
            <a class="enlaceLogin" href="login.html">
                <img class="perfilimg" href="login.html" src="img/Perfil.png" alt="Perfil"/>
            </a>
        </div>
        <div class="masServicios">
            <a href="#" class="masServicios">Más servicios</a>
            <a href="herramientas.html" class="masServicios">Herramientas</a>
            <a href="#" class="masServicios">Más servicios</a>
        </div>
        <div class="lineaGris">
            <img src="img/linea.png">
        </div>
    </header>
    <main>
        <div class="filtros">
            <a href="#" class="masServicios">Filtros</a>
            <a href="#" class="masServicios">Filtros</a>
            <a href="#" class="masServicios">Filtros</a>
        </div>
        <article class="articuloPrincipal">
            <div class="contenidoPrincipal">
                <img class="imgArticuloPrincipal" src="img/articulo.jpg" alt=""/>
            </div>
            <h1 class="tituloArticuloPrincipal">Título artículo principal</h1>
        </article>
        <article class="articulosSecundarios">
            <img class="imgArticulo" src="img/articulo.jpg" alt=""/>
            <img class="imgArticulo" src="img/articulo.jpg" alt=""/>
            <img class="imgArticulo" src="img/articulo.jpg" alt=""/>
            <img class="imgArticulo" src="img/articulo.jpg" alt=""/>
            <img class="imgArticulo" src="img/articulo.jpg" alt=""/>
            <img class="imgArticulo" src="img/articulo.jpg" alt=""/>
            <img class="imgArticulo" src="img/articulo.jpg" alt=""/>
            <img class="imgArticulo" src="img/articulo.jpg" alt=""/>
        </article>
        <div class="pagina">
            <!-- Con Javascript -->
        </div>
    </main>
    <div class="anuncios"></div>
    <footer>
        <p class="copyright">Copyright</p>
    </footer>

    <!-- Link al documento js -->
    <script src="./Js/index.js"></script>

</body>
</html>