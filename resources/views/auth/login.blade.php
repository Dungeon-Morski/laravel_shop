<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Мир цветов - продукты</title>

    @vite(['resources/scss/app.scss','resources/js/app.js'])
</head>
<body class="antialiased">
<div class="container">
    <div class="form_block flex justify-center">

        <form action="{{route('login.store')}}" method="post" class="loginForm" id="loginForm">
            @csrf
            <h1 class="text-center text-lg">Авторизация</h1>
            <div class="message text-red-400">
            </div>

            <div>
                <label for="login">Логин</label>
                <input type="text" id="login" name="login" autofocus value="{{old('login')}}" required>
                @error('login')
                    <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>

            <div>
                <label for="password">Пароль</label>
                <input type="text" id="password" name="password" required>
                @error('password')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>
            <p class="mt-2 text-gray-500">Нет аккаунта? - <a href="{{route('register')}}" class="underline">Регистрация</a></p>
            <button type="submit" class="loginBtn" >Войти</button>
        </form>
    </div>
</div>
<script>

</script>
</body>
</html>
