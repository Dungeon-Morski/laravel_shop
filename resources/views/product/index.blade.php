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
        <div class="flex gap-3 flex-wrap justify-center md:justify-start">
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
                                        class="addToCartBtn bg-green-500 px-2 py-2 text-white w-full rounded">В корзину
                                </button>

                            </form>
                        @endif

                    </div>
                </a>
            @endforeach

        </div>
    </div>
</div>
<x-footer></x-footer>
</body>
</html>
