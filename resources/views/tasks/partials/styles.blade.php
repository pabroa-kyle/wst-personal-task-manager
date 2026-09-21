<style>
    :root {
        --ink: #17221d;
        --muted: #6b766f;
        --paper: #f5f2ea;
        --surface: #fffdf8;
        --line: #deded3;
        --forest: #1f5b47;
        --forest-dark: #164534;
        --lime: #d8ed75;
        --coral: #ef7865;
        --shadow: 0 20px 45px rgba(23, 34, 29, 0.1);
    }

    * { box-sizing: border-box; }

    body {
        background: var(--paper);
        color: var(--ink);
        font-family: Georgia, 'Times New Roman', serif;
        min-height: 100vh;
        padding: 28px;
    }

    body::before {
        background: var(--lime);
        content: '';
        height: 170px;
        left: 0;
        opacity: 0.65;
        position: fixed;
        top: 0;
        transform: skewY(-4deg) translateY(-85px);
        width: 100%;
        z-index: -1;
    }

    .container { max-width: 1180px; }

    .header {
        align-items: end;
        border-bottom: 1px solid rgba(23, 34, 29, 0.18);
        padding: 28px 0 22px;
    }

    .header h1, h1 {
        color: var(--ink);
        font-size: clamp(2rem, 5vw, 3.5rem);
        letter-spacing: -0.04em;
        line-height: 0.95;
    }

    .header::before {
        color: var(--forest);
        content: 'WEEKLY WORKSPACE';
        display: block;
        font-family: Arial, sans-serif;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.16em;
        margin-bottom: 10px;
    }

    .card {
        background: rgba(255, 253, 248, 0.92);
        border: 1px solid rgba(23, 34, 29, 0.1);
        border-radius: 4px;
        box-shadow: var(--shadow);
        padding: 26px;
    }

    .card h2 {
        font-size: 1.35rem;
        letter-spacing: -0.02em;
        margin: 0 0 22px;
    }

    .stats {
        display: grid;
        gap: 14px;
        grid-template-columns: repeat(3, 1fr);
        margin: 22px 0;
    }

    .stat-card {
        background: rgba(255, 253, 248, 0.88);
        border: 1px solid rgba(23, 34, 29, 0.1);
        border-radius: 4px;
        display: grid;
        gap: 5px;
        min-height: 130px;
        padding: 18px;
    }

    .stat-card-primary { background: var(--forest); color: #fffdf8; }
    .stat-card-alert { border-top: 5px solid var(--coral); }
    .stat-card strong { font-size: 2.5rem; letter-spacing: -0.06em; line-height: 1; }
    .stat-label, .section-kicker {
        color: var(--forest);
        font-family: Arial, sans-serif;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }
    .stat-card-primary .stat-label { color: var(--lime); }
    .stat-note { color: var(--muted); font-family: Arial, sans-serif; font-size: 0.76rem; }
    .stat-card-primary .stat-note { color: rgba(255, 253, 248, 0.72); }

    .list-heading { align-items: end; display: flex; gap: 20px; justify-content: space-between; margin-bottom: 14px; }
    .list-heading h2 { margin-bottom: 0; margin-top: 5px; }
    .search-input { max-width: 190px; width: 100%; }

    form label {
        color: var(--forest-dark);
        font-family: Arial, sans-serif;
        font-size: 0.76rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    form input, form textarea, form select {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 2px;
        color: var(--ink);
        font-family: Arial, sans-serif;
        outline: none;
        transition: border-color 160ms ease, box-shadow 160ms ease;
    }

    form input:focus, form textarea:focus, form select:focus {
        border-color: var(--forest);
        box-shadow: 0 0 0 3px rgba(31, 91, 71, 0.12);
    }

    .btn {
        border-radius: 2px;
        font-family: Arial, sans-serif;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        transition: transform 160ms ease, filter 160ms ease;
    }

    .btn:hover { filter: brightness(0.94); transform: translateY(-1px); }
    .btn-secondary { background: var(--forest); }
    .btn-warning { background: #e3b24f; color: var(--ink); }
    .btn-danger { background: var(--coral); }

    .alert {
        background: var(--lime);
        border: 0;
        border-left: 5px solid var(--forest);
        border-radius: 0;
        color: var(--forest-dark);
        font-family: Arial, sans-serif;
        font-size: 0.88rem;
    }

    table { font-family: Arial, sans-serif; }
    th {
        background: transparent;
        color: var(--muted);
        font-size: 0.7rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }
    th, td { border-bottom-color: var(--line); }
    td strong { font-family: Georgia, 'Times New Roman', serif; font-size: 1.05rem; }
    .muted { color: var(--muted); font-family: Arial, sans-serif; font-size: 0.82rem; }
    .badge { border-radius: 2px; font-family: Arial, sans-serif; letter-spacing: 0.04em; text-transform: uppercase; }
    .pending { background: #f8e6ad; color: #805b13; }
    .completed { background: #cce8d2; color: var(--forest-dark); }

    .actions .btn { padding: 8px 10px; }

    @media (max-width: 780px) {
        body { padding: 14px; }
        .header { align-items: flex-start; flex-direction: column; }
        .header .btn { width: 100%; text-align: center; }
        .grid { grid-template-columns: 1fr; }
        .stats { grid-template-columns: 1fr; }
        .card { padding: 18px; }
        .list-heading { align-items: stretch; flex-direction: column; gap: 12px; }
        .search-input { max-width: none; }
        table, thead, tbody, tr, th, td { display: block; }
        thead { display: none; }
        tr { border-bottom: 1px solid var(--line); padding: 16px 0; }
        td { border: 0; padding: 5px 0; }
        td::before { color: var(--muted); content: attr(data-label); display: block; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em; margin-bottom: 3px; text-transform: uppercase; }
        td:last-child { padding-top: 12px; }
    }
</style>