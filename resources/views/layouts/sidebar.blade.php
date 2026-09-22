<aside class="sidebar">
    <div class="sidebar-brand">
        <span class="brand-mark" aria-hidden="true">&check;</span>
        <span class="brand-name">TaskFlow</span>
    </div>

    <nav class="sidebar-nav" aria-label="Primary">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
            Dashboard
        </a>
        <a href="{{ route('tasks.index') }}" class="nav-link {{ request()->routeIs('tasks.index') ? 'is-active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            All Tasks
        </a>
        <a href="{{ route('tasks.board') }}" class="nav-link {{ request()->routeIs('tasks.board') ? 'is-active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
            Task Board
        </a>
    </nav>

    <a href="{{ route('tasks.create') }}" class="btn sidebar-new-task">+ New Task</a>
</aside>
