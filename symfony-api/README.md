# Symfony API

This is a minimal example of an API using a lightweight Symfony 6 setup. It exposes basic endpoints for managing a cart and performing a checkout.

## Endpoints

- `GET /cart` – Retrieve the cart contents
- `POST /cart/add` – Add an item to the cart. JSON body: `{ "product": "id", "qty": 2 }`
- `POST /checkout` – Perform checkout and return the created order

## Running

1. Install dependencies (requires internet access): `composer install`
2. Start the built-in PHP server:
   ```bash
   php -S localhost:8080 -t public
   ```
3. Test the API using `curl` or your preferred HTTP client.

This repository includes only the minimal files necessary to illustrate a Symfony-like API without relying on a full framework installation.
