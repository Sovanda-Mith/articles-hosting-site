## How to start up the project

### Prerequisites

- Docker and Docker Compose installed on your system
- Git for cloning the repository

### Quick Start

1. Clone the repository
2. Copy environment file (if not already present):
   ```bash
   cp .env.example .env
   ```

3. Start all services with Docker Compose:
   ```bash
   sudo docker compose up --build -d
   ```
   for Production:
   ```bash
   sudo NODE_ENV=production docker compose up --build -d
   ```
   
   > **Note**: The Docker build process automatically handles:
   > - Installing PHP dependencies (`composer install`)
   > - Setting proper file permissions for `storage/` and `bootstrap/cache/`
   > - Laravel optimization commands (in production mode)

4. Run database migrations:
   ```bash
   sudo docker compose exec app php artisan migrate
   ```

5. (Optional) Generate application key if not set in .env:
   ```bash
   sudo docker compose exec app php artisan key:generate
   ```

6. Access the application:
   - **Main Application (Laravel + Nginx)**: [http://localhost:8000](http://localhost:8000)
   - **Frontend Assets (Node.js)**: [http://localhost:3000](http://localhost:3000)
   - **MinIO Console**: [http://localhost:9001](http://localhost:9001)
   - **Database**: Available on port 3309

### What's Automatically Handled by Docker

Your Dockerfile is well-configured and automatically handles:

**Development Stage:**
- PHP dependencies installation (`composer install --optimize-autoloader`)
- Proper file ownership and permissions for Laravel directories
- PHP-FPM setup

**Production Stage (when `DOCKER_TARGET=production`):**
- Optimized composer install without dev dependencies
- Laravel optimization commands:
  - `php artisan key:generate`
  - `php artisan config:cache`
  - `php artisan route:cache`
  - `php artisan view:cache`
- Proper file permissions and ownership

### Services Overview

This project runs multiple Docker containers:

- **app**: Laravel PHP-FPM application (PHP 8.2)
- **nginx**: Nginx web server serving the Laravel app on port 8000
- **node**: Node.js service serving built frontend assets on port 3000
- **db**: MySQL 8.0 database on port 3309
- **minio**: MinIO object storage with console on port 9001

### Environment Configuration

The Docker setup supports both development and production environments:

- **Development**: Set `DOCKER_TARGET=development` in your `.env` file
- **Production**: Set `DOCKER_TARGET=production` in your `.env` file

Key environment variables to configure in `.env`:

```env
# App Environment
APP_ENV=local
APP_DEBUG=true
DOCKER_TARGET=development

# Database
DB_DATABASE=ArticlesHostingSite
DB_USERNAME=laravel
DB_PASSWORD=laravel
DB_ROOT_PASSWORD=root

# MinIO Storage
MINIO_ACCESS_KEY=minioadmin
MINIO_SECRET_KEY=minioadmin
```

## Container Management

### Accessing Containers

To run commands inside specific containers:

**Laravel App Container:**
```bash
sudo docker compose exec app bash
```

**Node.js Container:**
```bash
sudo docker compose exec node sh
```

**Database Container:**
```bash
sudo docker compose exec db mysql -u root -p
```

### Common Laravel Commands

Once inside the app container, you can run:

```bash
# Database operations
php artisan migrate
php artisan migrate:fresh --seed
php artisan db:seed

# Cache operations
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Queue operations
php artisan queue:work
```

### Development Workflow

**For backend (Laravel) development:**
1. Make changes to PHP files
2. Changes are automatically reflected (volume mounted)
3. Run Laravel commands in the `app` container as needed

**For frontend development:**
1. Build assets locally or modify in the `node` container
2. The `node` service serves pre-built assets from the `public/` directory
3. For live development, you may want to run Vite dev server separately

### Stopping and Restarting Services

```bash
# Stop all services
sudo docker compose down

# Stop and remove volumes (database data will be lost)
sudo docker compose down -v

# Restart specific service
sudo docker compose restart app

# View logs
sudo docker compose logs app
sudo docker compose logs -f nginx  # follow logs
```

### Troubleshooting

**Permission Issues (if encountered):**
```bash
# These commands are usually not needed as Docker handles permissions automatically
sudo docker compose exec app chown -R www-data:www-data storage/ bootstrap/cache/
sudo docker compose exec app chmod -R 775 storage/ bootstrap/cache/
```

**If you need to reinstall dependencies:**
```bash
# Only needed if you modify composer.json or need to troubleshoot
sudo docker compose exec app composer install
```

**Database Connection Issues:**
- Ensure database credentials in `.env` match those in `docker-compose.yml`
- Check if database container is running: `docker compose ps db`

**Frontend Assets Not Loading:**
- Verify the `node` container is running: `docker compose ps node`
- Check if assets exist in `public/build/` directory
- Rebuild frontend: `sudo docker compose exec node npm run build`

## Code Standards

This project uses ESLint and Prettier to ensure consistent code formatting and style across the team.

### Setup

1. Install the recommended VS Code extensions:

   - ESLint
   - Prettier - Code formatter

2. The project is already configured with:
   - `.eslintrc.cjs` - ESLint configuration
   - `.prettierrc` - Prettier configuration
   - `.eslintignore` and `.prettierignore` - Files to exclude from linting/formatting

### Line Break Rules

To maintain code consistency, we enforce the following rules for line breaks:

- Maximum 1 consecutive empty line allowed in code
- No trailing whitespace
- Always have a newline at the end of files
- No padding within blocks
- Required line breaks:
  - Before return statements
  - After variable declarations
  - After directives
  - After case/default statements in switch blocks

### Commands

- `npm run lint` - Run ESLint to check for code quality issues (with automatic fixing when possible)
- `npm run format` - Format all files with Prettier

### VS Code Integration

The project includes VS Code settings (`/.vscode/settings.json`) that enable:

- Format on save
- ESLint auto-fix on save
- Proper formatter configurations for different file types

These settings ensure that your code is automatically formatted and linted whenever you save a file.
