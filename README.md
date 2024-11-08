## cortex-app

Cortex is a basic world-building app for managing story and quest concepts for video games. Build connections between characters, factions, locations, and make the story feel both richer and realer.

This app is built using a starter template which includes:
- Laravel 11
- Svelte
- Inertia.js
- Vite
- Tailwind CSS
- sqlite

### Installation

Run following commands:

```
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Migrate database:

```
php artisan migrate --seed
```

To try this app, run these commands on seperate terminal:

```
npm run dev
php artisan serve
```

### Deployment

Build the app:

```
npm run buid
```

Sign in with email `admin@example.com` and password `password`.

### Docker

Installation using Docker:

```
docker build -t laravel-svelte-starter .
docker run -p 80:8000 -d laravel-svelte-starter
```
Open `http://localhost/` on your browser.
