<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main-admin.css') }}">
</head>
<body>
    <header>
        <h1>Shoes Mart | Admin</h1>
        <div class="nav-links">
            <div>
                <a class="{{ Route::currentRouteName() === 'admin.product' ? 'active' : '' }}" href="{{ route('admin.product') }}">Produk</a>
            </div>
            <div>
                <a class="{{ Route::currentRouteName() === 'admin.order' ? 'active' : '' }}"  href="{{ route('admin.order') }}">Order</a>
            </div>
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    @yield('script')
</body>
</html>