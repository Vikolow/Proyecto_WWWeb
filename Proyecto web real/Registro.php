<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body class="body_Registro">

<?php

  //En caso de que se pulse el boton de enviar se ejecutará este codigo
  if (isset($_REQUEST['Ingresar'])) {
            
    //Incluimos la función de conexión con la base de datos
    include("GestionBD/conexion.php");

    //Recojemos todos los datos de los campos
    $Alta_nombre=$_REQUEST['nombre'];
    $Alta_apellidos=$_REQUEST['apellidos'];
    $Alta_email=$_REQUEST['correo'];
    $Alta_contraseña=$_REQUEST['contraseña'];
    $Alta_Fecha_Nac=$_REQUEST['Fecha_Nac'];

    //Creamos la sentencia para añadir un nuevo usuario
    $Request_Alta = "INSERT INTO usuarios (Nombre, Apellidos, email, Contraseña, Fecha_Nac)
    VALUES ('$Alta_nombre','$Alta_apellidos','$Alta_email','$Alta_contraseña','$Alta_Fecha_Nac'); ";

    //Antes de crear el usuario, realizaremos una consulta para ver si existe un usuario con el mismo correo
    $consulta_correo = "SELECT * FROM usuarios WHERE email = '$Alta_email' ;";
    $Resultado_consulta_correo = mysqli_query($conn, $consulta_correo);

    //Compara el numero de filas que ha enviado la bas de datos
    if(mysqli_num_rows($Resultado_consulta_correo) <= 0){

      //En caso de que no exista ninguna contraseña igual en la base de datos, creamos al usuario y redirigimos al usuario al login
      mysqli_query($conn, $Request_Alta);
      header("Location: MainPage.php");
       
    }else{
      //En caso de encontrar algun usuario con el mismo correo se reiniciará la pagina y se mostrará un mensaje para el usuario
      header("Location: PaginaError.php");

    }


  }else{

  ?>

  <div class="principal">
    <form method="post" action="">
      <h1 class="titulo">Registro</h1>
          <br>
        <div class="wave-group">
          <input required="true" type="text" name="nombre" class="input">
          <span class="bar"></span>
            <label class="label">
              <span class="label-char" style="--index: 0">N</span>
              <span class="label-char" style="--index: 1">o</span>
              <span class="label-char" style="--index: 2">m</span>
              <span class="label-char" style="--index: 3">b</span>
              <span class="label-char" style="--index: 4">r</span>
              <span class="label-char" style="--index: 5">e</span>
            </label>
        </div>
          <br>
        <div class="wave-group">
            <input required="true" type="text" name="apellidos" class="input">
            <span class="bar"></span>
              <label class="label">
                <span class="label-char" style="--index: 0">A</span>
                <span class="label-char" style="--index: 1">p</span>
                <span class="label-char" style="--index: 2">e</span>
                <span class="label-char" style="--index: 3">l</span>
                <span class="label-char" style="--index: 4">l</span>
                <span class="label-char" style="--index: 5">i</span>
                <span class="label-char" style="--index: 6">d</span>
                <span class="label-char" style="--index: 7">o</span>
                <span class="label-char" style="--index: 8">s</span>
              </label>
        </div>
            <br>
        <div class="wave-group">
            <input required="true" type="email" name="correo" class="input">
            <span class="bar"></span>
              <label class="label">
                <span class="label-char" style="--index: 0">C</span>
                <span class="label-char" style="--index: 1">o</span>
                <span class="label-char" style="--index: 2">r</span>
                <span class="label-char" style="--index: 3">r</span>
                <span class="label-char" style="--index: 4">e</span>
                <span class="label-char" style="--index: 5">o</span>
              </label>
        </div>
            <br>
        <div class="wave-group">
            <input required="true" type="password" name="contraseña" class="input">
            <span class="bar"></span>
              <label class="label">
                <span class="label-char" style="--index: 0">C</span>
                <span class="label-char" style="--index: 1">o</span>
                <span class="label-char" style="--index: 2">n</span>
                <span class="label-char" style="--index: 3">t</span>
                <span class="label-char" style="--index: 4">r</span>
                <span class="label-char" style="--index: 5">a</span>
                <span class="label-char" style="--index: 5">s</span>
                <span class="label-char" style="--index: 5">e</span>
                <span class="label-char" style="--index: 5">ñ</span>
                <span class="label-char" style="--index: 5">a</span>
              </label>
        </div>
            <br><br>
          <label for="fechaNacimiento" class="textoFechaNacimiento" >Fecha de nacimiento: </label><br><br>
          <input placeholder="Search" class="inputDate" name="Fecha_Nac" type="date" />
            <br><br>
          <input type="submit" class="registro" value="Registrarse" name="Ingresar" id="Ingresar">
            <br><br>
          <a href="MainPage.php" class="volver"> Volver</a>
    </form>
  </div>
    <?php
      }
    ?>
</body>
</html>