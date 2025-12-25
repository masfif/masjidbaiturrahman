<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    {{-- @vite('resources/css/app.css') <!-- atau link CSS kamu --> --}}
</head>

<body class="bg-gray-100">

    {{-- Sidebar --}}
    @include('admin.components.sidebar')

    <main class="ml-64 p-6">
        @yield('content')
    </main>

    {{-- <script src="@vite('resources/js/app.js')"></script> <!-- atau script kamu --> --}}
</body>

</html>
