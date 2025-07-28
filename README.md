# Siroko Cart and Checkout Example

This repository provides three small projects:

1. `cart-api`: a domain-driven example API for managing the shopping cart and checkout.
2. `symfony-api`: a lightweight Symfony 6 style API that exposes basic cart endpoints.
3. `next-app`: a simple Next.js frontend that interacts with the API.

All projects are intentionally minimal to avoid external dependencies in this environment.

## Running the PHP APIs with Docker

Both APIs target PHP 8, so the easiest way to run them is via Docker.

### Cart API

```bash
cd cart-api
docker-compose up
```

### Symfony API

```bash
cd symfony-api
docker-compose up
```

If you prefer to run the Symfony example locally, install its dependencies first *(requires internet)*:

```bash
composer install
php -S localhost:8080 -t public
```

## Running the Frontend

1. From the `next-app` folder, install dependencies *(requires internet)*: `npm install`.
2. Start the development server:
   ```bash
   npm run dev
   ```

Navigate to `http://localhost:3000` to use the frontend.
