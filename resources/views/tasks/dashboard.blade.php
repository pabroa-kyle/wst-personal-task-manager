@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="topbar">
        <div>
            <h1>Dashboard</h1>
            <p class="subtitle">Here's what's happening with your tasks.</p>
        </div>
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

    <div class="dashboard-layout">
        <div class="panel">
            <div class="panel-section">
                <span class="panel-section-label is-alert">Overdue</span>
                @forelse ($overdueTasks as $task)
                    <div class="widget-item">
                        <a href="{{ route('tasks.edit', $task) }}" class="widget-item-name">{{ $task->task_name }}</a>
                        <span class="due-chip is-overdue">{{ $task->due_date->format('M d, Y') }}</span>
                    </div>
                @empty
                    <p class="widget-empty">Nothing overdue. Nice work.</p>
                @endforelse
            </div>

            <div class="panel-section">
                <span class="panel-section-label">Due Soon</span>
                @forelse ($upcomingTasks as $task)
                    <div class="widget-item">
                        <a href="{{ route('tasks.edit', $task) }}" class="widget-item-name">{{ $task->task_name }}</a>
                        <span class="due-chip {{ $task->due_date->isToday() ? 'is-today' : '' }}">
                            {{ $task->due_date->isToday() ? 'Today' : $task->due_date->format('M d, Y') }}
                        </span>
                    </div>
                @empty
                    <p class="widget-empty">No upcoming deadlines.</p>
                @endforelse
            </div>
        </div>

        <div class="completed-log">
            <h2>Recently Completed</h2>
            @forelse ($recentlyCompleted as $task)
                <div class="widget-item">
                    <span class="widget-item-name is-done">{{ $task->task_name }}</span>
                </div>
            @empty
                <p class="widget-empty">Nothing completed yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
