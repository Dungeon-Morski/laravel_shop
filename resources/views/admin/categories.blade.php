<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мир цветов - категории</title>

    @vite(['resources/scss/app.scss','resources/js/app.js'])

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
