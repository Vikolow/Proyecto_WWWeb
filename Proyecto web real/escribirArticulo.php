<?php
session_start();
include("GestionBD/conexion.php");

// Comprobar que el usuario esté autenticado y tenga el rol adecuado
// if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'autor') {
//     header("Location: login.php");
//     exit;
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoge los datos del formulario
    $titulo = htmlspecialchars($_POST['titulo'], ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
    $contenido = htmlspecialchars($_POST['contenido'], ENT_QUOTES, 'UTF-8');
    $id_categoria = (int) $_POST['id_categoria'];
    $id_usuario = $_SESSION['id_usuario'];

    // Validar la subida del archivo
    $directorioSubida = "uploads/articulos/";
    if (!is_dir($directorioSubida)) {
        mkdir($directorioSubida, 0755, true); // Crear carpeta si no existe
    }

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $rutaTemporal = $_FILES['imagen']['tmp_name'];
        $tipoReal = mime_content_type($rutaTemporal);
        $permitidos = ['image/jpeg', 'image/png', 'image/webp'];

        // Validar tipo MIME
        if (!in_array($tipoReal, $permitidos)) {
            echo "<script>alert('El tipo de archivo no es válido. Solo se permiten JPG, PNG o WEBP.');</script>";
            exit;
        }

        // Validar tamaño (máximo 2MB)
        $SizeMaximo = 2 * 1024 * 1024; // 2 MB
        if ($_FILES['imagen']['size'] > $SizeMaximo) {
            echo "<script>alert('El archivo es demasiado grande. Máximo permitido: 2MB.');</script>";
            exit;
        }

        // Renombrar archivo usando sólo el timestamp
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nuevoNombre = date("Ymd_His") . "." . $extension; // Ejemplo: 20241128_143012.jpg
        $rutaDestino = $directorioSubida . $nuevoNombre;

        if (!move_uploaded_file($rutaTemporal, $rutaDestino)) {
            echo "<script>alert('Hubo un error al subir el archivo.');</script>";
            exit;
        }
    } else {
        $rutaDestino = null; 
    }

    // Inserta el nuevo artículo en la base de datos
    $sql = "INSERT INTO Articulos (titulo, descripcion, contenido, id_usuario, id_categoria, foto) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssiss", $titulo, $descripcion, $contenido, $id_usuario, $id_categoria, $rutaDestino);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Artículo publicado con éxito');</script>";
        header("Location: perfil.php");
        exit;
    } else {
        echo "<script>alert('Hubo un error al publicar el artículo.');</script>";
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
        <form action="" method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required maxlength="100">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="3" required></textarea>

            <label for="contenido">Contenido:</label>
            <textarea id="contenido" name="contenido" rows="8" required></textarea>

            <label for="id_categoria">Categoría:</label>
            <select id="id_categoria" name="id_categoria" required>
                <option value="">Selecciona una categoría</option>
                <?php while ($categoria = mysqli_fetch_assoc($resultado_categorias)) { ?>
                    <option value="<?php echo $categoria['id_categoria']; ?>">
                        <?php echo htmlspecialchars($categoria['nombre_categoria'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php } ?>
            </select>

            <label for="imagen">Seleccionar imagen (JPG, PNG, WEBP | Máximo 2MB):</label>
            <input type="file" id="imagen" name="imagen" accept=".jpg,.jpeg,.png,.webp" required>

            <button type="submit">Publicar Artículo</button>
        </form>
        <a href="MainPage.php" class="volver">Volver</a>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>
