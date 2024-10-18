CREATE TABLE IF NOT EXISTS Roles (
    id_rol INT PRIMARY KEY AUTO_INCREMENT,
    nombre_rol VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS Usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50),
    email VARCHAR(80) NOT NULL,
    password VARCHAR(50) NOT NULL,
    id_rol INT DEFAULT 1,
    fecha_nacimiento DATE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    biografia TEXT,
    FOREIGN KEY (id_rol) REFERENCES Roles(id_rol)
);

CREATE TABLE IF NOT EXISTS Categorias (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nombre_categoria VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS Articulos (
    id_articulo INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(50) NOT NULL,
    contenido TEXT NOT NULL,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_categoria INT,
    id_usuario INT,
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id_categoria),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

CREATE TABLE IF NOT EXISTS Etiquetas (
    id_etiqueta INT PRIMARY KEY AUTO_INCREMENT,
    nombre_etiqueta VARCHAR(100) 
);

-- Tabla intermedia para Artículos y Etiquetas
CREATE TABLE IF NOT EXISTS Articulo_Etiqueta (
    id_articulo INT,
    id_etiqueta INT,
    PRIMARY KEY (id_articulo, id_etiqueta),
    FOREIGN KEY (id_articulo) REFERENCES Articulos(id_articulo),
    FOREIGN KEY (id_etiqueta) REFERENCES Etiquetas(id_etiqueta)
);

CREATE TABLE IF NOT EXISTS Comentarios (
    id_comentario INT PRIMARY KEY AUTO_INCREMENT,
    id_articulo INT,
    id_usuario INT,
    comentario TEXT NOT NULL,
    fecha_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_articulo) REFERENCES Articulos(id_articulo),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);
-- Tabla intermedia para la relacion de articulos-categorias
CREATE TABLE IF NOT EXISTS roles-usuarios (
    id_usuario INT,
    id_rol INT,
    PRIMARY KEY (id_usuario, id_rol),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_rol) REFERENCES Roles(id_rol)
);

-- Tabla intermedia para la relación favoritos,articulos y usuarios
CREATE TABLE IF NOT EXISTS Favoritos (
    id_usuario INT,
    id_articulo INT,
    PRIMARY KEY (id_usuario, id_articulo),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_articulo) REFERENCES Articulos(id_articulo)

