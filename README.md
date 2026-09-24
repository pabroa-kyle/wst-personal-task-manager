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

What started as a basic CRUD list has grown into a small multi-surface app: a Dashboard, a searchable/sortable task list, and a Kanban-style Task Board, all sharing one persistent navigation shell.

SQLite was selected because it is lightweight and does not require a separate database server. Laravel supports it directly through PHP's SQLite extensions.

## Features

- **Dashboard** (`/dashboard`, the default landing page) — open/in-progress/overdue/completed counts, an Overdue + Due Soon panel, and a Recently Completed log.
- **All Tasks** (`/tasks`) — the full task list with live search (`/` to focus it), filter tabs (All / Pending / In Progress / Completed / Overdue), and sorting by due date, name, status, or priority. The active filter, search term, and sort all persist in the URL, so they survive a status change or a page reload.
- **Task Board** (`/tasks/board`) — a three-column Kanban view (Pending / In Progress / Completed) with its own search.
- **Status**: `Pending`, `In Progress`, or `Completed`, changed inline via a colored dropdown badge on both the list and the board — no separate edit step required.
- **Priority**: `Low`, `Medium`, or `High`, shown as a signal-bars icon next to each task name and sortable; set from the Create/Edit form.
- Add, edit, and delete tasks, with a description and an optional due date.
- Due dates are called out automatically: an "Overdue" or "Due today" chip appears wherever a task's date is shown.
- Responsive layout: a persistent left sidebar on desktop, a fixed bottom tab bar on mobile.

## Database Schema

The `tasks` table contains:

| Field | Purpose |
| --- | --- |
| `id` | Task ID |
| `task_name` | Name of the task |
| `description` | Task details |
| `status` | `Pending`, `In Progress`, or `Completed` |
| `priority` | `Low`, `Medium`, or `High` (defaults to `Medium`) |
| `due_date` | Task deadline |
| `created_at` | Creation timestamp |
| `updated_at` | Last update timestamp |

## Laravel Structure

- Routes: `routes/web.php` — `/dashboard`, the `tasks` resource (minus `show`), plus `PATCH tasks/{task}/status` for the inline status dropdown.
- Controller: `app/Http/Controllers/TaskController.php` — `index`, `dashboard`, `board`, `create`, `store`, `edit`, `update`, `destroy`, `updateStatus`.
- Model: `app/Models/Task.php`
- Migrations: `database/migrations/`
- Layout shell: `resources/views/layouts/` (`app`, `sidebar`, `bottom-nav`)
- Blade views: `resources/views/tasks/` (`dashboard`, `index`, `board`, `create`, `edit`)
- Shared partials: `resources/views/tasks/partials/` (`status-select`, `priority-icon`, `search-field`, `board-card`, `styles`)
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

Public GitHub Repository URL: https://github.com/pabroa-kyle/wst-personal-task-manager or https://github.com/pabroa-kyle/wst-personal-task-manager.git
