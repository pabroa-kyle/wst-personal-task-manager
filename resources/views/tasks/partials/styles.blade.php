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
        --amber: #e3b24f;
        --shadow: 0 20px 45px rgba(23, 34, 29, 0.1);
    }

    * { box-sizing: border-box; }

    body {
        background: var(--paper);
        color: var(--ink);
        font-family: Georgia, 'Times New Roman', serif;
        margin: 0;
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

    .container { margin: 0 auto; max-width: 1180px; }
    .container-narrow { margin: 0 auto; max-width: 700px; }

    .kicker {
        color: var(--forest);
        display: block;
        font-family: Arial, sans-serif;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.16em;
        margin-bottom: 10px;
    }

    h1 {
        color: var(--ink);
        font-size: clamp(2rem, 5vw, 3.5rem);
        letter-spacing: -0.04em;
        line-height: 0.95;
        margin: 0;
    }

    .header {
        align-items: end;
        border-bottom: 1px solid rgba(23, 34, 29, 0.18);
        display: flex;
        gap: 20px;
        justify-content: space-between;
        padding: 28px 0 22px;
    }

    .page-header {
        border-bottom: 1px solid rgba(23, 34, 29, 0.18);
        padding: 28px 0 22px;
    }

    .back-link {
        color: var(--forest);
        display: inline-block;
        font-family: Arial, sans-serif;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        margin-bottom: 16px;
        text-decoration: none;
        text-transform: uppercase;
    }

    .back-link:hover { text-decoration: underline; }

    .card {
        background: rgba(255, 253, 248, 0.92);
        border: 1px solid rgba(23, 34, 29, 0.1);
        border-radius: 4px;
        box-shadow: var(--shadow);
        margin-top: 24px;
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

    .grid { display: grid; gap: 25px; grid-template-columns: 1.1fr 2.1fr; margin-top: 24px; }
    .grid .card { margin-top: 0; }

    .list-heading { align-items: end; display: flex; gap: 20px; justify-content: space-between; margin-bottom: 14px; }
    .list-heading h2 { margin-bottom: 0; margin-top: 5px; }
    .search-input { max-width: 190px; width: 100%; }

    .filter-bar { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
    .filter-pill {
        background: transparent;
        border: 1px solid var(--line);
        border-radius: 999px;
        color: var(--muted);
        cursor: pointer;
        font-family: Arial, sans-serif;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        padding: 7px 14px;
        text-transform: uppercase;
        transition: background 160ms ease, border-color 160ms ease, color 160ms ease;
    }
    .filter-pill:hover { border-color: var(--forest); color: var(--forest); }
    .filter-pill.is-active { background: var(--forest); border-color: var(--forest); color: #fffdf8; }

    form label {
        color: var(--forest-dark);
        display: block;
        font-family: Arial, sans-serif;
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    form input, form textarea, form select {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 2px;
        box-sizing: border-box;
        color: var(--ink);
        font-family: Arial, sans-serif;
        font-size: 1rem;
        margin-bottom: 6px;
        outline: none;
        padding: 10px 12px;
        transition: border-color 160ms ease, box-shadow 160ms ease;
        width: 100%;
    }

    form > div, form > fieldset { margin-bottom: 16px; }

    form input:focus, form textarea:focus, form select:focus {
        border-color: var(--forest);
        box-shadow: 0 0 0 3px rgba(31, 91, 71, 0.12);
    }

    .field-error {
        color: var(--coral);
        font-family: Arial, sans-serif;
        font-size: 0.78rem;
        margin: -2px 0 6px;
    }

    .btn {
        background: var(--forest);
        border: 0;
        border-radius: 2px;
        color: #fffdf8;
        cursor: pointer;
        display: inline-block;
        font-family: Arial, sans-serif;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        padding: 11px 18px;
        text-decoration: none;
        text-transform: uppercase;
        transition: transform 160ms ease, filter 160ms ease;
    }

    .btn:hover { filter: brightness(0.94); transform: translateY(-1px); }

    .btn-ghost {
        background: transparent;
        border: 1px solid var(--line);
        color: var(--ink);
    }
    .btn-ghost:hover { background: rgba(23, 34, 29, 0.04); filter: none; }

    .btn-warning { background: var(--amber); color: var(--ink); }
    .btn-danger { background: var(--coral); }

    .actions { display: flex; flex-wrap: wrap; gap: 8px; }
    .actions .btn { padding: 8px 10px; }

    .form-actions { display: flex; gap: 10px; margin-top: 6px; }

    .alert {
        background: var(--lime);
        border: 0;
        border-left: 5px solid var(--forest);
        border-radius: 0;
        color: var(--forest-dark);
        font-family: Arial, sans-serif;
        font-size: 0.88rem;
        margin-bottom: 20px;
        padding: 12px 16px;
    }

    table { border-collapse: collapse; font-family: Arial, sans-serif; width: 100%; }
    th, td { border-bottom: 1px solid var(--line); padding: 12px 10px; text-align: left; vertical-align: top; }
    th {
        color: var(--muted);
        font-size: 0.7rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }
    td strong { font-family: Georgia, 'Times New Roman', serif; font-size: 1.05rem; }

    .muted { color: var(--muted); font-family: Arial, sans-serif; font-size: 0.82rem; }

    .empty-state { padding: 32px 10px; text-align: center; }

    .badge {
        border-radius: 2px;
        display: inline-block;
        font-family: Arial, sans-serif;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        padding: 5px 10px;
        text-transform: uppercase;
    }
    .pending { background: #f8e6ad; color: #805b13; }
    .completed { background: #cce8d2; color: var(--forest-dark); }

    @media (max-width: 780px) {
        body { padding: 14px; }
        .header { align-items: flex-start; flex-direction: column; }
        .header .btn { text-align: center; width: 100%; }
        .grid { grid-template-columns: 1fr; }
        .stats { grid-template-columns: 1fr; }
        .card { padding: 18px; }
        .list-heading { align-items: stretch; flex-direction: column; gap: 12px; }
        .search-input { max-width: none; }
        .form-actions { flex-direction: column; }
        .form-actions .btn { text-align: center; width: 100%; }
        table, thead, tbody, tr, th, td { display: block; }
        thead { display: none; }
        tr { border-bottom: 1px solid var(--line); padding: 16px 0; }
        td { border: 0; padding: 5px 0; }
        td::before { color: var(--muted); content: attr(data-label); display: block; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em; margin-bottom: 3px; text-transform: uppercase; }
        td:last-child { padding-top: 12px; }
    }
</style>
