# Symfony API

This is a minimal example of an API using a lightweight Symfony 6 setup. It exposes basic endpoints for managing a cart and performing a checkout.

## Endpoints

- `GET /cart` – Retrieve the cart contents
- `POST /cart/add` – Add an item to the cart. JSON body: `{ "product": "id", "qty": 2 }`
- `POST /checkout` – Perform checkout and return the created order

## Running

The project targets PHP 8, so it is easiest to run it via Docker.

1. Build and start the container with docker compose:
   ```bash
   docker-compose up
   ```
   The API will be available on `http://localhost:8080`.
2. If you prefer to run it locally, first install the dependencies *(requires internet access)*:
   ```bash
   composer install
   ```
   Then start the built-in PHP server:
   ```bash
   php -S localhost:8080 -t public
   ```
3. Test the API using `curl` or your preferred HTTP client.

This repository includes only the minimal files necessary to illustrate a Symfony-like API without relying on a full framework installation.
