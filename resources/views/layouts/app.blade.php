<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Personal Task Manager')</title>
    @include('tasks.partials.styles')
</head>
<body>
    <div class="app-shell">
        @include('layouts.sidebar')
        <main class="main-content">
            @yield('content')
        </main>
    </div>
    @include('layouts.bottom-nav')
    @yield('scripts')
</body>
</html>
