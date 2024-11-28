<?php
include ("GestionBD/conexion.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["email"];
    $newPassword = $_POST["newpassword"];

    $sql = "SELECT email, password FROM usuarios WHERE email = '$correo'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0)
    {
        $_SESSION['correo'] = $correo;

        $newPasswordHash = password_hash($newPassword, PASSWORD_ARGON2ID);
        $stmt = $conn->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $newPasswordHash, $correo);
        $stmt->execute();

        header("Location: restablecer.php");
        exit();
    }
    else
    {
        echo "<h2> No se ha encontrado ningún usuario existente <h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="bodyLogin">
    <div class="principal">
        <form method="post" action="">
            <h1 class="titulo">Recuperar<br>contraseña</h1>
            <br>
            <div class="wave-group">
                <input required="true" type="email" id="correo" class="input">
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
              <input required="true" type="password" id="password" class="input">
              <span class="bar"></span>
              <label class="label">
                <span class="label-char" style="--index: 0">N</span>
                <span class="label-char" style="--index: 1">u</span>
                <span class="label-char" style="--index: 2">e</span>
                <span class="label-char" style="--index: 3">v</span>
                <span class="label-char" style="--index: 4">a</span>
                <span class="label-char" style="--index: 5">&nbsp</span>
                <span class="label-char" style="--index: 6">c</span>
                <span class="label-char" style="--index: 7">o</span>
                <span class="label-char" style="--index: 8">n</span>
                <span class="label-char" style="--index: 9">t</span>
                <span class="label-char" style="--index: 10">r</span>
                <span class="label-char" style="--index: 11">a</span>
                <span class="label-char" style="--index: 12">s</span>
                <span class="label-char" style="--index: 13">e</span>
                <span class="label-char" style="--index: 14">ñ</span>
                <span class="label-char" style="--index: 15">a</span>
              </label>
            </div>
            <br>
            <div class="mostrarContrasena">
              <input type="checkbox" id="checkboxMostrarContrasena"> Mostrar contraseña <!-- La función de este checkbox se hace en javascript -->
            </div>
            <script>
              const checkbox = document.getElementById('checkboxMostrarContrasena');
              const passwordInput = document.getElementById('password');
          
              checkbox.addEventListener('change', () => {
                  passwordInput.type = checkbox.checked ? 'text' : 'password';
              });
            </script>
            <br><br>
            <input type="submit" class="registro" value="Enviar">
            <br><br>
            <a href="login.html" class="volver"> Volver</a>
        </form>
        </div>
</body>
</html>