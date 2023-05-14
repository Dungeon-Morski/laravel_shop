<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Панель администратора</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css"/>
    @vite(['resources/scss/app.scss','resources/js/app.js','resources/js/product.js'])

</head>
<body class="antialiased">
<x-header></x-header>

<div class="container">
    <div class="mt-8">
        <p class="text-xl">Добро пожаловать в админ панель {{\Illuminate\Support\Facades\Auth::user()->name}}</p>
        <div class="adminBtns">
            @if(\Illuminate\Support\Facades\Auth::user()->is_admin == 1)
                <a href="{{route('admin.products')}}">Товары</a>
                <a href="{{route('admin.categories')}}">Категории</a>
                <a href="{{route('admin.orders')}}">Заказы</a>
            @endif
        </div>
    </div>
</div>
<x-footer></x-footer>
</body>
</html>
