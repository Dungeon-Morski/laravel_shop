<!DOCTYPE html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Где нас найти?</title>
    @vite(['resources/scss/app.scss','resources/js/app.js'])

</head>
<body class="antialiased">
<x-header></x-header>
<div class="container">
    <div class="mt-8">
        <p class="text-lg">Адрес: Улица 26-ти Бакинских Комиссаров, Москва</p>
        <p class="text-lg">Номер: +7-945-234-65-31</p>
        <p class="text-lg">Email: MirCvetor2023@mail.ru</p>
        <div class="flex justify-center mt-4 w-[900px] h-[500px]">
            <img src="{{asset('images/map.jpg')}}"
                 alt="product-image" class="w-full h-full object-cover">
        </div>
    </div>
</div>
<x-footer></x-footer>
</body></html>