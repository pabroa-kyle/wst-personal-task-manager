<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 30px;
            color: #1f2937;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
            padding: 25px;
        }
        h1 { margin-top: 0; }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        form input, form textarea, form select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            box-sizing: border-box;
            margin-bottom: 15px;
            font-size: 1rem;
        }
        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            background: #2563eb;
            color: white;
        }
        .btn-secondary {
            background: #6b7280;
            margin-left: 8px;
        }
        .muted {
            color: #6b7280;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Edit Task</h1>

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="task_name">Task Name</label>
                <input id="task_name" name="task_name" type="text" value="{{ old('task_name', $task->task_name) }}" required>
                @error('task_name')
                    <div class="muted">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4">{{ old('description', $task->description) }}</textarea>
            </div>

            <div>
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div>
                <label for="due_date">Due Date</label>
                <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $task->due_date) }}">
            </div>

            <button type="submit" class="btn">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>
