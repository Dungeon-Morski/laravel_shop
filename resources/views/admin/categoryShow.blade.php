<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мир цветов - редактирование категории</title>
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
<div class="product_block my-12">
    <div class="container">
        <div class="flex gap-3 justify-center">
            <div class="adminProduct show border rounded  p-2">
                <div class="flex gap-2  justify-center">
                    <form action="{{route('admin.categoryEdit', $category->id)}}" method="post"
                          class="flex flex-col gap-2 justify-center">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="">Навание</label>
                            <input type="text" value="{{$category->title}}" name="title">
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
