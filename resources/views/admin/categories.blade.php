<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мир цветов - категории</title>
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

<div class="overlay"></div>
<div class="overlay_form_block">
    <form action="{{route('admin.categoryCreate')}}" method="post" class="categoryAddForm flex flex-col gap-2 !border-none">
        @csrf

        <div>
            <label for="" class="text-white">Навание</label>
            <input type="text" value="" name="title" required>
        </div>
        <div class="flex !flex-row gap-2">
            <button type="submit" class="mt-2">Сохранить</button>
            <button class="closeBtn">Закрыть</button>
        </div>
    </form>
</div>

<div class="container">
    <div class="mt-8">
        <p class="categoryAddBtn">Создать категорию</p>
        <div class="overflow-x-auto">
            <table class="categoriesTable mt-4">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Название</td>
                    <td>Управление</td>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr class="">
                        <td class="">{{$category->id}}</td>
                        <td class="">{{$category->title}}</td>
                        <td class="">
                            <form action="{{route('admin.categoryDestroy', $category->id)}}" method="post"
                                  class="flex justify-end gap-2">
                                @csrf
                                @method('delete')
                                <a href="{{route('admin.categoryShow', $category->id)}}"
                                   class="bg-orange-400 py-1 px-2 rounded text-white hover:opacity-[.8]">Редактировать
                                </a>
                                <button type="submit" value="delete" name="value"
                                        class="bg-red-400 py-1 px-2 rounded text-white hover:opacity-[.8]">Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
<x-footer></x-footer>
</body>
</html>
