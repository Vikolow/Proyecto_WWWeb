<?php
session_start();


include("GestionBD/conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoge los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $contenido = $_POST['contenido'];
    $id_categoria = $_POST['id_categoria'];
    $id_usuario = $_SESSION['id_usuario'];

    // Inserta el nuevo artículo en la base de datos
    $sql = "INSERT INTO Articulos (titulo, descripcion, contenido, id_usuario, id_categoria) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssii", $titulo, $descripcion, $contenido, $id_usuario, $id_categoria);

    if (mysqli_stmt_execute($stmt)){
        ?>
        <script>alert('Artículo publicado con éxito');</script>
        <?php
        header("Location:escribirArticulo.php");
    } else {
        ?>
        <script>alert('Artículo no se inserto manin');</script>
        <?php
        header("Location:escribirArticulo.php");
    }

    mysqli_stmt_close($stmt);
}

// Obtenemos las categorías para mostrarlas en un menú desplegable
$resultado_categorias = mysqli_query($conn, "SELECT id_categoria, nombre_categoria FROM Categorias");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escribir Artículo</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Nuevo Artículo</h2>
        <form action="" method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="3" required></textarea>

            <label for="contenido">Contenido:</label>
            <textarea id="contenido" name="contenido" rows="8" required></textarea>

            <label for="id_categoria">Categoría:</label>
            <select id="id_categoria" name="id_categoria" required>
                <option value="">Selecciona una categoría</option>
                <?php while ($categoria = mysqli_fetch_assoc($resultado_categorias)) { ?>
                    <option value="<?php echo $categoria['id_categoria']; ?>">
                        <?php echo $categoria['nombre_categoria']; ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit">Publicar Artículo</button>
        </form>
        <a href="MainPage.php" class="volver">Volver</a>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>
