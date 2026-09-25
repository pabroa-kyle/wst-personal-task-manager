<style>
    :root {
        --bg: #f5f6f8;
        --surface: #ffffff;
        --border: #e5e7eb;
        --border-strong: #d1d5db;
        --text: #1a1d23;
        --muted: #6b7280;
        --primary: #4f46e5;
        --primary-hover: #4338ca;
        --primary-tint: #eef2ff;
        --success: #16a34a;
        --success-bg: #dcfce7;
        --warning: #b45309;
        --warning-bg: #fef3c7;
        --danger: #dc2626;
        --danger-bg: #fee2e2;
        --radius: 8px;
        --shadow: 0 1px 2px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(15, 23, 42, 0.08);
    }

    * { box-sizing: border-box; }

    body {
        background: var(--bg);
        color: var(--text);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        margin: 0;
        min-height: 100vh;
    }

    ::selection { background: var(--primary); color: #fff; }
    :focus-visible { outline: 2px solid var(--primary); outline-offset: 2px; }
    a { text-underline-offset: 2px; }
    * { scrollbar-color: var(--border-strong) var(--bg); scrollbar-width: thin; }
    ::-webkit-scrollbar { height: 10px; width: 10px; }
    ::-webkit-scrollbar-track { background: var(--bg); }
    ::-webkit-scrollbar-thumb { background: var(--border-strong); border-radius: 999px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--muted); }

    /* Signature motion: content rises in once, staggered top to bottom, on every page load. */
    @keyframes rise-in {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .container > *, .container-narrow > * {
        animation: rise-in 420ms cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .container > *:nth-child(2), .container-narrow > *:nth-child(2) { animation-delay: 40ms; }
    .container > *:nth-child(3), .container-narrow > *:nth-child(3) { animation-delay: 80ms; }
    .container > *:nth-child(4), .container-narrow > *:nth-child(4) { animation-delay: 120ms; }
    @media (prefers-reduced-motion: reduce) {
        .container > *, .container-narrow > * { animation: none; }
    }

    .container { margin: 0 auto; max-width: 960px; padding: 32px 24px 64px; }
    .container-narrow { margin: 0 auto; max-width: 540px; padding: 32px 24px 64px; }

    .app-shell { display: flex; min-height: 100vh; }
    .main-content { flex: 1; min-width: 0; }

    .sidebar {
        background: var(--surface);
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
        gap: 22px;
        height: 100vh;
        overflow-y: auto;
        padding: 20px 14px;
        position: sticky;
        top: 0;
        width: 220px;
    }
    .sidebar-brand { align-items: center; display: flex; gap: 10px; padding: 0 6px; }
    .brand-name { font-size: 1.05rem; font-weight: 700; }
    .sidebar-nav { display: flex; flex-direction: column; gap: 2px; }
    .nav-link {
        align-items: center;
        border-radius: 6px;
        color: var(--muted);
        display: flex;
        font-size: 0.88rem;
        font-weight: 600;
        gap: 10px;
        padding: 9px 10px;
        text-decoration: none;
        transition: background 120ms ease, color 120ms ease;
    }
    .nav-link svg { flex-shrink: 0; height: 18px; width: 18px; }
    .nav-link:hover { background: var(--bg); color: var(--text); }
    .nav-link.is-active { background: var(--primary-tint); color: var(--primary); }

    .bottom-nav { display: none; }

    .sr-only {
        clip: rect(0 0 0 0);
        clip-path: inset(50%);
        height: 1px;
        overflow: hidden;
        position: absolute;
        white-space: nowrap;
        width: 1px;
    }

    h1 { font-size: 1.6rem; font-weight: 700; letter-spacing: -0.02em; margin: 0; }

    .topbar { align-items: center; display: flex; gap: 16px; justify-content: space-between; margin-bottom: 24px; }
    .brand { align-items: center; display: flex; gap: 12px; }
    .brand-mark {
        align-items: center;
        background: var(--primary);
        border-radius: 8px;
        color: #fff;
        display: flex;
        flex-shrink: 0;
        font-size: 1.1rem;
        font-weight: 700;
        height: 36px;
        justify-content: center;
        width: 36px;
    }
    .subtitle { color: var(--muted); font-size: 0.85rem; margin: 2px 0 0; }

    .page-header { margin-bottom: 20px; }
    .back-link {
        align-items: center;
        color: var(--muted);
        display: inline-flex;
        font-size: 0.85rem;
        font-weight: 600;
        gap: 4px;
        margin-bottom: 14px;
        text-decoration: none;
    }
    .back-link:hover { color: var(--text); }

    .card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 20px;
    }

    .card h2 { font-size: 1.05rem; font-weight: 700; margin: 0; }

    /* Stat strip: one unified ledger row, not a grid of same-size accent cards. */
    .stat-strip {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        display: flex;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .stat-strip-item { border-right: 1px solid var(--border); flex: 1 1 0; padding: 14px 20px; }
    .stat-strip-item:last-child { border-right: 0; }
    .stat-strip-value {
        display: block;
        font-size: 1.5rem;
        font-variant-numeric: tabular-nums;
        font-weight: 700;
        letter-spacing: -0.01em;
        line-height: 1.15;
    }
    .stat-strip-label { color: var(--muted); font-size: 0.72rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; }
    .stat-strip-item.is-alert .stat-strip-value { color: var(--danger); }

    .list-heading { align-items: center; display: flex; gap: 16px; justify-content: space-between; margin-bottom: 16px; }
    .list-heading-controls { align-items: center; display: flex; gap: 10px; }

    /* Self-contained: these inputs live outside any <form>, so they never inherit the
       generic `form input` rule below and are styled fully on their own terms here. */
    .search-field { max-width: 240px; position: relative; width: 100%; }
    .search-field > svg {
        color: var(--muted);
        height: 15px;
        left: 12px;
        pointer-events: none;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
    }
    .search-input {
        appearance: none;
        -webkit-appearance: none;
        background: var(--bg);
        border: 1px solid transparent;
        border-radius: 999px;
        box-sizing: border-box;
        color: var(--text);
        font-family: inherit;
        font-size: 0.88rem;
        outline: none;
        padding: 8px 34px 8px 34px;
        transition: background 150ms ease, border-color 150ms ease, box-shadow 150ms ease;
        width: 100%;
    }
    .search-input::placeholder { color: var(--muted); }
    .search-input:hover { background: var(--border); }
    .search-input:focus { background: #fff; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15); }
    .search-input::-webkit-search-cancel-button,
    .search-input::-webkit-search-decoration { -webkit-appearance: none; appearance: none; display: none; }
    .search-kbd {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 4px;
        color: var(--muted);
        font-family: inherit;
        font-size: 0.68rem;
        font-weight: 600;
        padding: 1px 5px;
        pointer-events: none;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }
    .search-clear {
        align-items: center;
        background: transparent;
        border: 0;
        border-radius: 50%;
        color: var(--muted);
        cursor: pointer;
        display: flex;
        height: 20px;
        justify-content: center;
        padding: 0;
        position: absolute;
        right: 7px;
        top: 50%;
        transform: translateY(-50%);
        transition: background 120ms ease, color 120ms ease;
        width: 20px;
    }
    .search-clear:hover { background: var(--border-strong); color: var(--text); }
    .search-clear svg { height: 12px; width: 12px; }
    .search-clear[hidden] { display: none; }

    .sort-select {
        background: #fff;
        border: 1px solid var(--border-strong);
        border-radius: 6px;
        color: var(--text);
        font-family: inherit;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 8px 10px;
        width: auto;
    }

    .filter-bar { border-bottom: 1px solid var(--border); display: flex; gap: 4px; margin-bottom: 6px; }
    .filter-pill {
        background: none;
        border: none;
        border-bottom: 2px solid transparent;
        color: var(--muted);
        cursor: pointer;
        font-family: inherit;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: -1px;
        margin-right: 16px;
        padding: 10px 6px;
        transition: color 120ms ease, border-color 120ms ease;
    }
    .filter-pill:hover { color: var(--text); }
    .filter-pill.is-active { border-bottom-color: var(--primary); color: var(--primary); }

    form label {
        color: var(--text);
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 6px;
    }

    form input, form textarea, form select {
        background: #fff;
        border: 1px solid var(--border-strong);
        border-radius: 6px;
        box-sizing: border-box;
        color: var(--text);
        font-family: inherit;
        font-size: 0.95rem;
        margin-bottom: 4px;
        outline: none;
        padding: 9px 12px;
        transition: border-color 120ms ease, box-shadow 120ms ease;
        width: 100%;
    }

    form textarea { max-width: 100%; min-height: 120px; resize: vertical; }

    form > div, form > fieldset { margin-bottom: 16px; }

    form input:focus, form textarea:focus, form select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    .field-error { color: var(--danger); font-size: 0.78rem; margin: -2px 0 6px; }

    .btn {
        align-items: center;
        background: var(--primary);
        border: 0;
        border-radius: 6px;
        color: #fff;
        cursor: pointer;
        display: inline-flex;
        font-family: inherit;
        font-size: 0.85rem;
        font-weight: 600;
        gap: 6px;
        padding: 9px 16px;
        text-decoration: none;
        transition: background 120ms ease;
    }
    .btn:hover { background: var(--primary-hover); }

    .btn-ghost { background: transparent; border: 1px solid var(--border-strong); color: var(--text); }
    .btn-ghost:hover { background: var(--bg); }

    .form-actions { display: flex; gap: 10px; margin-top: 6px; }

    .alert {
        background: var(--success-bg);
        border: 1px solid #bbf7d0;
        border-radius: var(--radius);
        color: #166534;
        font-size: 0.88rem;
        margin-bottom: 20px;
        padding: 11px 16px;
    }

    /* A flex row, not a table: Status, Due date, and Actions live together in one
       right-hand cluster (task-row-meta) instead of each floating in its own
       fixed-width table column with unpredictable dead space between them. */
    .task-list { list-style: none; margin: 0; padding: 0; }
    .task-row {
        align-items: center;
        border-bottom: 1px solid var(--border);
        display: flex;
        gap: 16px;
        justify-content: space-between;
        padding: 12px 8px;
        transition: background 150ms ease;
    }
    .task-row:last-child { border-bottom: 0; }
    .task-row:hover { background: var(--bg); }
    .task-row[hidden] { display: none; }
    .task-row-main { min-width: 0; }
    .task-row-meta { align-items: center; display: flex; flex-shrink: 0; gap: 14px; }
    /* Fixed slot widths so Status and Due date form real aligned columns across rows --
       otherwise "Pending" vs "In Progress" vs "Completed" (and "No deadline" vs a date
       chip) render at different widths and every row's due date lands at a different x. */
    .task-due { display: inline-block; min-width: 140px; }

    .task-name { font-size: 0.95rem; font-weight: 600; }
    .task-name.is-done { color: var(--muted); text-decoration: line-through; }
    .task-desc { color: var(--muted); display: block; font-size: 0.8rem; margin-top: 2px; }

    /* Priority as signal bars (Linear's convention), not a colored dot or border --
       one bar filled for Low, two for Medium, three for High. */
    .priority-icon { align-items: flex-end; display: inline-flex; flex-shrink: 0; gap: 2px; height: 12px; margin-right: 7px; vertical-align: middle; }
    .priority-bar { background: var(--border-strong); border-radius: 1px; width: 3px; }
    .priority-bar:nth-child(1) { height: 5px; }
    .priority-bar:nth-child(2) { height: 8px; }
    .priority-bar:nth-child(3) { height: 12px; }
    .priority-low .priority-bar:nth-child(1) { background: var(--muted); }
    .priority-medium .priority-bar:nth-child(1),
    .priority-medium .priority-bar:nth-child(2) { background: var(--warning); }
    .priority-high .priority-bar { background: var(--danger); }

    /* Status dropdown styled as a badge: a real control, not a decorative chip.
       The select fills the whole pill (so the entire pill stays clickable); the
       chevron is a real inline SVG overlaid with pointer-events:none and centered
       with true top:50% math -- no hand-guessed coordinate like the old version. */
    .status-select-form { display: inline-block; }
    .status-select-wrap {
        border-radius: 999px;
        display: inline-flex;
        margin-bottom: 0;
        min-width: 112px;
        position: relative;
        transition: filter 120ms ease, box-shadow 120ms ease;
    }
    .status-select-wrap:hover { filter: brightness(0.96); }
    .status-select-wrap:focus-within { box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.18); }
    .status-select {
        appearance: none;
        -webkit-appearance: none;
        background: transparent;
        border: 0;
        border-radius: 999px;
        color: inherit;
        cursor: pointer;
        flex: 1;
        font-family: inherit;
        font-size: 0.76rem;
        font-weight: 700;
        margin: 0px;
        padding: 5px 22px 5px 12px;
    }
    .status-select-chevron {
        color: currentColor;
        height: 12px;
        opacity: 0.6;
        pointer-events: none;
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        width: 12px;
    }
    .status-select-wrap[data-status="pending"] { background: var(--bg); border: 1px solid var(--border); color: var(--muted); }
    .status-select-wrap[data-status="in-progress"] { background: var(--primary-tint); color: var(--primary); }
    .status-select-wrap[data-status="completed"] { background: var(--success-bg); color: var(--success); }

    .due-chip {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 999px;
        color: var(--muted);
        display: inline-block;
        font-size: 0.72rem;
        font-variant-numeric: tabular-nums;
        font-weight: 600;
        padding: 3px 9px;
        white-space: nowrap;
    }
    .due-chip.is-overdue { background: var(--danger-bg); border-color: transparent; color: var(--danger); }
    .due-chip.is-today { background: var(--warning-bg); border-color: transparent; color: var(--warning); }

    .row-actions { display: flex; gap: 4px; justify-content: flex-end; }
    .icon-btn {
        align-items: center;
        background: transparent;
        border: 1px solid transparent;
        border-radius: 6px;
        color: var(--muted);
        cursor: pointer;
        display: inline-flex;
        height: 30px;
        justify-content: center;
        padding: 0;
        width: 30px;
    }
    .icon-btn:hover { background: var(--bg); color: var(--text); }
    .icon-btn.icon-btn-danger:hover { background: var(--danger-bg); color: var(--danger); }
    .icon-btn svg { height: 16px; width: 16px; }

    .muted { color: var(--muted); font-size: 0.85rem; }

    .empty-state { padding: 48px 16px; text-align: center; }
    .empty-state p { color: var(--muted); margin: 0 0 14px; }
    .empty-state-icon { color: var(--border-strong); height: 40px; margin-bottom: 10px; width: 40px; }

    /* Dashboard: one wide attention panel (overdue + due soon) beside a quiet, visually
       lighter completed log -- deliberately not a grid of matching stat cards. */
    .dashboard-layout { display: grid; gap: 20px; grid-template-columns: 1.6fr 1fr; margin-top: 4px; }
    .panel {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 20px;
    }
    .panel-section + .panel-section { border-top: 1px solid var(--border); margin-top: 14px; padding-top: 14px; }
    .panel-section-label {
        color: var(--muted);
        display: block;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }
    .panel-section-label.is-alert { color: var(--danger); }

    .completed-log {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 18px;
    }
    .completed-log h2 { color: var(--muted); font-size: 0.85rem; font-weight: 700; margin: 0 0 10px; }
    .completed-log .widget-item-name { font-size: 0.85rem; }

    .widget-item {
        align-items: center;
        border-bottom: 1px solid var(--border);
        display: flex;
        gap: 10px;
        justify-content: space-between;
        padding: 8px 2px;
    }
    .widget-item:last-child { border-bottom: 0; }
    .widget-item-name { color: var(--text); font-size: 0.88rem; font-weight: 600; text-decoration: none; }
    a.widget-item-name:hover { color: var(--primary); }
    .widget-item-name.is-done { color: var(--muted); text-decoration: line-through; }
    .widget-empty { color: var(--muted); font-size: 0.85rem; margin: 0; padding: 6px 2px; }

    .board-toolbar { display: flex; justify-content: flex-end; margin-bottom: 16px; }

    .board { display: grid; gap: 16px; grid-template-columns: repeat(3, 1fr); margin-top: 4px; }
    .board-column {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        min-height: 160px;
        padding: 14px;
    }
    .board-column-header { align-items: center; display: flex; justify-content: space-between; margin-bottom: 12px; }
    .board-column-title { color: var(--muted); font-size: 0.78rem; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase; }
    .board-count {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 999px;
        color: var(--muted);
        font-size: 0.72rem;
        font-variant-numeric: tabular-nums;
        font-weight: 700;
        padding: 1px 9px;
    }
    .board-cards { display: flex; flex-direction: column; gap: 10px; }
    .board-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        box-shadow: var(--shadow);
        padding: 12px;
        transition: box-shadow 160ms ease, transform 160ms ease;
    }
    .board-card:hover {
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.1), 0 2px 4px rgba(15, 23, 42, 0.08);
        transform: translateY(-2px);
    }
    .board-card-title-row { align-items: center; display: flex; }
    .board-card-title { font-size: 0.9rem; font-weight: 600; }
    .board-card-title.is-done { color: var(--muted); text-decoration: line-through; }
    .board-card-desc { color: var(--muted); display: block; font-size: 0.78rem; margin-top: 2px; }
    .board-card-footer { align-items: center; display: flex; gap: 8px; justify-content: space-between; margin-top: 10px; }
    .board-card-actions { align-items: center; display: flex; gap: 4px; }

    @media (max-width: 900px) {
        .dashboard-layout { grid-template-columns: 1fr; }
        .board { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 640px) {
        .board { grid-template-columns: 1fr; }
    }

    @media (max-width: 560px) {
        .stat-strip { display: grid; grid-template-columns: repeat(2, 1fr); }
        .stat-strip-item { border-bottom: 1px solid var(--border); border-right: 1px solid var(--border); }
        .stat-strip-item:nth-child(2n) { border-right: 0; }
        .stat-strip-item:nth-last-child(-n+2) { border-bottom: 0; }
    }

    @media (max-width: 700px) {
        .sidebar { display: none; }
        .bottom-nav {
            background: var(--surface);
            border-top: 1px solid var(--border);
            bottom: 0;
            display: flex;
            left: 0;
            justify-content: space-around;
            padding: 6px 4px calc(6px + env(safe-area-inset-bottom));
            position: fixed;
            right: 0;
            z-index: 20;
        }
        .bottom-nav-link {
            align-items: center;
            border-radius: 8px;
            color: var(--muted);
            display: flex;
            flex: 1;
            flex-direction: column;
            font-size: 0.66rem;
            font-weight: 600;
            gap: 2px;
            padding: 6px 4px;
            text-decoration: none;
        }
        .bottom-nav-link svg { height: 20px; width: 20px; }
        .bottom-nav-link.is-active { color: var(--primary); }
        .bottom-nav-add { color: var(--primary); }
        .container, .container-narrow { padding: 20px 16px 84px; }
        .topbar { align-items: flex-start; flex-direction: column; }
        .topbar .btn { justify-content: center; width: 100%; }
        .list-heading { align-items: stretch; flex-direction: column; }
        .list-heading-controls { flex-direction: column; }
        .search-field, .sort-select { max-width: none; width: 100%; }
        .search-kbd { display: none; }
        .form-actions { flex-direction: column; }
        .form-actions .btn { justify-content: center; width: 100%; }
        .task-row { align-items: flex-start; flex-direction: column; gap: 8px; }
        .task-row-meta { flex-wrap: wrap; }
        .row-actions { justify-content: flex-start; }
        /* Column alignment only matters when rows sit side by side; stacked on mobile,
           the fixed widths just waste space and push actions onto their own line. */
        .status-select-wrap, .task-due { min-width: 0; }
    }
</style>
