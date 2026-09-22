# Full-Stack SaaS Boilerplate

A modern, containerized full-stack application built with **Laravel 12** (PHP 8.4) and **Nuxt 3** (Vue 3, Tailwind CSS, Pinia), served via **Nginx** and containerized with **Docker Compose**.

---

## 🏗 Architecture & Stack Overview

- **Frontend:** [Nuxt 3](https://nuxt.com/) (SPA Mode, Pinia, Tailwind CSS, TypeScript)
- **Backend API:** [Laravel 12](https://laravel.com/) (PHP 8.4-FPM)
- **Web Server:** [Nginx](https://nginx.org/) (FastCGI Proxy to PHP-FPM)
- **Database:** [MySQL 8.0](https://www.mysql.com/)
- **Cache & Queue:** [Redis](https://redis.io/)
- **Containerization:** Docker & Docker Compose

---

## 📁 Directory Structure

```text
.
├── backend/                # Laravel 12 application root
│   ├── app/
│   ├── config/
│   ├── routes/
│   ├── .env
│   └── composer.json
│
├── frontend/               # Nuxt 3 application root
│   ├── components/
│   ├── pages/
│   ├── stores/
│   ├── nuxt.config.ts
│   └── package.json
│
├── docker/                 # Container service configurations
│   ├── nginx/
│   │   └── default.conf   # Nginx server block configuration
│   └── php/
│       └── Dockerfile     # PHP 8.4-FPM image setup
│
├── docker-compose.yml      # Root multi-container orchestration definition
└── README.md
```

## ⚡ Quick Start & Environment Setup

### Prerequisites
- Docker Desktop for macOS/Linux/Windows
- Git

### 1. Clone the Repository

```bash
git clone https://github.com/2026ramcap/myramcap_booking.git
cd myramcap_booking
```

### 2. Environment Configuration
Copy the example environment configuration for the Laravel backend:

```bash
cp backend/.env.example backend/.env
```

Ensure the database settings inside backend/.env match your Docker environment:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=saas_db
DB_USERNAME=saas_user
DB_PASSWORD=secret

REDIS_HOST=redis
REDIS_PORT=6379
```

### 3. Launch Docker Stack
Build and start all containers in detached mode:

```bash
docker compose up -d --build
```

### 4. Initialize Database & Generate Application Keys

```bash
# composer install
docker compose exec laravel.test composer install

# Generate Laravel Application Key
docker compose exec laravel.test php artisan key:generate

# Run Database Migrations and Seeders
docker compose exec laravel.test php artisan migrate --seed

# Generate Nuxt Auto-import Definitions
docker compose exec frontend npx nuxi prepare
```


## 🌐 Environment Endpoints

Once running, access your application services via your browser:

Application / Service| Endpoint   |  Description
---------------------|------------|-------------
Frontend Application | http://localhost:3000 | Nuxt 3 Single Page Application
Backend API (Nginx) | http://localhost:8000 | Laravel 12 API Root
API Health Check | http://localhost:8000/api | Laravel Health / Route Status

## 💻 Common Development Workflows
### Running Backend Commands (Artisan/Composer)

```bash
# Create a controller
docker compose exec laravel.test php artisan make:controller Api/UserController

# Create a migration
docker compose exec laravel.test php artisan make:migration create_teams_table

# Install new PHP package
docker compose exec laravel.test composer require laravel/sanctum
```

### Running Frontend Commands (NPM)

```bash
# Install new Node module inside frontend container
docker run --rm -v "$PWD/frontend":/app -w /app node:20-alpine npm install @vueuse/core

# Regenerate TypeScript definitions
docker compose exec frontend npx nuxi prepare
```

### Inspecting Container Logs

```bash
# Tail all container logs
docker compose logs -f

# Tail specific container logs (e.g. Nginx or PHP)
docker compose logs -f webserver
docker compose logs -f laravel.test
```

### 🔒 CORS & Security Setup

The Nuxt frontend communicates with the Laravel API cross-origin (http://localhost:3000 -> http://localhost:8000).

Verify backend/config/cors.php allows requests from origin http://localhost:3000:

```PHP
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_methods' => ['*'],
'allowed_origins' => ['http://localhost:3000'],
'supports_credentials' => true,
```

```
<ElicitationsGroup message="Setup complete! Where would you like to go next?">

<Elicitation label="Configure Sanctum authentication flow" query="How do I set up SPA authentication using Laravel Sanctum cookies with Nuxt 3 and Pinia?"/>

<Elicitation label="Add Laravel Queue & Scheduler containers" query="How do I update docker-compose.yml to run queue workers and scheduled tasks in separate background containers?"/>

</ElicitationsGroup>
```