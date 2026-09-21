# Laravel Mini Project: Personal Task Manager

Project Code: WST21-PM-2026-SF
Student Name: BRIAN KYLE E. PABROA
Course & Year: BSIT-2 SEC10
Database Used: SQLite

## Project Overview

A Laravel-based personal task manager built using the required flow:

```text
Routes -> Controller -> Model -> Database -> Blade Views
```

SQLite was selected because it is lightweight and does not require a separate database server. Laravel supports it directly through PHP's SQLite extensions.

## Features

- Add Task
- View Tasks
- Edit Task
- Delete Task
- Update Status between Pending and Completed
- Set a task description and due date

## Database Schema

The `tasks` table contains:

| Field | Purpose |
| --- | --- |
| `id` | Task ID |
| `task_name` | Name of the task |
| `description` | Task details |
| `status` | `Pending` or `Completed` |
| `due_date` | Task deadline |
| `created_at` | Creation timestamp |
| `updated_at` | Last update timestamp |

## Laravel Structure

- Routes: `routes/web.php`
- Controller: `app/Http/Controllers/TaskController.php`
- Model: `app/Models/Task.php`
- Migrations: `database/migrations/`
- Blade views: `resources/views/tasks/`
- Feature test: `tests/Feature/TaskCrudTest.php`

## Setup Instructions

Requirements: PHP 8.2+, Composer, and the PHP SQLite extensions.

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

If the SQLite file does not exist, create it before migrating:

```powershell
New-Item database/database.sqlite -ItemType File
php artisan migrate
```

Open the application at `http://127.0.0.1:8000` or the port shown by Artisan.

## Testing

```powershell
php artisan test
```

## Repository

Public GitHub Repository URL: [Add your public GitHub repository URL here]
