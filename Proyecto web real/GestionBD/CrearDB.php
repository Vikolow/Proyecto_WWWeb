<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Crea la conexión al SGBD
    $conn = mysqli_connect($servername, $username, $password);

    // Comprueba si la conexión se ha establecido
    if (!$conn) {
        die("Conexion fallida: " . mysqli_connect_error());
    }

    // Aquí solo llegamos si la conexión se ha establecido, entonces se crea la tabla IAW
    //Almacena la sentencia en la variable $sql y la ejecuta
    $sql = "CREATE DATABASE IF NOT EXISTS IPN";
    if (mysqli_query($conn, $sql)) {
        echo "Base de datos creada con exito \n";
    } else {
        echo "Error creando la base de datos: " . mysqli_error($conn);
    }

	mysqli_close($conn);

    //Llama la función que establece la conexión con la base de datos.
    include ("conexion.php");

    //Creamos la sentencia para crear la tabla de usuarios
    $sql_usuarios = "CREATE TABLE IF NOT EXISTS Usuarios (
        id_Usuario INT  AUTO_INCREMENT PRIMARY KEY, 
        Nombre VARCHAR(30) NOT NULL UNIQUE,
        Apellidos VARCHAR(30) NOT NULL,
        Fecha_Nac date,
        email VARCHAR(100),
        Contraseña VARCHAR(100),
        reg_date TIMESTAMP
        );";
       
        $Resultado= mysqli_query($conn, $sql_usuarios);
    
        if ($Resultado)
        {
            //echo "$sql_Articulos <br>";
            echo "Tabla Usuarios creada con exito \n";
        } else 
        {
            echo "Error creando la tabla: " . mysqli_error($conn);
        }
    
        mysqli_close($conn);
?>
