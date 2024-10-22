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
        Nombre VARCHAR(30) NOT NULL,
        Apellidos VARCHAR(30) NOT NULL,
        Fecha_Nac date,
        email VARCHAR(100) UNIQUE,
        Contraseña VARCHAR(100),
        reg_date TIMESTAMP
        );";

        $Resultado_usuarios= mysqli_query($conn, $sql_usuarios);
    
        if ($Resultado_usuarios)
        {
            //echo "$sql_Articulos <br>";
            echo "Tabla Usuarios creada con exito \n";
        } else 
        {
            echo "Error creando la tabla: " . mysqli_error($conn);
        }

    $sql_Articulos = "CREATE TABLE IF NOT EXISTS Articulos (
        id_articulo INT AUTO_INCREMENT PRIMARY KEY, 
        foto BLOB,
        titulo VARCHAR(50) NOT NULL,
        descripcion VARCHAR(200),
        contenido TEXT NOT NULL,
        fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        id_usuario int,
        id_categoria int
        );";

        $Resultado_articulos= mysqli_query($conn, $sql_usuarios);
    
        if ($Resultado_articulos)
        {
            //echo "$sql_Articulos <br>";
            echo "Tabla Articulos creada con exito \n";
        } else 
        {
            echo "Error creando la tabla: " . mysqli_error($conn);
        }
    
        mysqli_close($conn);
?>
