<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('styles/style.css') }}">
    <title>Webshop</title>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">

            {{-- Kategória oldalmenü gomb --}}
            <button class="btn text-white d-block d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#navCategory"
                aria-controls="offcanvasExample">
                <i class="fa fa-tags" data-bs-toggle="offcanvas" href="#navCategory" aria-hidden="true"></i>
            </button>

            {{-- Navigáció sáv --}}
            <a class="navbar-brand d-block d-lg-none" href="{{ url('/') }}">Webshop logó</a>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav w-100">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }} me-3" href="{{ url('/') }}">
                        <i class="fas fa-home fa-lg fa-fw me-2"></i> Főoldal
                    </a>
                    @foreach ($menu as $key => $menu_item)
                        <a class="nav-link {{ request()->is($key) ? 'active' : '' }} me-3" href="{{ url('/' . $key) }}">
                            <i class="fas {{ $menu_item[0] }} fa-lg fa-fw me-2"></i> {{ $menu_item[1] }}
                        </a>
                    @endforeach
                    @if (auth()->check() && auth()->user()->is_admin)
                    <a class="nav-link ms-auto" href="{{ url('/admin') }}">
                        <i class="fas fa-user-lock fa-lg fa-fw me-2"></i> Admin
                    </a>
                    @endif
                </div>
            </div>

            {{-- Főmenü oldalmenü gomb --}}
            <button class="btn text-white d-block d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#navMenu"
                aria-controls="offcanvasExample">
                <i class="fa fa-bars" data-bs-toggle="offcanvas" href="#navMenu" aria-hidden="true"></i>
            </button>

            {{-- Főmenü oldalmenü tartalma --}}
            <div class="offcanvas offcanvas-end text-center bg-dark text-light" tabindex="-1" id="navMenu"
                data-bs-backdrop="false">
                <div class="offcanvas-header text-white">
                    <h5>Menü</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close">
                    </button>
                </div>
                <div class="offcanvas-body list-group list-group-flush">
                    <a class="list-group-item list-group-item-action {{ request()->is('/') ? 'active' : '' }}"
                        href="{{ url('/') }}">
                        <i class="fas fa-home fa-fw"></i> Főoldal
                    </a>
                    @foreach ($menu as $key => $menu_item)
                        <a class="list-group-item list-group-item-action {{ request()->is($key) ? 'active' : '' }}"
                            href="{{ url('/' . $key) }}">
                            <i class="fas {{ $menu_item[0] }} fa-fw"></i> {{ $menu_item[1] }}
                        </a>
                    @endforeach
                    @if (auth()->check() && auth()->user()->is_admin)
                    <a class="list-group-item list-group-item-action" href="{{ url('/admin') }}">
                        <i class="fas fa-user-lock fa-lg fa-fw me-2"></i> Admin
                    </a>
                    @endif
                    <div class="row">
                        {{-- Kosár --}}
                        <div class="col-auto my-3 mx-auto border border-danger border-2 rounded-pill">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto ps-3 h5 mb-0 user-select-none">
                                    @php
                                        $total = 0;
                                        $quantity = 0;
                                    @endphp
                                    @foreach ((array) session('cart') as $product)
                                        @php
                                            $total += $product['quantity'] * $product['price'];
                                            $quantity += $product['quantity'];
                                        @endphp
                                    @endforeach
                                    {{ number_format($total, 0, ',', ' ') }} Ft.
                                    ({{ $quantity }})
                                </div>
                                <div class="col-auto px-0">
                                    <a id="cartButton" class="btn btn-danger rounded-circle nav-kosar"
                                        href="{{ url('/kosar') }}" data-bs-tooltip="tooltip"
                                        data-bs-placement="bottom" title="Kosaram!">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- Profil --}}
                        <div class="col-auto my-3 mx-auto">
                            <a class="btn btn-outline-success rounded-circle profilButton"
                                href="{{ url('' . Auth::check() ? '/profil' : '/bejelentkezes' . '') }}">
                                <i class="fas fa-user fa-fw"></i>
                            </a>
                        </div>
                    </div>
                    @auth
                        <div class="col-6 mx-auto my-auto text-center border-0">
                            <div class="card-header pb-3">
                                Üdvözöljük <br><b>{{ auth()->user()->name }}</b>
                            </div>
                            <div class="card-footer border-top pt-3">
                                <a href="{{ url('/kijelentkezes') }}" class="btn btn-warning">Kijelentkezés</a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>

            {{-- Kategória oldalmenü tartalma --}}
            <div class="offcanvas offcanvas-start text-center bg-dark text-light" tabindex="-2" id="navCategory"
                data-bs-backdrop="false">
                <div class="offcanvas-header text-white">
                    <h5>Kategóriák</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close">
                    </button>
                </div>
                <div class="offcanvas-body list-group list-group-flush">
                    <form action="" method="get">
                        <div class="row mb-5">
                            <div class="input-group">
                                <input type="text" class="form-control" name="query" placeholder="Keresés" required>
                                <button type="submit" class="btn btn-outline-warning ml-3 searchButton"
                                    data-bs-tooltip="tooltip" data-bs-placement="right" title="Kereés!"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    @foreach ($categories as $category)
                        <a class="list-group-item list-group-item-action {{ request()->is('termekek/' . $category->slug) ? 'active' : '' }}"
                            href="{{ url('/termekek/' . $category->slug) }}">{{ $category->name }}</a>
                    @endforeach

                </div>
            </div>

        </div>
    </nav>


    <div class="container-fluid  d-none d-lg-block bg-dark bg-gradient">
        <div class="container text-white ">
            <div class="row align-items-center header">

                {{-- Webshop Logó --}}
                <div class="col-12 col-lg-3">
                    <h2 class="text-center p-2 m-0">
                        Logó
                    </h2>
                    <h2 class="text-center p-2 m-0">
                        Webshop
                    </h2>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="row">

                        {{-- Kereső, telefonszám, email cím --}}
                        <div class="col-4 me-auto">
                            <div class="row mb-3">
                                <div class="col d-flex">
                                    <span class="me-auto"><i class="fas fa-phone-alt h5 me-1"></i> 06-1/123-45-67</span>
                                    <span><i class="far fa-envelope h5 me-1"></i> info@valami.hu</span>
                                </div>
                            </div>
                            <form action="" method="get">
                                <div class="row">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="query" placeholder="Keresés"
                                            required>
                                        <button type="submit" class="btn btn-outline-warning searchButton"
                                            data-bs-tooltip="tooltip" data-bs-placement="right" title="Kereés!"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Profil --}}
                        <div class="col-auto my-auto">
                            <div class="dropdown" data-bs-tooltip="tooltip" data-bs-placement="left" title="Profil!">
                                <button class="btn btn-outline-success rounded-circle" type="button" id="profilButton"
                                    data-bs-offset="-150,10">
                                    <i class="fas fa-user fa-fw"></i>
                                </button>
                                <div class="dropdown-menu py-4 profil" aria-labelledby="profilButton">

                                    @guest
                                        <form class="px-3" action="{{ url('/bejelentkezes') }}" method="post">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="login_email">Email cím</label>
                                                <input type="email" class="form-control" id="login_email" name="email"
                                                    required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="login_password">Jelszó</label>
                                                <input type="password" class="form-control" id="login_password"
                                                    name="password" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary mb-3">Bejelentkezés</button>
                                        </form>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ url('/regisztracio') }}">Nincs még fiókja?
                                            Regisztráljon!</a>
                                        <a class="dropdown-item" href="{{ url('/elfelejtett-jelszo') }}">Elfelejtette
                                            jelszavát?</a>
                                    @endguest

                                    @auth
                                        <div class="card mx-3 text-center border-0" style="width: 200px">
                                            <div class="card-header bg-white pb-3">
                                                Üdvözöljük <br><b>{{ auth()->user()->name }}</b>
                                            </div>
                                            <div class="list-group list-group-flush">
                                                <a href="{{ url('/profil') }}"
                                                    class="list-group-item list-group-item-action" aria-current="true">
                                                    Profil karbantartása
                                                </a>
                                            </div>
                                            <div class="card-footer bg-white border-top pt-3">
                                                <a href="{{ url('/kijelentkezes') }}"
                                                    class="btn btn-warning">Kijelentkezés</a>
                                            </div>
                                        </div>
                                    @endauth

                                </div>
                            </div>
                        </div>

                        {{-- Kosár --}}
                        <div class="col-auto my-auto border border-danger border-2 rounded-pill">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto h5 mb-0 user-select-none">
                                    @php
                                        $total = 0;
                                        $quantity = 0;
                                    @endphp
                                    @foreach ((array) session('cart') as $product)
                                        @php
                                            $total += $product['quantity'] * $product['price'];
                                            $quantity += $product['quantity'];
                                        @endphp
                                    @endforeach
                                    {{ number_format($total, 0, ',', ' ') }} Ft.
                                    ({{ $quantity }})
                                </div>
                                <div class="col-auto pe-0">
                                    <a id="cartButton" class="btn btn-danger rounded-circle nav-kosar"
                                        href="{{ url('/kosar') }}" data-bs-tooltip="tooltip"
                                        data-bs-placement="bottom" title="Kosaram!">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>

    </div>



    
    <div class="container">
        <div class="row mt-3 my-lg-4">
            <div class="col-12 col-lg-3">
                <div id="sideCategory" class="card shadow-lg border border-dark rounded-lg d-none d-lg-block">
                    <div class="card-header p-3 bg-dark bg-gradient text-light text-uppercase user-select-none">
                        Kategóriák
                    </div>
                    <div class="card-body btn-group-vertical p-0">

                        @foreach ($categories as $category)
                            <a class="btn {{ request()->is('termekek/' . $category->slug . '*') ? 'active' : '' }}"
                                href="{{ url('/termekek/' . $category->slug) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9 mb-3">
                <div>
                    <div id="loading">
                        <h2 class="mt-5 text-center">
                            <i class="fas fa-spinner fa-spin"></i>

                        </h2>
                    </div>
                </div>
                <div id="mainContent">

                    @yield('content')

                </div>

            </div>


        </div>

        @yield('newest')
        @yield('similar')

        <a href="/top" class="btn btn-outline-secondary" id="topButton">
            <i class="fas fa-chevron-up fa-fw"></i>
        </a>

    </div>
    <div class="container-fluid bg-dark bg-gradient p-5">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0 d-flex align-items-end justify-content-center">
                <div id="also_linkek" class="row text-center text-lg-start">

                    <div class="col-12 col-md-6">
                        <p><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}"><i
                                    class="fas fa-home fa-fw"></i> Főoldal</a></p>
                        @foreach ($menu as $key => $menu_item)
                            <p><a href="{{ url('/' . $key) }}"
                                    class="{{ request()->is($key) ? 'active' : '' }}"><i
                                        class="fas {{ $menu_item[0] }} fa-fw"></i> {{ $menu_item[1] }}</a></p>
                        @endforeach
                    </div>
                    <div class="col-12 col-md-6">
                        <p><a href="index.php?module=home">Impresszum</a></p>
                        <p><a href="index.php?module=home">Általános Szerződési Feltételek</a></p>
                        <p><a href="index.php?module=home">Adatkezelési Tájékoztató</a></p>
                        <p><a href="index.php?module=home">Nyilatkozat Elálláshoz</a></p>
                        <p><a href="index.php?module=home">Panaszkezelés</a></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                <h3 class="text-white text-center">
                    <i class="fas fa-address-book"></i> Ügyfélszolgálat
                </h3>
                <ul class="list-group">
                    <li class="list-group-item">Kecskemét</li>
                    <li class="list-group-item">Nemtudommilyen utca 2.</li>
                    <li class="list-group-item"><a href="index.php">Webshop neve</a></li>
                    <li class="list-group-item"><a href="tel:+36001234567">+36-00/123-45-67</a></li>
                    <li class="list-group-item"><a href="mailto:val@mi.hu">val@mi.hu</a></li>
                </ul>
            </div>
            <div class="col-12 col-lg-4 text-light">
                Google térkép esetleg
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e8e7489ac2.js" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('scripts/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
