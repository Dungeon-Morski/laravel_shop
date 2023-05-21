<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мир цветов - редактирование продукта</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/scss/app.scss','resources/js/app.js'])

</head>
<body class="antialiased">
<x-header></x-header>
<div class="product_block my-12">
    <div class="container">
        <div class="flex gap-3 justify-center">
            <div class="adminProduct show border rounded  p-2">
                <div class="flex gap-2  justify-center">
                    <form action="{{route('admin.productEdit', $product->id)}}" method="post"
                          class="productEditForm flex flex-col gap-2 justify-center" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="">
                            <p class="text-center">Фото товара</p>
                            <div class="flex justify-center">
                                <img src="{{asset('storage/'.$product->image)}}"
                                     alt="product-image">
                            </div>
                        </div>
                        <div>
                            <label for="">Выбери новое фото</label>
                            <input value="{{$product->image}}" type="file" class="file" name="image">
                        </div>
                        <div>
                            <label for="">Навание</label>
                            <input type="text" value="{{$product->title}}" name="title">
                        </div>
                        <div>
                            <label for="">Цена</label>
                            <input type="number" value="{{$product->price}}" name="price">
                        </div>
                        <div>
                            <label for="">Описание</label>
                            <input type="text" value="{{$product->description}}" name="description">
                        </div>
                        <div>
                            <label for="">Категория</label>
                            <select name="category_id" id="">
                                <option selected name="category_id"
                                        value="{{$product->category_id}}">{{$product->category->title}}</option>
                                @foreach($categories as $category)
                                    <option name="category_id" value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div>
                            <label for="">В наличии</label>
                            <input type="number" value="{{$product->quantity}}" name="quantity">
                        </div>
                        <div>
                            <label for="">Страна производитель</label>
                            <input type="text" value="{{$product->country}}" name="country">
                        </div>
                        <div>
                            <label for="">Цвет</label>
                            <input type="text" value="{{$product->color}}" name="color">
                        </div>
                        <button type="submit" class="mt-2">Сохранить</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<x-footer></x-footer>
</body>
</html>
