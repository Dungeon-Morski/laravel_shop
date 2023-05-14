<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мир цветов - продукты</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
<div class="product_block mt-12">
    <div class="container">
        <div class="flex gap-3">
            <div class="product show border rounded  p-2">
                <div class="flex gap-2">
                    <img src="{{asset('storage/'.$product->image)}}"
                         alt="product-image">
                    <div class="product_info flex flex-col justify-between">
                        <p class="title">Название: {{$product->title}}</p>
                        <p>Цена: {{$product->price}}</p>
                        <p>Описание: {{$product->description}}</p>
                        <p>Категория: {{$product->category->title}}</p>
                        <p>В наличии: {{$product->quantity}}</p>
                        <p>Страна производитель: {{$product->country}}</p>
                        @if(\Illuminate\Support\Facades\Auth::user())
                            <form action="" class="addToCartFormShow" method="post">
                                @csrf

                                <button type="submit"
                                        class="addToCartBtn bg-green-500 px-2 py-2 text-white w-full rounded">В корзину
                                </button>

                            </form>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<x-footer></x-footer>
</body>
</html>
