@extends('layouts.app')

@section('title', 'Task Board')

@section('content')
@php
    $boardColumns = [
        ['title' => 'Pending', 'tasks' => $pendingTasks],
        ['title' => 'In Progress', 'tasks' => $inProgressTasks],
        ['title' => 'Completed', 'tasks' => $completedTasks],
    ];
@endphp
<div class="container">
    <div class="topbar">
        <h1>Task Board</h1>
        <a href="{{ route('tasks.create') }}" class="btn">+ New Task</a>
    </div>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="board-toolbar">
        @include('tasks.partials.search-field', ['id' => 'board-search', 'placeholder' => 'Search board...'])
    </div>

    <div class="board">
        @foreach ($boardColumns as $column)
            <div class="board-column">
                <div class="board-column-header">
                    <span class="board-column-title">{{ $column['title'] }}</span>
                    <span class="board-count">{{ $column['tasks']->count() }}</span>
                </div>
                <div class="board-cards" data-board-column>
                    @forelse ($column['tasks'] as $task)
                        @include('tasks.partials.board-card', ['task' => $task])
                    @empty
                        <p class="widget-empty">No tasks here.</p>
                    @endforelse
                </div>
                <p class="widget-empty" data-board-no-match hidden>No matching tasks.</p>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
    const boardSearch = document.querySelector('#board-search');
    const boardColumns = document.querySelectorAll('[data-board-column]');

    const boardUrlParams = new URLSearchParams(window.location.search);
    if (boardUrlParams.get('q') && boardSearch) {
        boardSearch.value = boardUrlParams.get('q');
    }

    function applyBoardSearch() {
        const query = boardSearch?.value.toLowerCase().trim() ?? '';

        boardColumns.forEach((column) => {
            const cards = column.querySelectorAll('[data-board-card]');
            let visibleCount = 0;

            cards.forEach((card) => {
                const visible = query === '' || card.dataset.boardSearch.includes(query);
                card.hidden = !visible;
                if (visible) visibleCount++;
            });

            const noMatch = column.parentElement.querySelector('[data-board-no-match]');
            if (noMatch) {
                noMatch.hidden = cards.length === 0 || visibleCount > 0;
            }
        });
    }

    // Same reasoning as the All Tasks page: reflect the search in the URL so a
    // status change's full-page reload lands back on the same filtered board.
    function syncBoardUrl() {
        const url = new URL(window.location.href);
        const query = boardSearch?.value.trim() ?? '';
        if (query === '') {
            url.searchParams.delete('q');
        } else {
            url.searchParams.set('q', query);
        }
        history.replaceState(null, '', url);
    }

    boardSearch?.addEventListener('input', () => {
        applyBoardSearch();
        syncBoardUrl();
    });

    applyBoardSearch();
</script>
@endsection
