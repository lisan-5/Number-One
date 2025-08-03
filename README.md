# Number One Brand E-Commerce Application

An open-source Laravel 12.x e-commerce storefront for shoes and accessories, styled with Tailwind CSS and powered by Vite and Alpine.js. It features product listing, sorting, filtering, a dedicated product detail carousel, cart & wishlist functionality, user authentication & profiles, order checkout, and an admin dashboard with real-time cache flushing.

---

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Migrations & Seeding](#database-migrations--seeding)
- [Running Locally](#running-locally)
- [Testing](#testing)
- [Building for Production](#building-for-production)
- [Deployment](#deployment)
- [Environment Variables](#environment-variables)
- [File Structure](#file-structure)
- [Contributing](#contributing)
- [License](#license)

---

## Features

- Browse, search, sort and filter products by tags and price
- Hero banners & feature cards on the home page
- Dedicated product detail page with image carousel and zoom effects
- Shopping cart & wishlist with live counts in the navbar
- User registration, login, profile management, and order history
- Guest and authenticated checkout workflows
- Admin dashboard for managing shoes, users, and orders
- Automatic cache invalidation after admin CRUD operations
- Responsive design (mobile & desktop) using Tailwind CSS
- Interactivity with Alpine.js

## Tech Stack

- PHP 8.2 & Laravel 12.x
- Tailwind CSS & Vite
- Alpine.js for frontend interactions
- Blade components for layouts & navigation
- MySQL (or any supported relational database)
- PHPUnit for automated testing

## Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm (or yarn)
- MySQL, PostgreSQL, or SQLite

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/lisan-5/2C-Computer.git
    cd 2C-Computer
    ```
2. Install PHP dependencies:
    ```bash
    composer install
    ```
3. Install JavaScript dependencies:
    ```bash
    npm install
    ```
4. Copy the example environment file and set your own values:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

## Configuration

- Open `.env` and configure your database connection, mail settings, and any third-party API keys.
- Ensure `VITE_DEV_SERVER_URL` (if used) points to your Vite dev server.

## Database Migrations & Seeding

Run migrations and seeders to create tables and sample data:

```bash
php artisan migrate --seed
```

## Running Locally

- Start the Laravel dev server:
  ```bash
  php artisan serve
  ```
- Start Vite in development mode (with hot reload):
  ```bash
  npm run dev
  ```
- Visit `http://localhost:8000` in your browser.

## Testing

Run automated tests with PHPUnit:

```bash
php artisan test
```

Or with PHPUnit directly:

```bash
vendor/bin/phpunit
```

## Building for Production

Compile and optimize assets for production:

```bash
npm run build
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Deployment

1. Push code to your GitHub repository.
2. On the server:
   ```bash
   git clone ...
   composer install --no-dev --optimize-autoloader
   npm ci && npm run build
   php artisan migrate --force --seed
   php artisan optimize
   ```
3. Ensure `storage/`, `bootstrap/cache/`, and `vendor/` are writable.

## Environment Variables

Your `.env` file should contain:

```env
APP_NAME=Number One Brand
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null

# Vite dev server (optional)
VITE_DEV_SERVER_URL=http://localhost:5173
```

## File Structure

```text
app/            # Models, Controllers & Business Logic
bootstrap/      # Framework bootstrapping files
config/         # Application configuration files
database/       # Migrations, factories, and seeders
public/         # Entry point & compiled assets
resources/      # Blade views, CSS, JS, images
routes/         # Web & API route definitions
storage/        # Logs, cache, and file uploads
tests/          # Unit & Feature tests
vite.config.js  # Vite build configuration
```

## Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/YourFeature`
3. Commit your changes: `git commit -m 'Add new feature'`
4. Push to your branch: `git push origin feature/YourFeature`
5. Open a Pull Request describing your changes

Please follow PSR-12 for PHP code style and use meaningful commit messages.

## License

This project is open-sourced under the MIT License. See the [LICENSE](LICENSE) file for details.
