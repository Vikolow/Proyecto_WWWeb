<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peligros WWWeb</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>

    <form id="login" action="" method="post">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña"  required>
        <button type="submit" title="Ingresar" name="Ingresar">Login</button>
    </form>

    <?php
        
        if(isset($_REQUEST['Ingresar'])){
            $usuario=$_REQUEST['usuario'];
            $password=$_REQUEST['password'];
            ?>
            <br>
            <?php

            setcookie(
                "User_ID",
                $value=$password,
            );

            echo $usuario;
            echo $password;

        }
    ?>

    </header>
</body>
</html>