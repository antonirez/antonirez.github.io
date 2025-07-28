# Siroko Cart API

API minimal para gestionar el carrito y procesar el pago en la tienda Siroko. El dominio est\u00E1 desacoplado de la capa HTTP.

## Tecnolog\u00EDa

- PHP 8.2 (sin dependencias externas por limitaciones del entorno)
- Arquitectura inspirada en DDD y Hexagonal
- CQRS aplicado con comandos y consultas simples

## Modelado del Dominio

- **Product**: identificador, nombre y precio.
- **Cart**: agregado con l\u00EDnea de productos.
- **Order**: se genera al confirmar la compra.
- Repositorios abstra\u00EDdos mediante interfaces y almacenados en ficheros.

## OpenAPI

La especificaci\u00F3n se encuentra en `docs/openapi.yaml`.

## Puesta en marcha

1. Requiere Docker.
2. Ejecutar:

```bash
docker-compose up
```

3. La API quedar\u00E1 disponible en `http://localhost:8080`.

### Endpoints principales

- `GET /cart` Obtener el carrito.
- `POST /cart/items` A\u00F1adir producto al carrito.
- `PUT /cart/items/{productId}` Actualizar cantidad.
- `DELETE /cart/items/{productId}` Eliminar producto.
- `POST /checkout` Procesar pago y generar orden.

## Tests

Se incluyen pruebas de ejemplo en `tests/`. Para ejecutarlas:

```bash
php tests/CartTest.php
```

Debido a las restricciones de este entorno, no se han podido a\u00F1adir m\u00F3dulos externos ni ejecutar phpunit.
