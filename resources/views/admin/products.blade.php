<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мир цветов - продукты</title>

    @vite(['resources/scss/app.scss','resources/js/app.js','resources/js/product.js'])

</head>
<body class="antialiased">
<x-header></x-header>

<div class="container">
    <div class="mt-6">
        <p class="productAddBtn">Добавить товар</p>
    </div>

</div>
<div class="overlay"></div>
<div class="overlay_form_block">
    <form action="{{route('admin.productCreate')}}" method="post"
          class="productAddForm flex flex-col gap-2 !border-none"
          enctype="multipart/form-data">
        @csrf
        <div>
            <label for="file">Фото товара</label>
            <input value="" type="file" class="file" name="image" required>
        </div>
        <div>
            <label for="title">Навание</label>
            <input type="text" value="" name="title" id="title" required>
        </div>
        <div>
            <label for="price">Цена</label>
            <input type="number" value="" name="price" id="price" required>
        </div>
        <div>
            <label for="description">Описание</label>
            <input type="text" value="" name="description" id="description" required>
        </div>
        <div>
            <label for="category_id">Категория</label>
            <select name="category_id" id="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option name="category_id" value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>

        </div>
        <div>
            <label for="quantity">В наличии</label>
            <input type="number" value="" name="quantity" id="quantity" required>
        </div>
        <div>
            <label for="country">Страна производитель</label>
            <input type="text" value="" name="country" id="country" required>
        </div>
        <div>
            <label for="color">Цвет</label>
            <input type="text" value="" name="color" id="color" required>
        </div>
        <div class="flex !flex-row gap-2">
            <button type="submit" class="mt-2">Сохранить</button>
            <button class="closeBtn">Закрыть</button>
        </div>
    </form>
</div>

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
                        <a href="{{route('admin.products')}}"
                           class="p-2 bg-blue-500 rounded text-white text-center align-middle w-full">Сбросить</a>
                        <button type="submit" class="bg-green-500 text-white p-2 rounded w-full">Найти</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="flex gap-3 flex-wrap flex-col sm:flex-row items-center mt-6 justify-center md:justify-around lg:justify-start">
            @foreach($products as $product)

                <div class="">

                    <div class="product border rounded  p-2">
                        <div class="productImageWrapper">
                            <img src="{{asset('storage/'.$product->image)}}"
                                 alt="product-image" class="">
                        </div>

                        <div class="product_info my-2">
                            <p>Название: {{$product->title}}</p>
                            <p>Цена: {{$product->price}}</p>
                            <p>Описание: {{$product->description}}</p>
                            <p>Категория: {{$product->category->title}}</p>
                            <p>Цвет: {{$product->title}}</p>
                            <p>Количество: @if($product->quantity != 0)
                                    {{$product->quantity}}
                                @else
                                    <span class="text-red-500">нет в наличии</span>
                                @endif</p>
                            <p>Страна производитель: {{$product->country}}</p>
                        </div>
                        <a href="{{route('admin.productShow', $product->id)}}"
                           class="bg-orange-500 py-2 px-2 text-center rounded text-white hover:bg-orange-600">Редактировать</a>
                        <form action="{{route('admin.productDestroy', $product->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                    class="mt-2 w-full bg-red-500 py-2 px-2 text-center rounded text-white hover:bg-red-600 ">
                                Удалить
                            </button>
                        </form>
                    </div>
                </div>
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
