# Siroko Cart and Checkout Example

This repository provides a minimal setup with two parts:

1. `symfony-api`: a lightweight Symfony 6 style API that manages cart operations and checkout.
2. `next-app`: a simple Next.js frontend that interacts with the API.

Both implementations are intentionally minimal to avoid external dependencies in this environment.

## Running the API

1. From the `symfony-api` folder, install dependencies *(requires internet)*: `composer install`.
2. Launch the PHP server:
   ```bash
   php -S localhost:8080 -t public
   ```

## Running the Frontend

1. From the `next-app` folder, install dependencies *(requires internet)*: `npm install`.
2. Start the development server:
   ```bash
   npm run dev
   ```

Navigate to `http://localhost:3000` to use the frontend.
