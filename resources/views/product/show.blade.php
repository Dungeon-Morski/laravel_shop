<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мир цветов - продукты</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @vite(['resources/scss/app.scss','resources/js/app.js','resources/js/product.js'])

</head>
<body class="antialiased">
<x-header></x-header>
<div class="product_block mt-12">
    <div class="container">
        <div class="flex gap-3 flex-col md:flex-row items-center">
            <div class="product show border rounded  p-2 w-min md:w-full">
                <div class="flex gap-2 flex-col md:flex-row">
                    <img src="{{asset('storage/'.$product->image)}}"
                         alt="product-image" class="self-center">
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
                                        @if(Auth::user()->is_admin == 1)
                                            disabled
                                        @endif
                                        class="addToCartBtn bg-green-500 px-2 py-2 text-white w-full rounded">
                                    @if(Auth::user()->is_admin == 1)
                                        Смените роль
                                    @else
                                        В корзину
                                    @endif
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
