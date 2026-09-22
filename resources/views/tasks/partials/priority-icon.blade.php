@php
    $prioritySlug = strtolower($task->priority);
@endphp
<span class="priority-icon priority-{{ $prioritySlug }}" title="{{ $task->priority }} priority" aria-label="{{ $task->priority }} priority">
    <span class="priority-bar"></span>
    <span class="priority-bar"></span>
    <span class="priority-bar"></span>
</span>
