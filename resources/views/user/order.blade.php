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
<main>
    <div class="container">
        <div class="mt-8">
            <p class="text-xl">Добро пожаловать в личный кабинет</p>
            <div class="product_block my-12">
                <div class="container">

                    @if($orders->isEmpty())
                        <p class="text-center text-xl text-indigo-400">У вас нет заказов</p>
                    @endif
                    <div class="order_block">
                        <div class="order_wrapper flex gap-4 flex-col">
                            @foreach($orders as $order)
                                    <?php $count = 0; ?>
                                <div class="order_items">
                                    <p>ID заказа: {{$order->id}}</p>
                                    @foreach($order->orderProduct as $item)

                                        <div class="order_card flex gap-2 mt-2">
                                            <img src="{{asset('storage/'.$item->product->image)}}"
                                                 alt="product-image" class="w-[200px]">
                                            <div class="">

                                                <p>Название: {{$item->product->title}}</p>
                                                <p>Количество: {{$item->quantity}}</p>

                                            </div>
                                        </div>
                                            <?php $count += $item->quantity; ?>
                                    @endforeach
                                    <p class="mt-4">Цена заказа: {{$order->price}}</p>
                                    <p class="">Количество товаров: <?php echo $count; ?></p>
                                    <p>Статус: {{$order->status}}</p>
                                    @if(!empty($order->result))
                                        <p>Сообщение: {{$order->result}}</p>
                                    @endif
                                    <form action="{{route('order.delete', $order->id)}}" method="post" class=""
                                          data-id="{{$order->id}}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="mt-4 ml-auto rounded bg-red-600 px-4 py-2 text-white">Удалить
                                        </button>
                                    </form>
                                </div>

                            @endforeach
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</main>

<x-footer></x-footer>
</body>
</html>
