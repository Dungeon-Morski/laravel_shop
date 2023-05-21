<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>О нас</title>
    @vite(['resources/scss/app.scss','resources/js/app.js'])

</head>
<body class="antialiased">
<x-header></x-header>
<div class="container">
    <div class="mt-8">
        <div class="text-xl">
            <a href="{{route('products')}}" class="flex items-center gap-1 text-lg text-white w-min">
                <img src="{{asset('images/logo.svg')}}" alt="logo" class="w-[40px]">
                <p class="text-black whitespace-nowrap">Мир цветов</p>
        </a>
        </div>

        <p class="mt-2">Наш девиз: Цветы — это больше, чем слова</p>
        <div class="mt-4">
            @if(!$products->isEmpty())
                <h1 class="text-center text-xl">Новинки компании</h1>
            @endif

            <!-- Slider main container -->
            <div class="swiper mt-4">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach($products as $product)
                        <div class="swiper-slide">
                            <p class="absolute top-0 left-0 text-white bg-black px-2">{{$product->title}}</p>
                            <img src="{{asset('storage/'.$product->image)}}"
                                 alt="product-image" class="object-cover">
                        </div>
                    @endforeach

                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
        </div>

    </div>
</div>
<x-footer></x-footer>
</body>
</html>
