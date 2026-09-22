@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')
<div class="container">
    <div class="topbar">
        <h1>All Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="btn">+ New Task</a>
    </div>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <section class="stat-strip" aria-label="Task summary">
        <div class="stat-strip-item">
            <span class="stat-strip-value">{{ $pendingCount }}</span>
            <span class="stat-strip-label">Pending</span>
        </div>
        <div class="stat-strip-item">
            <span class="stat-strip-value">{{ $inProgressCount }}</span>
            <span class="stat-strip-label">In Progress</span>
        </div>
        <div class="stat-strip-item {{ $overdueCount > 0 ? 'is-alert' : '' }}">
            <span class="stat-strip-value">{{ $overdueCount }}</span>
            <span class="stat-strip-label">Overdue</span>
        </div>
        <div class="stat-strip-item">
            <span class="stat-strip-value">{{ $completedCount }}</span>
            <span class="stat-strip-label">Completed</span>
        </div>
    </section>

    <div class="card">
        <div class="list-heading">
            <h2>All Tasks</h2>
            <div class="list-heading-controls">
                <select id="sort-select" class="sort-select" aria-label="Sort tasks">
                    <option value="due_date" {{ $sort === 'due_date' ? 'selected' : '' }}>Sort: Due Date</option>
                    <option value="task_name" {{ $sort === 'task_name' ? 'selected' : '' }}>Sort: Name (A&ndash;Z)</option>
                    <option value="status" {{ $sort === 'status' ? 'selected' : '' }}>Sort: Status</option>
                    <option value="priority" {{ $sort === 'priority' ? 'selected' : '' }}>Sort: Priority</option>
                </select>
                @include('tasks.partials.search-field', ['id' => 'task-search', 'placeholder' => 'Search tasks...'])
            </div>
        </div>

        <div class="filter-bar" role="group" aria-label="Filter tasks by status">
            <button type="button" class="filter-pill is-active" data-filter="all">All</button>
            <button type="button" class="filter-pill" data-filter="pending">Pending</button>
            <button type="button" class="filter-pill" data-filter="in-progress">In Progress</button>
            <button type="button" class="filter-pill" data-filter="completed">Completed</button>
            <button type="button" class="filter-pill" data-filter="overdue">Overdue</button>
        </div>

        @if ($tasks->isEmpty())
            <div class="empty-state">
                <svg class="empty-state-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                <p>No tasks yet.</p>
                <a href="{{ route('tasks.create') }}" class="btn">+ New Task</a>
            </div>
        @else
            <ul class="task-list">
                @foreach ($tasks as $task)
                    @php
                        $isDone = $task->status === 'Completed';
                        $statusSlug = str($task->status)->slug();
                        $isOverdue = ! $isDone && $task->due_date && $task->due_date->lt(today());
                        $isDueToday = ! $isDone && $task->due_date && $task->due_date->isToday();
                    @endphp
                    <li
                        class="task-row"
                        data-task-row
                        data-task-search="{{ strtolower($task->task_name . ' ' . ($task->description ?? '') . ' ' . $task->status) }}"
                        data-task-status="{{ $statusSlug }}"
                        data-task-overdue="{{ $isOverdue ? '1' : '0' }}"
                    >
                        <div class="task-row-main">
                            @include('tasks.partials.priority-icon', ['task' => $task])
                            <span class="task-name {{ $isDone ? 'is-done' : '' }}">{{ $task->task_name }}</span>
                            @if ($task->description)
                                <span class="task-desc">{{ Str::limit($task->description, 70) }}</span>
                            @endif
                        </div>
                        <div class="task-row-meta">
                            @include('tasks.partials.status-select', ['task' => $task])

                            <span class="task-due">
                                @if ($task->due_date)
                                    <span class="due-chip {{ $isOverdue ? 'is-overdue' : ($isDueToday ? 'is-today' : '') }}">
                                        @if ($isOverdue) Overdue &middot; @elseif ($isDueToday) Today &middot; @endif
                                        {{ $task->due_date->format('M d, Y') }}
                                    </span>
                                @else
                                    <span class="due-chip">No deadline</span>
                                @endif
                            </span>

                            <div class="row-actions">
                                <a href="{{ route('tasks.edit', $task) }}" class="icon-btn" title="Edit" aria-label="Edit {{ $task->task_name }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn icon-btn-danger" title="Delete" aria-label="Delete {{ $task->task_name }}">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <p id="no-results" class="empty-state muted" hidden>No tasks match this filter.</p>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    const taskSearch = document.querySelector('#task-search');
    const taskRows = document.querySelectorAll('[data-task-row]');
    const filterPills = document.querySelectorAll('.filter-pill');
    const noResults = document.querySelector('#no-results');
    const sortSelect = document.querySelector('#sort-select');

    const validFilters = ['all', 'pending', 'in-progress', 'completed', 'overdue'];
    const urlParams = new URLSearchParams(window.location.search);

    let activeFilter = validFilters.includes(urlParams.get('status')) ? urlParams.get('status') : 'all';

    if (urlParams.get('q') && taskSearch) {
        taskSearch.value = urlParams.get('q');
    }

    filterPills.forEach((pill) => {
        pill.classList.toggle('is-active', pill.dataset.filter === activeFilter);
    });

    function matchesFilter(row) {
        if (activeFilter === 'all') return true;
        if (activeFilter === 'overdue') return row.dataset.taskOverdue === '1';
        return row.dataset.taskStatus === activeFilter;
    }

    function applyFilters() {
        const query = taskSearch?.value.toLowerCase().trim() ?? '';
        let visibleCount = 0;

        taskRows.forEach((row) => {
            const matchesSearch = query === '' || row.dataset.taskSearch.includes(query);
            const visible = matchesSearch && matchesFilter(row);
            row.hidden = !visible;
            if (visible) visibleCount++;
        });

        if (noResults) {
            noResults.hidden = taskRows.length === 0 || visibleCount > 0;
        }
    }

    // Reflects the active filter/search in the URL (no reload) so a full page
    // reload -- e.g. redirect()->back() after a status change -- lands back on
    // the same filtered view instead of resetting to "All" with no search.
    function syncUrl() {
        const url = new URL(window.location.href);

        if (activeFilter === 'all') {
            url.searchParams.delete('status');
        } else {
            url.searchParams.set('status', activeFilter);
        }

        const query = taskSearch?.value.trim() ?? '';
        if (query === '') {
            url.searchParams.delete('q');
        } else {
            url.searchParams.set('q', query);
        }

        history.replaceState(null, '', url);
    }

    taskSearch?.addEventListener('input', () => {
        applyFilters();
        syncUrl();
    });

    filterPills.forEach((pill) => {
        pill.addEventListener('click', () => {
            activeFilter = pill.dataset.filter;
            filterPills.forEach((p) => p.classList.toggle('is-active', p === pill));
            applyFilters();
            syncUrl();
        });
    });

    sortSelect?.addEventListener('change', () => {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', sortSelect.value);
        window.location.href = url.toString();
    });

    applyFilters();
</script>
@endsection
