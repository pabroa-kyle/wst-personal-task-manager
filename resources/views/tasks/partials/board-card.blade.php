@php
    $isDone = $task->status === 'Completed';
    $isOverdue = ! $isDone && $task->due_date && $task->due_date->lt(today());
    $isDueToday = ! $isDone && $task->due_date && $task->due_date->isToday();
@endphp
<div class="board-card" data-board-card data-board-search="{{ strtolower($task->task_name . ' ' . ($task->description ?? '')) }}">
    <div class="board-card-title-row">
        @include('tasks.partials.priority-icon', ['task' => $task])
        <span class="board-card-title {{ $isDone ? 'is-done' : '' }}">{{ $task->task_name }}</span>
    </div>
    @if ($task->description)
        <span class="board-card-desc">{{ Str::limit($task->description, 60) }}</span>
    @endif
    <div class="board-card-footer">
        @if ($task->due_date)
            <span class="due-chip {{ $isOverdue ? 'is-overdue' : ($isDueToday ? 'is-today' : '') }}">
                {{ $task->due_date->format('M d, Y') }}
            </span>
        @else
            <span class="due-chip">No deadline</span>
        @endif
        <div class="board-card-actions">
            <a href="{{ route('tasks.edit', $task) }}" class="icon-btn" title="Edit" aria-label="Edit {{ $task->task_name }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
            </a>
            @include('tasks.partials.status-select', ['task' => $task])
        </div>
    </div>
</div>
