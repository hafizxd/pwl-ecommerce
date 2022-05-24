<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
</head>
<body>
    <header>
        <h1>Shoes Mart</h1>
        <div class="nav-links">
            <div>
                <a class="{{ Route::currentRouteName() === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            </div>
            <div>
                <a class="{{ Route::currentRouteName() === 'cart' ? 'active' : '' }}"  href="{{ route('cart') }}">Cart</a>
            </div>
            <div>
                <a class="{{ Route::currentRouteName() === 'order' ? 'active' : '' }}"  href="{{ route('order') }}">Orders</a>
            </div>
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    @yield('script')
</body>
</html>