# Products management

> An excercise for eshop solution company.

## Features

-products management
-categories seeding
-smtp notification (mailgun needs to be configured)
-events & listeners
-service classes

## Installation

- `composer install`

- Edit `.env` and set your database connection details
- (When installed via git clone or download, run `php artisan key:generate` and `php artisan jwt:secret`)
- `php artisan config:cache`
- `php artisan migrate:refresh --seed`
- `npm install`

## Usage

### Development

```bash
# start Laravel
php artisan serve

# start Nuxt
npm run dev
```

Access your application at `http://localhost:3000`.

### Production

```bash
npm run build
```
