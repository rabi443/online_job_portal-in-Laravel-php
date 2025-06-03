
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MeroShare Clone</title>
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="p-4">
        <div class="container mx-auto flex justify-between">
            <a href="#" class="font-bold">MeroShare</a>
            <a href="#">Logout</a>
        </div>
    </nav>
    <main class="container mx-auto mt-6 p-4">
        @yield('content')
    </main>
    <script src="/js/script.js"></script>
</body>
</html>
