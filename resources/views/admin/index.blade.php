<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Панель администратора</title>
    @vite(['resources/scss/app.scss','resources/js/app.js'])

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
