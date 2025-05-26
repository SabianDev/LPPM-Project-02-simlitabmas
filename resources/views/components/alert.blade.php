@props(['type' => 'success'])

@php
    $alertStyles = [
        'success' => 'color: rgb(21, 128, 61); background-color: rgb(187, 247, 208);',
        'error' => 'color: rgb(153, 27, 27); background-color: rgb(254, 202, 202);',
        'warning' => 'color: rgb(202, 138, 4); background-color: rgb(254, 240, 138);',
        'info' => 'color: rgb(30, 64, 175); background-color: rgb(191, 219, 254);',
    ];

    $iconPaths = [
        'success' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z',
        'error' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z',
        'warning' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z',
        'info' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z',
    ];
@endphp

<div class="alert" role="alert"
     style="display: flex; align-items: center; padding: 1rem; margin: 0.5rem 0; border-radius: 0.5rem; font-size: 0.875rem; {{ $alertStyles[$type] ?? $alertStyles['success'] }}">
    <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" fill="currentColor" viewBox="0 0 20 20"
         xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="{{ $iconPaths[$type] ?? $iconPaths['success'] }}" />
    </svg>
    <span>{{ $slot }}</span>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var alerts = document.querySelectorAll('.alert');
        setTimeout(function () {
            alerts.forEach(function (alert) {
                alert.style.display = 'none';
            });
        }, 5000);
    });
</script>
