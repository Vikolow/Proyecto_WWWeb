CREATE TABLE IF NOT EXISITS Usuarios (
id_usuario INT PRIMARY KEY  ,
nombre VARCHAR(50)
apellidos VARCHAR(50)
email VARCHAR(80)
password VARCHAR(50)
id_rol INT DEFAULT 1
fecha_nacimiento 
fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
biografia NULL 
FOREIGN KEY (id_rol) REFERENCES roles(id_rol)



)

CREATE TABLE IF NOT EXISITS ROLES (
id_rol INT PRIMARY KEY AUTO_INCREMENT 
nombre rol VARCHAR(50) NOT NULL
)


CREATE TABLE IF NOT EXISITS Articulos(
id_autor INT PRIMARY KEY AUTO_INCREMENT
titulo VARCHAR(50)
contenido TEXT(?)
fecha TIMESTAMP 
FOREIGN KEY (id_categoria) REFERENCES categorias(id_cat)
id_cat INT 
)


CREATE TABLE IF NOT EXISITS Categorias(
id_cat INT PRIMARY KEY
nombre_cat varchar(100) not null
)

CREATE TABLE IF NOT EXISITS Etiquetas(
id etiqueta INT PRIMARY KEY,
nombre etiqueta varchar(100) not null 
)

CREATE TABLE IF NOT EXISITS articulo-etiqueta(
id articulo
id etiqueta  
FOREIGN KEY (id_articulo) REFERENCES Articulos(id_articulo)

)


CREATE TABLE IF NOT EXISITS Comentarios (
id_comentario INT PRIMARY KEy
id_articulo INT #foranea que relaciona con articulo
id_usuario INT  #foranea que relaciona con usuario
Comentario BLOB NOT NULL,
fecha comentario TIMESTAMP
