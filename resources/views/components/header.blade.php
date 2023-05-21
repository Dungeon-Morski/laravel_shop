<header class="header">
    <div class="container">
        <div class="header_items flex justify-between items-center flex-col gap-2 md:flex-row  overflow-hidden">
            <div>
                <a href="{{route('products')}}" class="flex items-center gap-1 text-lg text-white">
                    <img src="{{asset('images/logo.svg')}}" alt="logo" class="w-[40px]">
                    <p>Мир цветов</p>
                </a>
            </div>
            <ul class="header_navigation flex gap-2 md:gap-4 items-center text-white flex-col md:flex-row">

                <li class="
                @if(Request::getRequestUri() == '/products')
                    active
                @endif
                "><a href="{{route('products')}}">Каталог</a></li>
                <li class="
                @if(Request::getRequestUri() == '/about')
                    active
                @endif
                "><a href="{{route('about')}}">О нас</a></li>
                <li class="
                @if(Request::getRequestUri() == '/map')
                    active
                @endif
                "><a href="{{route('map')}}">Где нас найти? </a></li>

            </ul>
            <div class="auth flex gap-2 items-center">

                @if(\Illuminate\Support\Facades\Auth::user())
                    <a class="userLogin" href="{{route('dashboard')}}">Кабинет</a>

                    @if(\Illuminate\Support\Facades\Auth::user()->is_admin != 1)

                        <a href="{{route('order.index')}}">Заказы</a>
                        <a href="{{route('cart.index')}}">Корзина</a>
                    @endif

                    <form action="{{route('logout')}}" method="post" class="w-min">
                        @csrf
                        <button type="submit" class="text-gray-600">Выйти</button>
                    </form>

                @else
                    <a href="{{route('register')}}">Регистрация</a>
                    <a href="{{route('login.index')}}">Войти</a>
                @endif
                <div class="burgerBlock flex items-center justify-center md:hidden absolute right-6 top-6">
                    <img src="{{asset('images/burger-icon.svg')}}" class="burgerBtn">
                </div>

            </div>
        </div>
    </div>
</header>
