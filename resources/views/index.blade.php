<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('styles/style.css') }}">
    <title>Webshop</title>
</head>

<body class="bg-light d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container px-0">

            {{-- Kategória oldalmenü gomb --}}
            <button class="btn text-white d-block d-lg-none ps-2" data-bs-toggle="offcanvas" data-bs-target="#navCategory"
                aria-controls="offcanvasExample">
                <i class="fa fa-tags" data-bs-toggle="offcanvas" href="#navCategory" aria-hidden="true"></i>
            </button>

            {{-- Navigáció sáv --}}
            <a class="navbar-brand d-block d-lg-none" href="{{ url('/') }}">Műszaki Webáruház</a>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav w-100">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }} me-3" href="{{ url('/') }}">
                        <i class="fas fa-home fa-lg fa-fw me-2"></i> Főoldal
                    </a>
                    @foreach ($menu as $key => $menu_item)
                        <a class="nav-link {{ request()->is($key) ? 'active' : '' }} me-3"
                            href="{{ url('/' . $key) }}">
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

            <div class="btn-group">
                {{-- Kosár offcanvas gomb --}}
                @php
                    $quantity = 0;
                @endphp
                @foreach ((array) $cart as $product)
                    @php
                        $quantity += $product['quantity'];
                    @endphp
                @endforeach
                <a class="btn btn-outline-danger border-0 d-block d-lg-none cartButton px-2"
                data-href="{{ url('/kosar') }}"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                <i class="fas fa-shopping-cart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark cart_quantity {{ $quantity == 0 ? "d-none" : "d-inline" }}">{{ $quantity }}</span>
                </a>
                {{-- /.Kosár offcanvas gomb --}}

                {{-- Profil gomb --}}
                <a class="btn {{ auth()->check() ? "btn-outline-light" : "btn-outline-success" }} border-0 d-block d-lg-none"
                    data-bs-toggle="{{ auth()->check() ? "offcanvas" : "modal" }}" data-bs-target="{{ auth()->check() ? "#offcanvasProfil" : "#loginModal" }}">
                        <i class="fas fa-user"></i>
                </a>
                {{-- /.Profil gomb --}}

                {{-- Főmenü oldalmenü gomb --}}
                <a class="btn text-white d-block d-lg-none px-2" data-bs-toggle="offcanvas" data-bs-target="#navMenu"
                aria-controls="offcanvasExample">
                <i class="fa fa-bars" data-bs-toggle="offcanvas" href="#navMenu" aria-hidden="true"></i>
                </a>
                {{-- /.Főmenü oldalmenü gomb --}}
            </div>

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
                    <a class="list-group-item list-group-item-dark list-group-item-action {{ request()->is('/') ? 'active' : '' }}"
                        href="{{ url('/') }}">
                        <i class="fas fa-home fa-fw"></i> Főoldal
                    </a>
                    @foreach ($menu as $key => $menu_item)
                        <a class="list-group-item list-group-item-dark list-group-item-action {{ request()->is($key) ? 'active' : '' }}"
                            href="{{ url('/' . $key) }}">
                            <i class="fas {{ $menu_item[0] }} fa-fw"></i> {{ $menu_item[1] }}
                        </a>
                    @endforeach
                    @if (auth()->check() && auth()->user()->is_admin)
                        <a class="list-group-item list-group-item-dark list-group-item-action" href="{{ url('/admin') }}">
                            <i class="fas fa-user-lock fa-lg fa-fw me-2"></i> Admin
                        </a>
                    @endif
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
                    <form action="{{ url('termekek/kereses') }}" method="get">
                        <div class="row mb-5">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" placeholder="Keresés" required>
                                <button type="submit" class="btn btn-outline-warning ml-3 searchButton"
                                    data-bs-tooltip="tooltip" data-bs-placement="right" title="Kereés!"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    @foreach ($categories as $category)
                        <a class="list-group-item list-group-item-dark list-group-item-action {{ request()->is('termekek/' . $category->slug) ? 'active' : '' }}"
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
                        Műszaki
                    </h2>
                    <h2 class="text-center p-2 m-0">
                        Webáruház
                    </h2>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="row">

                        {{-- Kereső, telefonszám, email cím --}}
                        <div class="col-6 me-auto">
                            <div class="row mb-3">
                                    <div class="col-4 me-auto">
                                        <i class="fas fa-phone-alt h5 me-1"></i> 06-1/123-45-67
                                    </div>
                                    <div class="col-8">
                                        <i class="far fa-envelope h5 me-1"></i> info@muszakiwebaruhaz.hu
                                    </div>
                            </div>
                            <form action="{{ url('termekek/kereses') }}" method="get">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="q" placeholder="Keresés"
                                                   required>
                                            <button type="submit" class="btn btn-outline-warning searchButton"
                                                    data-bs-tooltip="tooltip" data-bs-placement="right" title="Kereés!">
                                                <i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Profil --}}
                        @auth
                            <div class="col-auto my-auto border border-end-0 border-success border-2 rounded-pill me-3">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto h5 mb-0 user-select-none text-center ms-3">
                                        Üdvözöljük <br><b>{{ auth()->user()->name }}</b>
                                    </div>
                                    <div class="col-auto pe-0">
                                        <button class="btn btn-success rounded-circle" type="button" id="profilButton"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="Profil"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfil" aria-controls="offcanvasProfil">
                                            <i class="fas fa-user fa-fw"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endauth


                        @guest
                            <div class="col-auto my-auto">
                                <button class="btn btn-outline-success rounded-circle" type="button" id="profilButton"
                                    data-bs-tooltip="tooltip" data-bs-placement="top" title="Profil"
                                    data-bs-toggle="modal" data-bs-target="#loginModal">
                                        <i class="fas fa-user fa-fw"></i>
                                </button>
                            </div>
                        @endguest

                        {{-- Kosár --}}
                        <div class="col-auto my-auto border border-end-0 border-danger border-2 rounded-pill">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto h5 mb-0 user-select-none">
                                    @php
                                        $total = 0;
                                        $quantity = 0;
                                    @endphp
                                    @foreach ((array)$cart as $product)
                                        @php
                                            $total += $product['quantity'] * $product['price'];
                                            $quantity += $product['quantity'];
                                        @endphp
                                    @endforeach
                                    <span class="cart_price">{{ number_format($total, 0, ',', ' ') }}</span> Ft.
                                    (<span class="cart_quantity">{{ $quantity }}</span>)
                                </div>
                                <div class="col-auto pe-0">
                                    <a class="btn btn-danger rounded-circle nav-kosar cartButton cartButton-lg"
                                        data-href="{{ url('/kosar') }}"
                                         data-bs-tooltip="tooltip"
                                        data-bs-placement="top" title="Kosaram"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                                        <i class="fas fa-shopping-cart fa-fw"></i>
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
            <div class="col-12 col-lg-3 mb-3" id="left">
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
                @include('alerts.error')
                @include('alerts.success')
                <div id="mainContent">

                    @yield('content')

                </div>

            </div>


        </div>

        @yield('newest')
        @yield('similar')

        <a class="btn btn-outline-secondary" id="topButton">
            <i class="fas fa-chevron-up fa-fw"></i>
        </a>

    </div>
    <div class="container-fluid bg-dark bg-gradient p-5 mt-auto">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0 d-flex justify-content-center">
                <div id="also_linkek" class="row text-center text-lg-start">

                    <div class="col-12 col-md-6">
                        <p><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}"><i
                                    class="fas fa-home fa-fw"></i> Főoldal</a></p>
                        @foreach ($menu as $key => $menu_item)
                            <p><a type="button" href="{{ url('/' . $key) }}"
                                    class="{{ request()->is($key) ? 'active' : '' }}"><i
                                        class="fas {{ $menu_item[0] }} fa-fw"></i> {{ $menu_item[1] }}</a></p>
                        @endforeach
                    </div>
                    <div class="col-12 col-md-6">
                        <p><a class="info" type="button" data-href="{{ url('/impresszum') }}" data-bs-toggle="modal" data-bs-target="#infoModal">Impresszum</a></p>
                        <p><a class="info" type="button" data-href="{{ url('/aszf') }}" data-bs-toggle="modal" data-bs-target="#infoModal">Általános Szerződési Feltételek</a></p>
                        <p><a class="info" type="button" data-href="{{ url('/adatkezeles') }}" data-bs-toggle="modal" data-bs-target="#infoModal">Adatkezelési Tájékoztató</a></p>
                        <p><a class="info" type="button" data-href="{{ url('/elallas') }}" data-bs-toggle="modal" data-bs-target="#infoModal">Nyilatkozat Elálláshoz</a></p>
                        <p><a class="info" type="button" data-href="{{ url('/panaszkezeles') }}" data-bs-toggle="modal" data-bs-target="#infoModal">Panaszkezelés</a></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                <h3 class="text-white text-center">
                    <i class="fas fa-address-book"></i> Ügyfélszolgálat
                </h3>
                <ul class="list-group">
                    <li class="list-group-item">Kecskemét</li>
                    <li class="list-group-item">Fő utca 1.</li>
                    <li class="list-group-item"><a href="index.php">Műszaki Webáruház</a></li>
                    <li class="list-group-item"><a href="tel:+36001234567">+36-1/123-45-67</a></li>
                    <li class="list-group-item"><a href="info@muszakiwebaruhaz.hu">info@muszakiwebaruhaz.hu</a></li>
                </ul>
            </div>
            <div class="col-12 col-lg-4">
                <div class="map-responsive">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25935.210889796515!2d19.66699676533161!3d46.900688100187786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4743da6108f61c3f%3A0x400c4290c1e1180!2sKecskem%C3%A9t!5e0!3m2!1shu!2shu!4v1632070061119!5m2!1shu!2shu"
                        width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
        </div>
    </div>

{{-- Login Modal --}}
@guest
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                @include('auth.bejelentkezesModal')
            </div>
        </div>
    </div>
@endguest
{{-- /.Login Modal --}}

{{-- Profil offcanvas --}}
@auth
    <div class="offcanvas offcanvas-end text-center bg-dark text-light" tabindex="-1" id="offcanvasProfil" aria-labelledby="offcanvasProfilLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasProfilLabel">Profil</h5>
            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="col-12 col-lg-8 mx-lg-auto list-group list-group-flush">
                <a href="{{ url('/profil') }}"
                    class="list-group-item list-group-item-dark list-group-item-action {{ request()->is('profil') ? 'active' : '' }}"
                    aria-current="true">
                    Személyes adatok
                </a>
                <a href="{{ url('/profil/jelszo-modositas') }}"
                    class="list-group-item list-group-item-dark list-group-item-action {{ request()->is('profil/jelszo-modositas') ? 'active' : '' }}"
                    aria-current="true">
                    Jelszó módosítás
                </a>
                <a href="{{ url('/rendelesek') }}"
                    class="list-group-item list-group-item-dark list-group-item-action {{ request()->is('rendelesek') ? 'active' : '' }}"
                    aria-current="true">
                    Rendelések
                </a>
                <a href="{{ url('/eszamlak') }}"
                    class="list-group-item list-group-item-dark list-group-item-action {{ request()->is('eszamlak') ? 'active' : '' }} disabled"
                    aria-current="true">
                    Számlák (Fejlesztés alatt)
                </a>
                <a href="{{ url('/kijelentkezes') }}" class="list-group-item list-group-item-dark list-group-item-action">
                    Kijelentkezés
                </a>
            </div>
        </div>
    </div>
@endauth
{{-- /.Profil offcanvas --}}

{{-- Kosár offcanvas --}}
<div class="offcanvas offcanvas-end bg-dark text-light" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCartLabel">Kosár tartalma</h5>
        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

    </div>
</div>
{{-- /.Kosár offcanvas --}}

{{-- Email cím nincs megerősítve --}}
@if (auth()->check() && (!auth()->user()->hasVerifiedEmail() || auth()->user()->password_must_change == 1))
<div class="row justify-content-center">
    <div class="col-12 position-fixed bottom-0 start-0 bg-danger text-center py-3" style="z-index: 99;">
        @if (auth()->user()->password_must_change == 1)
            <p class="h4">Jelszavát meg kell változtatnia!</p>
            <a class="btn btn-primary mb-3" href="{{ url("/profil/jelszo-modositas") }}">
                Jelszó módosítás
            </a>
        @endif
        @if (!auth()->user()->hasVerifiedEmail())
            <p class="h4">Email címe nincs megerősítve!</p>
            <p class="h6">
                Megerősítő email újraküldése
            </p>
            <form action="{{ url('profil/email-megerosites') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary mb-3">Küldés</button>
            </form>
        @endif
    </div>
</div>
@endif
{{-- /.Email cím nincs megerősítve --}}

{{-- infoModal --}}
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fw-bold" id="infoModalLabel"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
            </div>
        </div>
    </div>
</div>
{{-- /.infoModal --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/e8e7489ac2.js" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('scripts/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
