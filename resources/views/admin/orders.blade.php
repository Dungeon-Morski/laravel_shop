<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Кабинет</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/scss/app.scss','resources/js/app.js'])

</head>
<body class="antialiased">
<x-header></x-header>
<main>
    <div class="container">
        <div class="mt-8">
            <div class="filterBlock mt-4">
                <form action="" method="" class="flex">

                    <div class="flex gap-3 justify-center md:justify-between w-full flex-wrap">

                        <div class="flex gap-2 items-center flex-col md:flex-row w-full md:w-auto">

                            <select name="status" id="" class="w-full">
                                <option name="status" selected value="">Выберите статус</option>
                                <option name="status" value="Новый">Новый</option>
                                <option name="status" value="Подтвержден">Подтвержден</option>
                                <option name="status" value="Отклонен">Отклонен</option>
                            </select>

                        </div>
                        <div class="flex items-center gap-2 w-full md:w-auto">
                            <a href="{{route('admin.orders')}}" class="p-2 bg-blue-500 rounded text-white text-center align-middle w-full">Сбросить</a>
                            <button type="submit" class="bg-green-500 text-white p-2 rounded w-full">Найти</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="product_block my-12">
                <div class="container">

                    @if($orders->isEmpty())
                        <p class="text-center text-xl text-indigo-400">Нет заказов</p>
                    @endif
                    <div class="order_block">
                        <div class="order_wrapper flex gap-4 flex-col">
                            @foreach($orders as $order)
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

                                    @endforeach
                                    <p class="mt-4">Цена заказа: {{$order->price}}</p>
                                    <p class="">Дата заказа: {{$order->created_at}}</p>
                                    <p class="">ФИО заказчика: {{$order->user->surname}} {{$order->user->name}} {{$order->user->patronymic}}</p>

                                    @if(!empty($order->result))
                                        <p>Сообщение: {{$order->result}}</p>
                                    @endif
                                    <form action="{{route('admin.orderEdit', $order->id)}}" method="post" class=""
                                          data-id="{{$order->id}}">
                                        @csrf
                                        @method('PATCH')
                                        <div>
                                            <label for="status">Статус</label>
                                            <select name="status" id="status" class="rounded">
                                                <option selected value="{{$order->status}}">{{$order->status}}</option>
                                                <option value="Подтвержден" name="status">Подтвержден</option>
                                                <option value="Отклонен" name="status">Отклонен</option>
                                            </select>
                                        </div>
                                        <div class="my-2">
                                            <label for="">Сообщение</label>
                                            <input type="text" required class="border pl-1 outline-none rounded w-full max-w-[500px]" name="result" value="{{$order->result}}">
                                        </div>
                                        <button type="submit"
                                                class="mt-4 ml-auto rounded bg-green-600 px-4 py-2 text-white">Сохранить
                                        </button>
                                    </form>

                                </div>

                            @endforeach
                        </div>
                        <div class="mt-5">
                            {{$orders->withQueryString()->links()}}
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
