<?php
include("conexion.php");

// INSERTAR EN ROLES
$sql_roles = "INSERT INTO Roles (nombre_rol) VALUES 
              ('Usuario'),
              ('Administrador'),
              ('Autor')";
$Resultado_roles = mysqli_query($conn, $sql_roles);

// Verificar inserción de roles
if (!$Resultado_roles) {
    die("Error al insertar roles: " . mysqli_error($conn));
}

// INSERTAR EN USUARIOS (con contraseñas encriptadas)
$sql_usuarios = "INSERT INTO Usuarios (nombre, apellidos, email, password, id_rol, fecha_nacimiento, biografia) VALUES 
              ('Juan', 'Pérez López', 'juan.perez@gmail.com', '".password_hash('pass1234', PASSWORD_ARGON2ID)."', 2, '1990-05-14', 'Administrador principal del sitio.'),
              ('Ana', 'Martínez Díaz', 'ana.martinez@gmail.com', '".password_hash('password', PASSWORD_ARGON2ID)."', 3, '1985-07-22', 'Editora con gran experiencia.'),
              ('Carlos', 'García Ríos', 'carlos.garcia@gmail.com', '".password_hash('12345678', PASSWORD_ARGON2ID)."', 1, '1992-09-10', 'Autor especializado en tecnología.'),
              ('Lucía', 'Hernández Torres', 'lucia.hernandez@gmail.com', '".password_hash('secret123', PASSWORD_ARGON2ID)."', 1, '1998-03-28', 'Lectora apasionada por la ciencia.'),
              ('David', 'Rodríguez Ramírez', 'david.rodriguez@gmail.com', '".password_hash('davidpass', PASSWORD_ARGON2ID)."', 3, '1993-12-03', 'Autor de deportes y entretenimiento.'),
              ('Elena', 'Cruz Mora', 'elena.cruz@gmail.com', '".password_hash('elena123', PASSWORD_ARGON2ID)."', 2, '1987-01-17', 'Editora de la sección de ciencia.'),
              ('Pedro', 'Sánchez Vargas', 'pedro.sanchez@gmail.com', '".password_hash('pedropass', PASSWORD_ARGON2ID)."', 1, '1995-04-11', 'Lector frecuente de temas de cultura.'),
              ('Sofía', 'López Fernández', 'sofia.lopez@gmail.com', '".password_hash('sofialopez', PASSWORD_ARGON2ID)."', 1, '1991-06-25', 'Administrador secundario y experto en ciencia.'),
              ('Mario', 'Gómez Ruiz', 'mario.gomez@gmail.com', '".password_hash('mariogomez', PASSWORD_ARGON2ID)."', 3, '1989-10-18', 'Autor especializado en innovación tecnológica.')";
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
$sql_articulos = "
INSERT INTO Articulos (titulo, descripcion, contenido, id_usuario, id_categoria) VALUES
('La revolución de la inteligencia artificial', 
 'Un análisis sobre los avances recientes.', 
 'La inteligencia artificial ha cambiado la manera en que interactuamos con la tecnología. Desde asistentes virtuales hasta sistemas de recomendación, su impacto es innegable AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIUDAAAAA', 
 2, 1),
('Exploración espacial: el próximo paso', 
 'Qué nos espera en la conquista del espacio.', 
 'La exploración espacial siempre ha sido una de las fronteras más emocionantes de la ciencia moderna. Con proyectos como Artemis y SpaceX liderando el camino..AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIUDAAAAAAAAAAAAAAAAAAAAA.', 
 2, 2),
('El arte digital en el siglo XXI', 
 'Cómo la tecnología redefine el arte.', 
 'Con la llegada del arte digital, los artistas tienen herramientas y oportunidades sin precedentes. Desde animaciones hasta realidad aumentada, las posibilidades son infinitas..AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAYUDAAAA.', 
 1, 3);
";
$Resultado_articulos = mysqli_query($conn, $sql_articulos);

// Verificar inserción de artículos
if (!$Resultado_articulos) {
    die("Error al insertar artículos: " . mysqli_error($conn));
}


// Cerrar la conexión
mysqli_close($conn);
?>