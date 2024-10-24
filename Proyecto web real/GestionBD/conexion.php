<?php
$servername = "localhost";
$username = "root";
$database = "IPN";
$password = "";


// Creamos la conexion y seleccionamos la base de datos
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Conexion fallida: " . mysqli_connect_error());
}

// Crear la base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS IPN";
if (mysqli_query($conn, $sql)) {
    echo "Base de datos creada con exito \n";
} else {
    die("Error creando la base de datos: " . mysqli_error($conn));
}

// Seleccionar la base de datos creada
$database = "IPN";
mysqli_select_db($conn, $database);
?>
