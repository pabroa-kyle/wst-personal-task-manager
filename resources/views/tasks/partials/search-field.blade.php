@php
    $id = $id ?? 'search';
    $placeholder = $placeholder ?? 'Search...';
@endphp
<div class="search-field">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
    <input id="{{ $id }}" class="search-input" type="search" placeholder="{{ $placeholder }}" aria-label="{{ $placeholder }}" autocomplete="off" spellcheck="false">
    <kbd class="search-kbd" data-search-kbd aria-hidden="true">/</kbd>
    <button type="button" class="search-clear" data-search-clear aria-label="Clear search" hidden>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
</div>
<script>
    (() => {
        const field = document.currentScript.previousElementSibling;
        const input = field.querySelector('.search-input');
        const kbd = field.querySelector('[data-search-kbd]');
        const clearBtn = field.querySelector('[data-search-clear]');

        function sync() {
            const hasValue = input.value.length > 0;
            clearBtn.hidden = !hasValue;
            kbd.hidden = hasValue;
        }

        function clear() {
            input.value = '';
            input.dispatchEvent(new Event('input', { bubbles: true }));
        }

        input.addEventListener('input', sync);
        clearBtn.addEventListener('click', () => { clear(); input.focus(); });

        input.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape') return;
            if (input.value.length > 0) {
                clear();
            } else {
                input.blur();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key !== '/' || event.metaKey || event.ctrlKey || event.altKey) return;
            const active = document.activeElement;
            if (active && (active.tagName === 'INPUT' || active.tagName === 'TEXTAREA' || active.tagName === 'SELECT')) return;
            event.preventDefault();
            input.focus();
        });

        sync();
    })();
</script>
