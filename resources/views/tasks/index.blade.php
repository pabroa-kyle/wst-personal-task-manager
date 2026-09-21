<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>
    @include('tasks.partials.styles')
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <span class="kicker">WEEKLY WORKSPACE</span>
                <h1>Personal Task Manager</h1>
            </div>
            <a href="{{ route('tasks.create') }}" class="btn">+ Add Task</a>
        </div>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <section class="stats" aria-label="Task summary">
            <div class="stat-card stat-card-primary">
                <span class="stat-label">Open tasks</span>
                <strong>{{ $pendingCount }}</strong>
                <span class="stat-note">Keep the momentum going</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Completed</span>
                <strong>{{ $completedCount }}</strong>
                <span class="stat-note">Wins logged this week</span>
            </div>
            <div class="stat-card stat-card-alert">
                <span class="stat-label">Needs attention</span>
                <strong>{{ $overdueCount }}</strong>
                <span class="stat-note">Past due and still open</span>
            </div>
        </section>

        <div class="grid">
            <div class="card">
                <h2>Add New Task</h2>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="task_name">Task Name</label>
                        <input id="task_name" name="task_name" type="text" value="{{ old('task_name') }}" required>
                        @error('task_name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div>
                        <label for="due_date">Due Date</label>
                        <input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}">
                    </div>

                    <button type="submit" class="btn">Save Task</button>
                </form>
            </div>

            <div class="card">
                <div class="list-heading">
                    <div>
                        <span class="section-kicker">Your queue</span>
                        <h2>Task List</h2>
                    </div>
                    <input id="task-search" class="search-input" type="search" placeholder="Search tasks..." aria-label="Search tasks">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr data-task-row data-task-search="{{ strtolower($task->task_name . ' ' . ($task->description ?? '') . ' ' . $task->status) }}">
                                <td data-label="Task">
                                    <strong>{{ $task->task_name }}</strong><br>
                                    <span class="muted">{{ Str::limit($task->description ?? 'No description', 60) }}</span>
                                </td>
                                <td data-label="Status">
                                    <span class="badge {{ $task->status === 'Completed' ? 'completed' : 'pending' }}">
                                        {{ $task->status }}
                                    </span>
                                </td>
                                <td data-label="Due date">{{ $task->due_date ? $task->due_date->format('M d, Y') : 'No deadline' }}</td>
                                <td data-label="Actions">
                                    <div class="actions">
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('tasks.toggle-status', $task) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn">{{ $task->status === 'Pending' ? 'Mark Done' : 'Mark Pending' }}</button>
                                        </form>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this task?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-state muted">No tasks yet. Add your first task to get started.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const taskSearch = document.querySelector('#task-search');
        const taskRows = document.querySelectorAll('[data-task-row]');

        taskSearch?.addEventListener('input', (event) => {
            const query = event.target.value.toLowerCase().trim();

            taskRows.forEach((row) => {
                row.hidden = query !== '' && !row.dataset.taskSearch.includes(query);
            });
        });
    </script>
</body>
</html>
