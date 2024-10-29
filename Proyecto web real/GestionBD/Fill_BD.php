<?php
 include ("conexion.php");
// INSERTAR EN ROLES
$sql_roles = "INSERT INTO Roles (nombre_rol) VALUES 
              ('Administrador'),
              ('Usuario'),
              ('Autor')";
$Resultado_roles = mysqli_query($conn, $sql_roles);

// Verificar inserción de roles
if (!$Resultado_roles) {
    die("Error al insertar roles: " . mysqli_error($conn));
}

// INSERTAR EN USUARIOS
$sql_usuarios = "INSERT INTO Usuarios (nombre, apellidos, email, password, id_rol, fecha_nacimiento, biografia) VALUES 
              ('Juan', 'Pérez López', 'juan.perez@gmail.com', 'pass1234', 1, '1990-05-14', 'Administrador principal del sitio.'),
              ('Ana', 'Martínez Díaz', 'ana.martinez@gmail.com', 'password', 2, '1985-07-22', 'Editora con gran experiencia.'),
              ('Carlos', 'García Ríos', 'carlos.garcia@gmail.com', '12345678', 3, '1992-09-10', 'Autor especializado en tecnología.'),
              ('Lucía', 'Hernández Torres', 'lucia.hernandez@gmail.com', 'secret123', 1, '1998-03-28', 'Lectora apasionada por la ciencia.'),
              ('David', 'Rodríguez Ramírez', 'david.rodriguez@gmail.com', 'davidpass', 3, '1993-12-03', 'Autor de deportes y entretenimiento.'),
              ('Elena', 'Cruz Mora', 'elena.cruz@gmail.com', 'elena123', 2, '1987-01-17', 'Editora de la sección de ciencia.'),
              ('Pedro', 'Sánchez Vargas', 'pedro.sanchez@gmail.com', 'pedropass', 1, '1995-04-11', 'Lector frecuente de temas de cultura.'),
              ('Sofía', 'López Fernández', 'sofia.lopez@gmail.com', 'sofialopez', 1, '1991-06-25', 'Administrador secundario y experto en ciencia.'),
              ('Mario', 'Gómez Ruiz', 'mario.gomez@gmail.com', 'mariogomez', 3, '1989-10-18', 'Autor especializado en innovación tecnológica.')";
$Resultado_usuarios = mysqli_query($conn, $sql_usuarios);

// Verificar inserción de usuarios
if (!$Resultado_usuarios) {
    die("Error al insertar usuarios: " . mysqli_error($conn));
}

// INSERTAR EN CATEGORIAS
$sql_categorias = "INSERT INTO Categorias (nombre_categoria) VALUES 
              ('Tecnología'),
              ('Ciencia'),
              ('Cultura'),
              ('Deportes'),
              ('Entretenimiento'),
              ('Política'),
              ('Salud'),
              ('Economía')";
$Resultado_categorias = mysqli_query($conn, $sql_categorias);

// Verificar inserción de categorías
if (!$Resultado_categorias) {
    die("Error al insertar categorías: " . mysqli_error($conn));
}

// INSERTAR EN ARTICULOS
$sql_articulos = "INSERT INTO Articulos (titulo, contenido, id_categoria) VALUES 
              ('Las últimas tendencias en tecnología', 'Contenido sobre nuevas tendencias tecnológicas...', 1),
              ('Descubrimientos científicos del año', 'Contenido sobre ciencia y descubrimientos...', 2),
              ('El impacto de la cultura pop', 'Contenido sobre cultura y entretenimiento...', 3),
              ('Novedades en el fútbol mundial', 'Contenido sobre fútbol y deportes...', 4),
              ('Cómo la tecnología está cambiando la salud', 'Innovaciones tecnológicas en la salud...', 7),
              ('Las elecciones del año y su impacto', 'Análisis político de las elecciones recientes...', 6),
              ('Economía global en tiempos de crisis', 'La economía global enfrenta desafíos...', 8),
              ('Los secretos detrás de los éxitos del cine', 'Estudio de películas y éxitos recientes...', 5),
              ('Nuevas fronteras en la inteligencia artificial', 'Desarrollo de IA y su impacto...', 1)"; 
$Resultado_articulos = mysqli_query($conn, $sql_articulos);

// Verificar inserción de artículos
if (!$Resultado_articulos) {
    die("Error al insertar artículos: " . mysqli_error($conn));
}

// Cerrar la conexión
mysqli_close($conn);

?>
