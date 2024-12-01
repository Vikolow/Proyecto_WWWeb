<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body class="body_herramientas">

    <header class="headermain">
        <a href="MainPage.php" class="btn-back">Volver</a>
        <div class="logo">
            <a href="MainPage.php" class="logo">
                <img class="logoimg" src="img/Logo_IPN.png">
            </a>
        </div>

        <!-- Formulario que llama a la función de cerrar sesión -->
        <form action="">
            <input type="submit" class="btn-back" name="desinvocador" value="Logout">
        </form>

        <?php
            
            //Función que elimina la sesión activa de la pagina 
            if (isset($_REQUEST['desinvocador'])){
                session_destroy();
                $_SESSION['sesionActiva'] = 0;
                header("Location: Mainpage.php");
            }

        ?>

    </header>
    <main>
        <div class="tituloPerfil">
            <h2 class="tituloPerfilLetra"> Panel de Usuario </h2>
        </div>

        <div class="perfilContainer">
                <img class="fotoPerfil" src="img/PerfilNegro.png">
            <div class="infoPerfil">

            <!-- Rellena los datos del usuario -->
                <?php

                //Incluimos la función que realiza la conexión con la base de datos
                include("GestionBD/conexion.php");

                //Iniciamos otra vez la sesión
                session_start();

                //Ya funciona
                $consulta_datos = "SELECT * FROM usuarios WHERE id_usuario = {$_SESSION['id_usuario']};";
                $Resultado_consulta_datos = mysqli_query($conn,$consulta_datos);
                $Resultado_Array=mysqli_fetch_assoc($Resultado_consulta_datos);

                echo"<p>• Nombre: {$Resultado_Array['nombre']}</p>";
                echo"<p>• Apellidos: {$Resultado_Array['apellidos']}</p>";
                echo"<p>• Correo: {$Resultado_Array['email']}</p>";
                echo"<p>• Solicitudes restantes: {$Resultado_Array['numero_peticiones_restante']}</p>";
                echo"<p>• Solicitudes Activas: {$Resultado_Array['peticion_activa']}</p>";

                //Dependiendo del rol muestra un mensaje

                //Consulta geeral que saca los datos del usuario
                $Solicitud_usuario = "SELECT * FROM usuarios WHERE id_usuario = {$_SESSION['id_usuario']};";
                $Resultado_Solicitud_usuario = mysqli_query($conn,$Solicitud_usuario);
                $Resultado_Array_usuario=mysqli_fetch_assoc($Resultado_Solicitud_usuario);

                switch ($Resultado_Array_usuario['id_rol']) {
                    case 1:
                        echo "<p>• Rol: Administrador </p>";
                        break;
                    case 2:
                        echo "<p>• Rol: Usuario </p>";
                        break;
                    case 3:
                        echo "<p>• Rol: Autor </p>";
                        break;
                }

                ?>

            </div>

        </div>

        <div class="botonesPerfil">

            <a href="escribirArticulo.php">
                <button class="botonPerfil"> Crear artículo </button>
            </a>

            <!-- Formulario que llama a la funcion de pedir autor -->
            <form method='POST' action=''>
                <button type='submit' name='botonPerfil' class='botonPerfil' value=''>Pedir autor</button>
            </form>

            <!-- Función que llama a la base de datos para enviar una solicitud de admin -->
            <?php

                //Al pulsar el boton de pedir autor
                if (isset($_REQUEST['botonPerfil'])){

                    //En caso de que el usuario ya tenga privilegios de administrador envia un mensaje
                    if($Resultado_Array_usuario['id_rol'] == 1 || 3){

                        ?>
                        <script> alert('Error: Ya posees el rol de autor o superior')</script>
                        <?php

                        //En caso de que el usuario no tenga más tokens de solicitud:
                    }else if($Resultado_Array_usuario['numero_peticiones_restante'] < 1){

                        ?>
                        <script> alert('Error: No te quedan tokens para realizar la petición')</script>
                        <?php

                        //En caso de que el usuario ya tenga una solicitud activa:
                    }else if($Resultado_Array_usuario['peticion_activa'] == 1){

                        ?>
                        <script> alert('Error: Ya tienes una solicitud activa')</script>
                        <?php

                    }else{

                        //Creamos la solicitud que activa una petición y resta un token
                        $EnviarSolicitud = "UPDATE usuarios SET peticion_activa = 1, numero_peticiones_restante = numero_peticiones_restante - 1 WHERE id_usuario = {$_SESSION['id_usuario']}";
                        mysqli_query($conn,$EnviarSolicitud);

                        header("Location: perfil.php");
                    }
                }
            ?>

        </div>


        <div class="peticiones">
                
            <?php
                //Creamos la solicitud que recojerá todas las peticiones de los usuarios 
                $Sentencia_Solicitudes = "SELECT * FROM usuarios WHERE peticion_activa = 1 ;";
                $Resultado_Solicitud = mysqli_query($conn,$Sentencia_Solicitudes);

                //Si hay usuarios que tengan solicitudes continua, si no hay solicitudes no hacer nada
                if(mysqli_num_rows($Resultado_Solicitud)>0 && $Resultado_Array_usuario['id_rol'] == 1){

                    //Por cada usuario pinta un registro 
                    while($Resultado_Peticiones=mysqli_fetch_assoc($Resultado_Solicitud)){

                        //Nombre
                        echo "<div class='solicitudes'>";
                        echo "<p>";
                        echo    "{$Resultado_Peticiones['nombre']} {$Resultado_Peticiones['apellidos']} ha pedido acceso ";

                        //Botón aceptar
                        echo "<form method='POST' action=''>";
                        echo    "<button type='submit' name='btnPetis' class='btnPetis' value='{$Resultado_Peticiones['id_usuario']}'> Aceptar </button>";
                        echo "</form>";

                        //Botón rechazar
                        echo "<form method='POST' action=''>";
                        echo    "<button type='submit' name='btnPetisRechazo' class='btnPetisRechazo' value='{$Resultado_Peticiones['id_usuario']}'> Rechazar </button>";
                        echo "</form>";

                        echo "</p>";
                        echo "</div>";
                    }
                }


                //Función que deniega la solicitud

                if(isset($_REQUEST['btnPetisRechazo'])){

                    //Sentencia que actualiza el usuario denegando la solicitud
                    $id_usuario_solicitud_rechazar = $_REQUEST['btnPetisRechazo'];
                    $sentencia_eliminar_peticion_activa = "UPDATE usuarios SET peticion_activa = 0 WHERE id_usuario = $id_usuario_solicitud_rechazar";
                    $Resultado_eliminar_peticion = mysqli_query($conn,$sentencia_eliminar_peticion_activa);
                    header("Location: perfil.php");
                }

                //Función que acepta la solicitud

                if(isset($_REQUEST['btnPetis'])){

                    //Sentencia que actualiza el usuario aceptando la solicitud
                    $id_usuario_solicitud_aceptar = $_REQUEST['btnPetis'];
                    $sentencia_aceptar_peticion_activa = "UPDATE usuarios SET peticion_activa = 0, id_rol = 3 WHERE id_usuario = $id_usuario_solicitud_aceptar";
                    $Resultado_aceptar_peticion = mysqli_query($conn,$sentencia_aceptar_peticion_activa);
                    header("Location: perfil.php");
                }

            ?>

        </div>

        <div class="favoritos">
            <h2>⭐ Favoritos:</h2>
            <div class="cajaFavoritos">

                <?php

                //Realiza un request a la base de datos para ver si el usuario tiene algún archivo favorito
                $favoritos_usuario = "SELECT * FROM favoritos WHERE id_usuario = {$_SESSION['id_usuario']} ";
                $resultado_favoritos_usuario = mysqli_query($conn,$favoritos_usuario);

                //En caso de que el usuario tenga articulos favoritos, los imprime de forma dinamica

                if(mysqli_num_rows($resultado_favoritos_usuario)>0){

                    while($Array_id_favoritos=mysqli_fetch_assoc($resultado_favoritos_usuario)){

                    $info_articulos = "SELECT * FROM articulos WHERE id_articulo = {$Array_id_favoritos['id_articulo']}";
                    $esquizo = mysqli_query($conn,$info_articulos);
                    $Array_articulo_fav=mysqli_fetch_assoc($esquizo);

                    echo"<div class='favorito-item'>";

                    if(!file_exists($Array_articulo_fav['foto'])){
                        echo "<img class='favorito' src='img/articulo.jpg' alt=''/>";
                    }else{
                        echo "<img class='favorito' src='{$Array_articulo_fav['foto']}' alt=''/>";
                    }

                    echo "<form method='POST' action='articulo.php'>";
                    echo "<button type='submit' name='id_art' class='registro3' value='{$Array_articulo_fav['id_articulo']}'> {$Array_articulo_fav['titulo']} </button>";
                    echo "</form> ";

                    echo"</div>";

                    }
                }

                ?>

            </div>
        </div>
    </main>
    <footer>
        <p class="copyright">Copyright © 2024</p>
    </footer>
</body>
</html>