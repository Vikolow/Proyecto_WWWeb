<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "IPN";


// Creamos la conexion y seleccionamos la base de datos
$conn = mysqli_connect($servername, $username, $password,$database);
// Check connection
if (!$conn) {
    die("Conexion fallida: " . mysqli_connect_error());
}

?>