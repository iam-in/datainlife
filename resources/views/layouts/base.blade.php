<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>app</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
    <header>
        <ul class="nav">
        <li><a href="{{ route('users') }}">Пользователи</a></li>
        <li><a href="{{ route('groups') }}">Группы</a></li>
    </ul>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>


