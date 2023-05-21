<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мир цветов - редактирование категории</title>
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
