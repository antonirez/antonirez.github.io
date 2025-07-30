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

## Ejecutar tests

```bash
./vendor/bin/phpunit
```
