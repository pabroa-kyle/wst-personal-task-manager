@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="container-narrow">
    <div class="page-header">
        <a href="{{ route('tasks.index') }}" class="back-link">&larr; Back to Tasks</a>
        <h1>Edit Task</h1>
    </div>

    <div class="card">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="task_name">Task Name</label>
                <input id="task_name" name="task_name" type="text" value="{{ old('task_name', $task->task_name) }}" required>
                @error('task_name')
                    <div class="field-error">{{ $message }}</div>
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
                    <option value="In Progress" {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div>
                <label for="priority">Priority</label>
                <select id="priority" name="priority">
                    <option value="Low" {{ old('priority', $task->priority) == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ old('priority', $task->priority) == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ old('priority', $task->priority) == 'High' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div>
                <label for="due_date">Due Date</label>
                <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $task->due_date) }}">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
