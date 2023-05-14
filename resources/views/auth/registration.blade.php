<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CopyStar</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    @vite(['resources/scss/app.scss','resources/js/app.js','resources/js/register.js'])
</head>
<body class="antialiased">
<div class="container">
    <div class="form_block flex justify-center">

        <form action="" method="post" class="regForm" id="regForm" novalidate>
            @csrf
            <h1 class="text-center text-lg">Регистрация</h1>
            <div class="message text-red-400">
                @foreach($errors->all() as $message)
                    <p>{{$message}}</p>
                @endforeach
            </div>
            <div>
                <label for="surname">Фамилия</label>
                <input type="text" id="surname" name="surname" placeholder="Иванов" pattern="[А-Яа-яЁё]" autofocus>
            </div>
            <div>
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" placeholder="Иван">
            </div>
            <div>
                <label for="patronymic">Отчество</label>
                <input type="text" id="patronymic" name="patronymic" placeholder="Необязательное поле">
            </div>
            <div>
                <label for="login">Логин</label>
                <input type="text" id="login" name="login" placeholder="Ivan1982">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Ivan1982@mail.ru">
            </div>
            <div>
                <label for="password">Пароль</label>
                <input type="text" id="password" name="password" placeholder="Пароль">
            </div>
            <div>
                <label for="confpassword">Подтверждение пароля</label>
                <input type="text" id="confpassword" placeholder="Повтор пароля">
            </div>
            <section>
                <input type="checkbox" name="rules" id="rules">
                <label for="rules">Согласие на обработку персональных данных</label>
            </section>
            <p class="mt-2 text-gray-500">Уже есть аккаунт? - <a href="{{route('login.index')}}" class="underline">Войти</a></p>
            <button type="submit" class="registerBtn" >Зарегистрироваться</button>
        </form>
    </div>
</div>
<script>

</script>
</body>
</html>
