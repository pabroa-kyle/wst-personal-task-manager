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

- **Add Task**
- **View Tasks**
- **Edit Task**
- **Delete Task**
- **Update Status**

## Additional Features

- **Dashboard** (`/dashboard`, the default landing page) — open/in-progress/overdue/completed counts, an Overdue + Due Soon panel, and a Recently Completed log.
<img width="1911" height="974" alt="{477F9906-6058-4CB9-9DF6-71215C95B538}" src="https://github.com/user-attachments/assets/ef968cce-93e5-4943-b8f0-e8848aeea2c9" />
- **All Tasks** (`/tasks`) — the full task list with live search (`/` to focus it), filter tabs (All / Pending / In Progress / Completed / Overdue), and sorting by due date, name, status, or priority. The active filter, search term, and sort all persist in the URL, so they survive a status change or a page reload.
<img width="1913" height="975" alt="{3F7FD5A8-629C-47E9-8874-92A7780027DA}" src="https://github.com/user-attachments/assets/90d69f4d-6aa0-4a2d-8cf1-947d03cc26db" />
- **Task Board** (`/tasks/board`) — a three-column Kanban view (Pending / In Progress / Completed) with its own search.
<img width="1911" height="951" alt="{11F8BC23-5DF4-45F9-8712-D856567A82C4}" src="https://github.com/user-attachments/assets/9f28a7bd-86ab-428a-b80c-6d2ef5e1faea" />
- **Status**: `Pending`, `In Progress`, or `Completed`, changed inline via a colored dropdown badge on both the list and the board — no separate edit step required.
<img width="379" height="282" alt="{F4E8A3A6-0213-4081-B687-A38CF570F314}" src="https://github.com/user-attachments/assets/fe5715c7-f4fa-4874-8495-a7107227e4f0" />
- **Priority**: `Low`, `Medium`, or `High`, shown as a signal-bars icon next to each task name and sortable; set from the Create/Edit form.
<img width="1896" height="988" alt="{3415BC58-1D1F-4C4B-8501-DEA0E7951876}" src="https://github.com/user-attachments/assets/604c95e2-9921-4990-ba3c-fe7e793084ce" />
- **Due dates** are called out automatically: an "Overdue" or "Due today" chip appears wherever a task's date is shown.
<img width="1919" height="948" alt="{2E5FF2C7-6004-4290-9C1B-677BAFD0FC5D}" src="https://github.com/user-attachments/assets/e58b09a0-89e2-433a-a65d-08e69a6e9fe2" />
- Responsive layout: a persistent left sidebar on desktop, a fixed bottom tab bar on mobile.
<img width="1908" height="1017" alt="{7FBCDB1F-F107-47DA-8239-0B1C8BD4C5E3}" src="https://github.com/user-attachments/assets/dae01821-3e30-4bce-a9c1-c079160700e0" />

## How it works, step by step
1. A request comes in
Every request goes through public/index.php, which starts the app from bootstrap/app.php. Laravel then matches the URL against the routes.

2. Routes: routes/web.php
URL	Controller method	What it does
GET /	—	Redirects to /dashboard
GET /dashboard	dashboard	Summary page
GET /tasks/board	board	Board with three columns
GET /tasks	index	List of all tasks
GET /tasks/create, POST /tasks	create, store	Add a task
GET /tasks/{task}/edit, PUT /tasks/{task}	edit, update	Edit a task
DELETE /tasks/{task}	destroy	Delete a task
PATCH /tasks/{task}/status	updateStatus	Change only the status (the inline dropdown)
Route::resource(...)->except('show') creates the standard add/edit/delete routes and leaves out the single-task view page.

3. Data: Task.php and the migrations
The tasks table has id, task_name, description, status, priority, due_date and timestamps. The migrations show how the table grew over time:

create_tasks_table: status could only be Pending or Completed.
add_task_fields: a safety step that adds any of those columns if they're missing.
add_in_progress_status: changes status into a plain string column so In Progress can be stored. It copies the data into a new column, drops the old one and renames the new one.
add_priority: adds priority, with Medium as the default.
The model sets due_date to be read as a date, so views can call methods like $task->due_date->lt(today()).

4. Logic: TaskController.php
The allowed values are defined in one place: STATUSES (Pending / In Progress / Completed) and PRIORITIES (Low / Medium / High).

dashboard() runs database queries to count tasks per status and count overdue tasks. An overdue task is one that isn't Completed and has a due date before today. It also gets 5 overdue tasks, 5 upcoming tasks and 5 recently completed tasks.
index() loads every task in the order chosen by ?sort= (due_date by default, or task_name, status, priority). Priority sorting uses a SQL CASE so the order is High, Medium, Low. The counts here are worked out in PHP from the tasks already loaded, not with extra queries.
board() runs three queries, one for each status column, each sorted by due date.
store() / update() check the input: the name is required, status and priority must be one of the allowed values, and the due date is optional. They then save the task and redirect to the list with a success message that is shown once.
updateStatus() checks and saves only the status, then goes back to the page you came from.
destroy() deletes the task and goes back to the page you came from.

5. Views: resources/views/
Layout: layouts/app.blade.php sets up the page frame: the sidebar, the main content area, a bottom navigation bar for mobile, and a slot for page scripts. All CSS is in one partial, styles.blade.php. There's no build step for it, so Vite isn't really used.
Pages: dashboard, index, board, create and edit each build on that layout.
Reusable pieces in tasks/partials/:
status-select: a dropdown styled as a badge, inside a small PATCH form, so you can change a task's status straight from the list or board.
priority-icon: signal bars that show the priority.
board-card: one task card on the board.
search-field: a search box. Pressing / jumps to it, and it has a clear button.

6. What happens in the browser
Search and filtering all happen on the page, without contacting the server:

All Tasks page (index.blade.php): each row stores its searchable text, its status and whether it's overdue. When you type in the search box or click a filter button (All, Pending, In Progress, Completed, Overdue), rows are shown or hidden. The current filter and search are also written into the URL, so after a status change reloads the page, you're back on the same view.
Board page (board.blade.php): search works the same way. Each column shows "No matching tasks." when nothing matches.

7. A typical round trip
When you change a status on the board:

The dropdown's form sends PATCH /tasks/5/status.
updateStatus checks the value and saves it.
You're sent back to the board with a success message.
The page reloads and the search in the URL is applied again.

8. Tests
TaskCrudTest.php has a single test, which creates a task and checks that it appears. Run it with php artisan test.

Things worth knowing
No login, on purpose. PRODUCT.md says this is a single-user local tool.
The same validation rules are written twice, in store and update. A Form Request class could hold them in one place.
The status column now accepts any text after migration 3. Only the controller's checks stop bad values.
Sorting by status is alphabetical (Completed, In Progress, Pending), not the order the work actually moves in.
The Postman collection won't work against these routes as they are. They're web routes protected against cross-site form submissions (CSRF), so API-style requests will be rejected with a 419 error unless they include a valid token.
Tests only cover creating and viewing a task. Editing, deleting, changing status and the validation rules aren't tested.


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
