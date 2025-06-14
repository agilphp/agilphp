# Proyecto Hexagonal en PHP 8.2

Este proyecto implementa una arquitectura hexagonal utilizando PHP 8.2 y Composer.

## Requisitos

- PHP 8.2 o superior.
- Composer.

## Instalación

1. Clona este repositorio.
2. Ejecuta `composer install` para instalar las dependencias.

## Ejecución de Pruebas

Ejecuta las pruebas con el siguiente comando:

```bash
vendor\bin\phpunit
```

# AgilPHP 3.0

AgilPHP 3.0 es un microservicio desarrollado en PHP 8.2 con arquitectura hexagonal. Este proyecto utiliza MariaDB como base de datos y está preparado para ejecutarse en un entorno Docker.

## Requisitos

- Docker
- Docker Compose

## Instalación y Ejecución

1. Clona este repositorio:
   ```bash
   git clone https://github.com/tu-usuario/agilphp3.0.git
   cd agilphp3.0
   ```

2. Construye y ejecuta los contenedores:
   ```bash
   docker-compose build
   docker-compose up
   ```

3. Accede a la aplicación en tu navegador:
   ```
   http://localhost:8080
   ```

## Endpoints

### Registro de Usuario
- **URL**: `/register`
- **Método**: `POST`
- **Headers**:
  - `Content-Type: application/json`
- **Body**:
  ```json
  {
    "username": "testuser",
    "password": "password123"
  }
  ```

### Inicio de Sesión
- **URL**: `/login`
- **Método**: `POST`
- **Headers**:
  - `Content-Type: application/json`
- **Body**:
  ```json
  {
    "username": "testuser",
    "password": "password123"
  }
  ```

### Obtener Datos del Usuario
- **URL**: `/user`
- **Método**: `GET`
- **Headers**:
  - `Authorization: Bearer <TOKEN>`

## Base de Datos

La base de datos MariaDB se configura automáticamente con las siguientes credenciales:
- **Usuario**: `user`
- **Contraseña**: `password`
- **Base de datos**: `agilphphex`

## Estructura del Proyecto

- `src/`: Código fuente principal.
  - `Application/`: Casos de uso y controladores.
  - `Domain/`: Entidades, interfaces y lógica de negocio.
  - `Infrastructure/`: Adaptadores de infraestructura y acceso a datos.
- `public/`: Punto de entrada para las solicitudes HTTP.
- `config/`: Archivos de configuración.

# AgilPHP 3.0 Microframework

AgilPHP 3.0 es un microframework ligero construido con PHP 8.2. Proporciona una estructura simple para construir aplicaciones modulares y extensibles.

## Características
- Contenedor de Inyección de Dependencias
- Sistema de Ruteo Flexible
- Arquitectura Modular

## Empezando

### Instalación
1. Clona el repositorio:
   ```bash
   git clone https://github.com/tu-usuario/agilphp3.0.git
   cd agilphp3.0
   ```

2. Instala las dependencias usando Composer:
   ```bash
   composer install
   ```

3. Inicia el servidor de desarrollo:
   ```bash
   php -S localhost:8080 -t public
   ```

4. Accede a la aplicación en tu navegador:
   ```
   http://localhost:8080
   ```

## Uso

### Ruteo
Define rutas en el archivo `public/index.php` usando la clase `Router`:

```php
$router->add('GET', '/ejemplo', function () {
    echo json_encode(['mensaje' => '¡Hola, Mundo!']);
});
```

### Inyección de Dependencias
Registra y resuelve servicios usando la clase `Container`:

#### Registrar un Servicio
```php
$container->set('NombreDelServicio', function () {
    return new ClaseDelServicio();
});
```

#### Resolver un Servicio
```php
$servicio = $container->get('NombreDelServicio');
```

### Ejemplo
Aquí hay un ejemplo de cómo registrar un controlador y usarlo en una ruta:

```php
$container->set('ControladorEjemplo', function () {
    return new App\Controllers\ControladorEjemplo();
});

$router->add('GET', '/ejemplo', function () use ($container) {
    $controlador = $container->get('ControladorEjemplo');
    $controlador->manejar();
});
```

## Contribuciones
¡Las contribuciones son bienvenidas! Por favor, abre un issue o envía un pull request.

## Licencia

Este proyecto está licenciado bajo la [MIT License](LICENSE).
