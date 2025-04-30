# Sistema de Gestión de Películas y Personajes

Este es un sistema web desarrollado en Laravel que permite gestionar películas, series y sus personajes.

## Características

- Autenticación de usuarios
- CRUD completo de películas y series
- Gestión de personajes
- Filtrado de películas por categorías
- Almacenamiento de imágenes
- Diseño responsivo con Bootstrap

## Requisitos

- PHP >= 8.1
- Composer
- MySQL o SQLite
- Node.js y NPM (para compilar assets)

## Instalación

1. Clonar el repositorio:
```bash
git clone [URL_DEL_REPOSITORIO]
```

2. Instalar dependencias:
```bash
composer install
npm install
```

3. Configurar el archivo .env:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurar la base de datos en .env:
```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

5. Crear la base de datos SQLite:
```bash
touch database/database.sqlite
```

6. Ejecutar migraciones:
```bash
php artisan migrate
```

7. Compilar assets:
```bash
npm run dev
```

8. Iniciar el servidor:
```bash
php artisan serve
```

## Estructura de la Base de Datos

### Tabla: movies
- id (PK)
- name
- classification
- release_date
- review
- season (nullable)
- image_path (nullable)
- user_id (FK)
- created_at
- updated_at

### Tabla: characters
- id (PK)
- name
- description
- image_path (nullable)
- movie_id (FK)
- created_at
- updated_at

## Uso

1. Acceder a la aplicación en `http://localhost:8000`
2. Iniciar sesión con las credenciales proporcionadas
3. Navegar por el menú para gestionar películas y personajes

## Contribución

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.
