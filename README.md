# Generador de Números Aleatorios

Aplicación PHP orientada a objetos que genera N números aleatorios y los muestra en una tabla con estadísticas.

## Requisitos

- Docker
- docker-compose
- Puerto 8082 disponible

## Instalación

1. Colocar esta carpeta en `./html/noo/` del proyecto que contiene `docker-compose.yml`.

2. Asegurarse de tener el servicio configurado en `docker-compose.yml`:

```yaml
services:
  web:
    image: php:7.4-apache
    ports:
      - "8082:80"
    volumes:
      - ./html:/var/www/html
    restart: always
```

3. Ejecutar el contenedor:

```bash
docker-compose up -d
```

4. Acceder a la aplicación:

```
http://localhost:8082/noo/
```

## Uso

1. Ingresar la cantidad de números a generar (n) entre 1 y 1000.
2. (Opcional) Definir valores mínimo y máximo.
3. Click en "Generar".
4. Se mostrará una tabla con los números generados y estadísticas (suma, promedio, mínimo, máximo).

## Características

- Programación orientada a objetos
- Validación de entrada en el servidor
- Patrón PRG (Post/Redirect/Get) para evitar reenvío accidental
- Escape de salida HTML para prevenir XSS
- Compatible con PHP 7.4
- Sin Composer: todas las clases se cargan con `require_once`

## Estructura de archivos

```
noo/
├── index.php              # Punto de entrada
├── src/
│   ├── App.php            # Orquestación
│   ├── Request.php        # Validación de entrada
│   ├── RandomGenerator.php # Generación de números
│   └── Renderer.php       # Renderizado de vistas
├── views/
│   ├── form.php           # Plantilla del formulario
│   └── results.php       # Plantilla de resultados
└── README.md              # Este archivo
```
