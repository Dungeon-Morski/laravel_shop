<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мир цветов - продукты</title>
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

<div class="container">
    <div class="mt-6">
        <p class="productAddBtn">Добавить товар</p>
    </div>
</div>
<div class="overlay"></div>
<div class="overlay_form_block">
    <form action="{{route('admin.productCreate')}}" method="post" class="productAddForm flex flex-col gap-2"
          enctype="multipart/form-data">
        @csrf
        <div>
            <label for="">Фото товара</label>
            <input value="" type="file" class="file" name="image" required>
        </div>
        <div>
            <label for="">Навание</label>
            <input type="text" value="" name="title" required>
        </div>
        <div>
            <label for="">Цена</label>
            <input type="number" value="" name="price" required>
        </div>
        <div>
            <label for="">Описание</label>
            <input type="text" value="" name="description" required>
        </div>
        <div>
            <label for="">Категория</label>
            <select name="category_id" id="" required>
                @foreach($categories as $category)
                    <option name="category_id" value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>

        </div>
        <div>
            <label for="">В наличии</label>
            <input type="number" value="" name="quantity" required>
        </div>
        <div>
            <label for="">Страна производитель</label>
            <input type="text" value="" name="country" required>
        </div>
        <div>
            <label for="">Цвет</label>
            <input type="text" value="" name="color" required>
        </div>
        <div class="flex !flex-row gap-2">
            <button type="submit" class="mt-2">Сохранить</button>
            <button class="closeBtn">Закрыть</button>
        </div>
    </form>
</div>

<div class="product_block my-12">
    <div class="container">
        <div class="flex gap-3 flex-wrap">
            @foreach($products as $product)
                <a href="{{route('admin.productShow', $product->id)}}">
                    <div class="product border rounded  p-2">
                        <img src="{{asset('storage/'.$product->image)}}"
                             alt="product-image" class="">
                        <div class="product_info my-2">
                            <p>Название: {{$product->title}}</p>
                            <p>Цена: {{$product->price}}</p>
                            <p>Описание: {{$product->description}}</p>
                            <p>Категория: {{$product->category->title}}</p>
                            <p>Цвет: {{$product->title}}</p>
                            <p>Количество: {{$product->quantity}}</p>
                            <p>Страна производитель: {{$product->country}}</p>
                        </div>
                        <a href="{{route('admin.productShow', $product->id)}}"
                           class="bg-orange-500 py-2 px-2 text-center rounded text-white hover:text-black">Редактировать</a>
                        <form action="{{route('admin.productDestroy', $product->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                    class="mt-2 w-full bg-red-500 py-2 px-2 text-center rounded text-white hover:text-black">
                                Удалить
                            </button>
                        </form>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
</div>

<x-footer></x-footer>
</body>
</html>
