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
    <title>Escribir artículo</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <header class="headermain">
        <a href="index.html" class="btn-back">Volver</a>
        <div class="logo">
            <a href="index.html" class="logo">
                <img class="logoimg" src="img/Logo_IPN.png">
            </a>
        </div>
        <a href="login.html" class="btn-login">
            <img src="img/Perfil.png" alt="Login">
        </a>
    </header>
    <main>
        <div class="tituloCalc">
            <h2 class="tituloCrear">Escribir artículo</h2>
        </div>
        <div class="form-container">
            <form action="" method="post">
                <div class="contenidoCrearArticulo">
                    <label for="tituloNuevoArticulo" class="tituloNuevoArticulo">Título:</label>
                    <input type="text" id="tituloNuevoArticulo" name="tituloNuevoArticulo" required>
                </div>
                <div class="contenidoCrearArticulo">
                    <label for="descripcion" class="tituloNuevoArticulo">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>
                <div class="contenidoCrearArticulo">
                    <label for="contenido" class="tituloNuevoArticulo">Contenido:</label>
                    <textarea id="contenido" name="contenido" rows="18" required></textarea>
                </div>
                <div class="contenidoCrearArticulo">
                    <label for="imagen" class="tituloNuevoArticulo">Selecciona una imagen:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" required>
                </div>
                <div class="contenidoCrearArticulo">
                    <label for="id_categoria" class="tituloNuevoArticulo">Categoría:</label>
                    <select id="id_categoria" name="id_categoria" required>
                        <option value="">Selecciona una categoría</option>
                <?php while ($categoria = mysqli_fetch_assoc($resultado_categorias)) { ?>
                    <option value="<?php echo $categoria['id_categoria']; ?>">
                        <?php echo $categoria['nombre_categoria']; ?>
                    </option>
                <?php } ?>
                </select>
                </div>
                <div class="contenidoCrearArticulo">
                    <button type="submit" class="publicar">Publicar artículo</button>
                </div>
            </form>
        </div>
        </div>
    </main>
    <footer>
        <p class="copyright">© 2024 Informática para novatos. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

<?php mysqli_close($conn); ?>
