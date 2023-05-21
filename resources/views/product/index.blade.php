<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мир цветов - продукты</title>

    @vite(['resources/scss/app.scss','resources/js/app.js','resources/js/product.js'])

</head>
<body class="antialiased">

<x-header></x-header>
<div class="product_block my-12">
    <div class="container">
        <div class="filterBlock">
            <form action="" method="" class="flex">

                <div class="flex gap-3 justify-center md:justify-between w-full flex-wrap">

                    <div class="flex gap-2 items-center flex-col md:flex-row w-full md:w-auto">
                        <input type="text" placeholder="Наименование" name="title" class="w-full">
                        <select name="country" id="" class="w-full">
                            <option selected value="">Выберите поставщика</option>
                            @foreach($countries as $country)
                                <option name="country" value="{{$country}}">{{$country}}</option>
                            @endforeach

                        </select>
                        <div class="w-full">
                            <select name="category_id" id="" class="w-full">
                                <option selected value="">Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option name="category_id" value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 w-full md:w-auto">
                        <a href="{{route('products')}}"
                           class="p-2 bg-blue-500 rounded text-white text-center align-middle w-full">Сбросить</a>
                        <button type="submit" class="bg-green-500 text-white p-2 rounded w-full">Найти</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="flex gap-3 flex-wrap justify-center md:justify-start mt-6">
            @foreach($products as $product)
                <a href="{{route('product.show', $product->id)}}">
                    <div class="product border rounded  p-2">
                        <div class="productImageWrapper">
                            <img src="{{asset('storage/'.$product->image)}}"
                                 alt="product-image" class="">
                        </div>
                        <div class="my-2">
                            <p class="addStatus"></p>
                            <p>Название: {{$product->title}}</p>
                            <p>Цена: {{$product->price}}</p>

                        </div>
                        @if(Auth::user())
                            <form action="" class="addToCartForm" method="post" data-product-id="{{$product->id}}"
                                  data-user-id="{{\Illuminate\Support\Facades\Auth::user()->id}}">
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
                </a>
            @endforeach

        </div>
        <div class="mt-5">
            {{$products->withQueryString()->links()}}
        </div>
    </div>
</div>
<x-footer></x-footer>
</body>
</html>
