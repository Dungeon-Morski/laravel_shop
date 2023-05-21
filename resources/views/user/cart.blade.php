<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Кабинет</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/scss/app.scss','resources/js/app.js','resources/js/cart.js'])

</head>
<body class="antialiased">
<x-header></x-header>
<div class="container">
    <div class="mt-8">
{{--        <p class="text-xl">Добро пожаловать в личный кабинет</p>--}}
        <div class="product_block mt-12">
            <div class="container">

                @if($cart->isEmpty())
                    <p class="text-center text-xl text-indigo-400">Коризна пуста</p>
                @endif
                @if(!$cart->isEmpty())
                    <div class="mb-8 flex justify-between gap-2 relative flex-col md:flex-row">

                        <div class="flex gap-2 h-[700px] flex-col overflow-y-auto order-2 md:order-1 w-full">
                            @foreach($cart as $item)

                                <div class="card border rounded border-black p-2 flex gap-2 items-center h-min w-full">
                                    <img src="{{asset('storage/'.$item->product->image)}}"
                                         alt="product-image" class="w-[200px]">
                                    <div class="my-2">
                                        <p>Название: {{$item->product->title}}</p>
                                        <p class="">Цена: <span
                                                data-num="{{$item->product->price}}"
                                                data-quantity="{{$item->quantity}}"
                                                class="productPrice">{{$item->product->price}}</span></p>
                                        <div>
                                            <p class="mb-2">Количество:</p>
                                            <form action=""
                                                  class="cartForm flex gap-2 items-center mt-2"
                                                  method="post" data-product-id="{{$item->product->id}}"
                                                  data-cart-id="{{$item->id}}"
                                                  data-value=""
                                                  data-user-id="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                                @csrf

                                                <button type="submit"
                                                        value="increment"
                                                        name="value"
                                                        class="increment bg-green-500 px-1 py-1 text-white w-full rounded">
                                                    +
                                                </button>
                                                <p class="productCount w-full text-center">{{$item->quantity}}</p>
                                                <button type="submit"
                                                        value="decrement"
                                                        name="value"
                                                        class="decrement bg-red-500  px-1 py-1 text-white w-full rounded">
                                                    -
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            @endforeach

                        </div>

                        <div class="OrderCountBlock order-1">
                            <p class="">Итого: <span class="OrderCount"></span> ₽</p>
                            <div class="orderBtnBlock">
                                <p class="orderBtn">Офомить заказ</p>
                            </div>
                        </div>

                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

<x-footer></x-footer>
</body>
</html>
