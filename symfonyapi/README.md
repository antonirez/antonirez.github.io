# Siroko Cart API

API de ejemplo para la gestión de un carrito de compra y checkout utilizando Symfony 6.

## Descripción

Este proyecto implementa una API sencilla que permite añadir, actualizar y eliminar productos del carrito, obtener el carrito y procesar el checkout generando una orden persistente. El dominio está desacoplado del framework siguiendo principios de DDD y se proporciona un almacén de datos basado en ficheros.

## Modelo de dominio

- **Product**: identificador, nombre y precio.
- **CartItem**: producto y cantidad.
- **Cart**: colección de items y cálculo del total.
- **Order**: carrito confirmado.

## Especificación OpenAPI

El archivo [`openapi.yaml`](openapi.yaml) describe los endpoints principales:

- `GET /api/cart`
- `GET /api/products`
- `POST /api/products`
- `POST /api/cart/items`
- `PUT /api/cart/items/{id}`
- `DELETE /api/cart/items/{id}`
- `POST /api/cart/checkout`

## Tecnología

- PHP 8
- Symfony 6
- Docker y Docker Compose

## Puesta en marcha

```bash
docker-compose up -d
```

La aplicación estará disponible en `http://localhost:8080`.

## Despliegue y funcionamiento

1. Clona este repositorio y accede al directorio `symfonyapi`.
2. Crea un fichero `.env.local` si necesitas personalizar variables de entorno.
3. Levanta los contenedores (la primera vez usa `--build` para crear la imagen):

```bash
docker-compose up --build -d
```

Esto instalará las dependencias con Composer y expondrá la API en el puerto `8080`.

Puedes entrar en el contenedor para ejecutar comandos de Symfony:

```bash
docker-compose exec app php bin/console about
```

Los datos del carrito y las órdenes se almacenan en el directorio `var/` dentro del contenedor.

## Ejecutar tests

```bash
./vendor/bin/phpunit
```
