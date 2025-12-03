# TaskFlow API

A Laravel REST API demonstrating job queues, Sanctum authentication, and task processing.

## Tech Stack

- Laravel 12
- Laravel Sanctum (Token Auth)
- MySQL
- Job Queues (Database Driver)

## Features

- User registration & login with token auth
- Task CRUD operations
- Background job processing with progress tracking
- Retry logic and failure handling

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/register` | Create account |
| POST | `/api/login` | Login, get token |
| POST | `/api/logout` | Logout |
| GET | `/api/user` | Get current user |
| GET | `/api/tasks` | List tasks |
| POST | `/api/tasks` | Create task |
| GET | `/api/tasks/{id}` | Get task |
| PUT | `/api/tasks/{id}` | Update task |
| DELETE | `/api/tasks/{id}` | Delete task |

## Setup
```bash
# Install dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate

# Set database credentials in .env

# Run migrations
php artisan migrate

# Start server
php artisan serve

# Start queue worker (separate terminal)
php artisan queue:work
```

## Related

- [TaskFlow Frontend](https://github.com/LucianoNicacio/taskflow-frontend) - Vue.js SPA
