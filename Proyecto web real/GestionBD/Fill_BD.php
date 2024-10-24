<?php
//Llama la función que establece la conexión con la base de datos.
include ("conexion.php");


// INSERTAR EN ROLES
$sql_roles = "INSERT INTO Roles (nombre_rol) VALUES 
              ('Administrador'),
              ('Usuario'),
              ('Autor')";
$Resultado_roles = mysqli_query($conn, $sql_roles);

// INSERTAR EN USUARIOS
$sql_usuarios = "INSERT INTO Usuarios (nombre, apellidos, email, password, id_rol, fecha_nacimiento, biografia) VALUES 
              ('Juan', 'Pérez López', 'juan.perez@gmail.com', 'pass1234', 1, '1990-05-14', 'Administrador principal del sitio.'),
              ('Ana', 'Martínez Díaz', 'ana.martinez@gmail.com', 'password', 2, '1985-07-22', 'Editora con gran experiencia.'),
              ('Carlos', 'García Ríos', 'carlos.garcia@gmail.com', '12345678', 3, '1992-09-10', 'Autor especializado en tecnología.'),
              ('Lucía', 'Hernández Torres', 'lucia.hernandez@gmail.com', 'secret123', 4, '1998-03-28', 'Lectora apasionada por la ciencia ficción.'),
              ('David', 'Rodríguez Ramírez', 'david.rodriguez@gmail.com', 'davidpass', 3, '1993-12-03', 'Autor de deportes y entretenimiento.'),
              ('Elena', 'Cruz Mora', 'elena.cruz@gmail.com', 'elena123', 2, '1987-01-17', 'Editora de la sección de ciencia.'),
              ('Pedro', 'Sánchez Vargas', 'pedro.sanchez@gmail.com', 'pedropass', 4, '1995-04-11', 'Lector frecuente de temas de cultura.'),
              ('Sofía', 'López Fernández', 'sofia.lopez@gmail.com', 'sofialopez', 1, '1991-06-25', 'Administrador secundario y experto en ciencia.'),
              ('Mario', 'Gómez Ruiz', 'mario.gomez@gmail.com', 'mariogomez', 3, '1989-10-18', 'Autor especializado en innovación tecnológica.')";
$Resultado_usuarios = mysqli_query($conn, $sql_usuarios);

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

// INSERTAR EN ARTICULOS
$sql_articulos = "INSERT INTO Articulos (titulo, contenido, id_categoria, id_usuario) VALUES 
              ('Las últimas tendencias en tecnología', 'Contenido sobre nuevas tendencias tecnológicas...', 1, 3),
              ('Descubrimientos científicos del año', 'Contenido sobre ciencia y descubrimientos...', 2, 1),
              ('El impacto de la cultura pop', 'Contenido sobre cultura y entretenimiento...', 3, 2),
              ('Novedades en el fútbol mundial', 'Contenido sobre fútbol y deportes...', 4, 4),
              ('Cómo la tecnología está cambiando la salud', 'Innovaciones tecnológicas en la salud...', 7, 5),
              ('Las elecciones del año y su impacto', 'Análisis político de las elecciones recientes...', 6, 6),
              ('Economía global en tiempos de crisis', 'La economía global enfrenta desafíos...', 8, 7),
              ('Los secretos detrás de los éxitos del cine', 'Estudio de películas y éxitos recientes...', 5, 8),
              ('Nuevas fronteras en la inteligencia artificial', 'Desarrollo de IA y su impacto...', 1, 9)";
$Resultado_articulos = mysqli_query($conn, $sql_articulos);

// INSERTAR EN ETIQUETAS
$sql_etiquetas = "INSERT INTO Etiquetas (nombre_etiqueta) VALUES 
              ('Innovación'),
              ('Ciencia Ficción'),
              ('Fútbol'),
              ('Pop'),
              ('Descubrimiento'),
              ('Salud'),
              ('Política'),
              ('Cine'),
              ('IA'),
              ('Economía')";
$Resultado_etiquetas = mysqli_query($conn, $sql_etiquetas);

// INSERTAR EN ARTICULO_ETIQUETA
$sql_articulo_etiqueta = "INSERT INTO Articulo_Etiqueta (id_articulo, id_etiqueta) VALUES 
              (1, 1),  
              (2, 5),  
              (3, 4),  
              (4, 3),  
              (5, 6),  
              (6, 7),  
              (7, 10), 
              (8, 8),  
              (9, 9)";
$Resultado_articulo_etiqueta = mysqli_query($conn, $sql_articulo_etiqueta);

// INSERTAR EN COMENTARIOS
$sql_comentarios = "INSERT INTO Comentarios (id_articulo, id_usuario, comentario) VALUES 
              (1, 4, '¡Me encanta este artículo sobre tecnología!'),
              (2, 3, 'Interesante, me gustaría saber más sobre estos descubrimientos.'),
              (3, 2, 'Gran análisis sobre la cultura pop.'),
              (4, 1, 'El fútbol siempre me ha fascinado, buen artículo.'),
              (5, 5, 'La tecnología está revolucionando la salud, excelente artículo.'),
              (6, 6, 'Este análisis político es muy acertado.'),
              (7, 7, 'Es preocupante el estado actual de la economía.'),
              (8, 8, 'Muy buen artículo sobre cine, ¡sigan así!'),
              (9, 9, 'La IA es el futuro, buen análisis.')";
$Resultado_comentarios = mysqli_query($conn, $sql_comentarios);

// INSERTAR EN FAVORITOS
$sql_favoritos = "INSERT INTO Favoritos (id_usuario, id_articulo) VALUES 
              (1, 1),  
              (2, 2),  
              (3, 3),  
              (4, 4),  
              (5, 5),  
              (6, 6),  
              (7, 7),  
              (8, 8),  
              (9, 9)";
$Resultado_favoritos = mysqli_query($conn, $sql_favoritos);

// Verificar si todas las consultas fueron exitosas
if ($Resultado_roles && $Resultado_usuarios && $Resultado_categorias && $Resultado_articulos && $Resultado_etiquetas && $Resultado_articulo_etiqueta && $Resultado_comentarios && $Resultado_favoritos) {
    echo "Datos insertados correctamente.";
} else {
    echo "Error al insertar datos: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>


?>
