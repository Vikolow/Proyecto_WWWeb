
USE IPN;

-- Insertar en Roles
INSERT INTO Roles (nombre_rol)
VALUES
('Administrador'),
('Editor'),
('Autor'),
('Lector'),
('Moderador');

-- Insertar en Usuarios
INSERT INTO Usuarios (nombre, apellidos, email, password, id_rol, fecha_nacimiento, biografia)
VALUES
('Juan', 'Pérez López', 'juan.perez@gmail.com', 'pass1234', 1, '1990-05-14', 'Administrador principal del sitio.'),
('Ana', 'Martínez Díaz', 'ana.martinez@gmail.com', 'password', 2, '1985-07-22', 'Editora con gran experiencia.'),
('Carlos', 'García Ríos', 'carlos.garcia@gmail.com', '12345678', 3, '1992-09-10', 'Autor especializado en tecnología.'),
('Lucía', 'Hernández Torres', 'lucia.hernandez@gmail.com', 'secret123', 4, '1998-03-28', 'Lectora apasionada por la ciencia ficción.'),
('David', 'Rodríguez Ramírez', 'david.rodriguez@gmail.com', 'davidpass', 3, '1993-12-03', 'Autor de deportes y entretenimiento.'),
('Elena', 'Cruz Mora', 'elena.cruz@gmail.com', 'elena123', 2, '1987-01-17', 'Editora de la sección de ciencia.'),
('Pedro', 'Sánchez Vargas', 'pedro.sanchez@gmail.com', 'pedropass', 4, '1995-04-11', 'Lector frecuente de temas de cultura.'),
('Sofía', 'López Fernández', 'sofia.lopez@gmail.com', 'sofialopez', 1, '1991-06-25', 'Administrador secundario y experto en ciencia.'),
('Mario', 'Gómez Ruiz', 'mario.gomez@gmail.com', 'mariogomez', 3, '1989-10-18', 'Autor especializado en innovación tecnológica.');

-- Insertar en Categorias
INSERT INTO Categorias (nombre_cat)
VALUES
('Tecnología'),
('Ciencia'),
('Cultura'),
('Deportes'),
('Entretenimiento'),
('Política'),
('Salud'),
('Economía');

-- Insertar en Articulos
INSERT INTO Articulos (titulo, contenido, id_categoria, id_autor)
VALUES
('Las últimas tendencias en tecnología', 'Contenido sobre nuevas tendencias tecnológicas...', 1, 3),
('Descubrimientos científicos del año', 'Contenido sobre ciencia y descubrimientos...', 2, 1),
('El impacto de la cultura pop', 'Contenido sobre cultura y entretenimiento...', 3, 2),
('Novedades en el fútbol mundial', 'Contenido sobre fútbol y deportes...', 4, 4),
('Cómo la tecnología está cambiando la salud', 'Innovaciones tecnológicas en la salud...', 7, 5),
('Las elecciones del año y su impacto', 'Análisis político de las elecciones recientes...', 6, 6),
('Economía global en tiempos de crisis', 'La economía global enfrenta desafíos...', 8, 7),
('Los secretos detrás de los éxitos del cine', 'Estudio de películas y éxitos recientes...', 5, 8),
('Nuevas fronteras en la inteligencia artificial', 'Desarrollo de IA y su impacto...', 1, 9);

-- Insertar en Etiquetas
INSERT INTO Etiquetas (nombre_etiqueta)
VALUES
('Innovación'),
('Ciencia Ficción'),
('Fútbol'),
('Pop'),
('Descubrimiento'),
('Salud'),
('Política'),
('Cine'),
('IA'),
('Economía');

-- Insertar en Articulo_Etiqueta
INSERT INTO Articulo_Etiqueta (id_articulo, id_etiqueta)
VALUES
(1, 1),  -- 'Innovación' para el artículo sobre tecnología
(2, 5),  -- 'Descubrimiento' para el artículo sobre ciencia
(3, 4),  -- 'Pop' para el artículo de cultura
(4, 3),  -- 'Fútbol' para el artículo de deportes
(5, 6),  -- 'Salud' para el artículo sobre salud
(6, 7),  -- 'Política' para el artículo de política
(7, 10), -- 'Economía' para el artículo de economía
(8, 8),  -- 'Cine' para el artículo de cine
(9, 9);  -- 'IA' para el artículo de inteligencia artificial

-- Insertar en Comentarios
INSERT INTO Comentarios (id_articulo, id_usuario, comentario)
VALUES
(1, 4, '¡Me encanta este artículo sobre tecnología!'),
(2, 3, 'Interesante, me gustaría saber más sobre estos descubrimientos.'),
(3, 2, 'Gran análisis sobre la cultura pop.'),
(4, 1, 'El fútbol siempre me ha fascinado, buen artículo.'),
(5, 5, 'La tecnología está revolucionando la salud, excelente artículo.'),
(6, 6, 'Este análisis político es muy acertado.'),
(7, 7, 'Es preocupante el estado actual de la economía.'),
(8, 8, 'Muy buen artículo sobre cine, ¡sigan así!'),
(9, 9, 'La IA es el futuro, buen análisis.');

-- Insertar en Favoritos
INSERT INTO Favoritos (id_usuario, id_articulo)
VALUES
(1, 1),  -- El administrador guarda el artículo sobre tecnología
(2, 2),  -- La editora guarda el artículo sobre ciencia
(3, 3),  -- El autor guarda el artículo sobre cultura
(4, 4),  -- La lectora guarda el artículo sobre deportes
(5, 5),  -- David guarda el artículo sobre salud
(6, 6),  -- Elena guarda el artículo sobre política
(7, 7),  -- Pedro guarda el artículo sobre economía
(8, 8),  -- Sofía guarda el artículo sobre cine
(9, 9);  -- Mario guarda el artículo sobre inteligencia artificial

-- Insertar en roles_usuarios
INSERT INTO roles_usuarios (id_usuario, id_rol)
VALUES
(1, 1),  -- Juan es Administrador
(2, 2),  -- Ana es Editora
(3, 3),  -- Carlos es Autor
(4, 4),  -- Lucía es Lectora
(5, 3),  -- David es Autor
(6, 2),  -- Elena es Editora
(7, 4),  -- Pedro es Lector
(8, 1),  -- Sofía es Administradora
(9, 3);  -- Mario es Autor


