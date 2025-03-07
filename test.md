# 📌 Proyecto Ascent - Despliegue con Docker

Este proyecto es una aplicación PHP con MySQL y Nginx, configurada para ejecutarse en un entorno Dockerizado. Incluye un sistema de autenticación, gestión de cursos y una interfaz web personalizada.

---

## 📂 **Estructura del Proyecto**
```
📁 Proyecto_PHP_Nelson_Azan/
 ├── 📂 apartados paginas/    # Imágenes de la página web
 ├── 📄 conexion.php         # Conexión a la base de datos
 ├── 📄 contacto.php         # Página de contacto
 ├── 📂 css/                 # Archivos CSS para el diseño
 ├── 📄 cursos.php           # Página de cursos
 ├── 🐳 docker-compose.yaml  # Configuración de Docker y servicios
 ├── 📄 Dockerfile           # Dockerfile para construir el contenedor PHP
 ├── 📂 img/                 # Imágenes utilizadas en el proyecto
 ├── 📄 inicio.php           # Página de inicio
 ├── 📄 initdb               # Script de inicialización de la base de datos
 ├── 📂 js/                  # Archivos JS para la funcionalidad
 ├── 📄 Login.php            # Página de login
 ├── 📂 nginx/               # Configuración de Nginx
 ├── 📄 quienes-somos.php    # Página 'Quienes somos'
 ├── 📄 recuperar.php        # Página para recuperar contraseñas
 ├── 📄 recursos.php         # Página con recursos adicionales
 ├── 📄 registro.php         # Página de registro de usuarios
 ├── 📄 salida.php           # Página para cerrar sesión
 ├── 📄 suscripciones.php    # Página de suscripciones
 ├── 📂 video/               # Archivos de video
```

---

## 🚀 **Requisitos Previos**
Antes de iniciar el proyecto, asegúrate de tener instalados:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

---

## 🔧 **Instalación y Uso**

### **1️⃣ Clonar el Repositorio**
```bash
git clone https://github.com/receptaculodedios/ascent.git
cd ascent
```

### **2️⃣ Configurar la Base de Datos**
El sistema usa MySQL, y los datos de acceso están predefinidos en `docker-compose.yaml`:
```yaml
MYSQL_ROOT_PASSWORD: example
MYSQL_DATABASE: ascent_db
MYSQL_USER: user
MYSQL_PASSWORD: password
```
Si necesitas cambiar las credenciales, edítalas en `docker-compose.yaml`.

---

### **3️⃣ Construir y Levantar los Contenedores**
Ejecuta el siguiente comando para descargar las imágenes y construir los servicios:
```bash
docker-compose up -d --build
```
Esto iniciará:
- **MySQL** en `localhost:3306`
- **PHP-FPM** conectado con MySQL
- **NGINX** sirviendo la aplicación en `http://localhost`

Para ver los contenedores en ejecución:
```bash
docker ps
```

---

## 🛠 **Administración de Contenedores**
Si necesitas detener los servicios:
```bash
docker-compose down
```

Si quieres limpiar los volúmenes y eliminar la caché:
```bash
docker-compose down -v
```

Para reconstruir la aplicación:
```bash
docker-compose up -d --build
```

---

## 📌 **Notas Adicionales**
- Si `mysql` no inicia correctamente, revisa los logs:
  ```bash
  docker logs mysql-db
  ```
- Para acceder a MySQL dentro del contenedor:
  ```bash
  docker exec -it mysql-db mysql -uuser -ppassword
  ```
- Si necesitas depurar la aplicación, revisa los logs de PHP:
  ```bash
  docker logs php-app
  ```

---

## 📜 **Licencia**
Este proyecto está bajo la licencia **MIT**. Puedes modificarlo y distribuirlo libremente.

---

## 🙌 **Contribución**
Si deseas contribuir, envía un **pull request** o abre un **issue** en GitHub.

