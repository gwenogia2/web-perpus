<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<div class="d-flex">

    @include('components.sidebar')

    <main class="flex-grow-1 p-4">
        @yield('content')
    </main>

</div>

</body>
</html>
