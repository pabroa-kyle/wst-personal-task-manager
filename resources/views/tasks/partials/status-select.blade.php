@php
    $statusSlug = str($task->status)->slug();
@endphp
<form action="{{ route('tasks.update-status', $task) }}" method="POST" class="status-select-form">
    @csrf
    @method('PATCH')
    <div class="status-select-wrap" data-status="{{ $statusSlug }}">
        <select name="status" class="status-select" onchange="this.form.submit()" aria-label="Status for {{ $task->task_name }}">
            <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="In Progress" {{ $task->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
        </select>
        <svg class="status-select-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
    </div>
</form>
