<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ URL::asset('styles/style.css') }}">
        <title>Webshop</title>
    </head>
    <body class="bg-light">
        <div class="container-fluid top-bar sticky-top">

            <div class="container">
                <div class="col-12 text-white text-center d-block d-lg-none">
                    <h2 class="p-2 m-0">
                        Logó Webshop
                    </h2>
                </div>
                <nav class="navbar navbar-expand-lg navbar-dark px-0">
                    <!--<a class="navbar-brand d-block d-lg-none" href="#">Menü</a>-->
                    <button class="navbar-toggler sidenavButton" type="button" data-id="sidenavCategory">
                        <span class="navbar-toggler-icon"></span> Kategóriák
                    </button>
                    <button class="navbar-toggler sidenavButton" type="button" data-id="sidenavMenu">
                        Menü <span class="navbar-toggler-icon"></span>
                    </button>

                    <div id="sidenavCategory" class="sidenav sidenav-left">
                        <a href="javascript:void(0)" class="closebtn closebtn-right">&times;</a>
                        <h2>Kategóriák</h2>
                        <!--                        {foreach $categories as $category}
                                                <a class="btn nav-category{$category.id}" href="index.php?module=products&category_id={$category.id}">{$category.name}</a>
                                                {/foreach}-->
                        Kategóriák

                    </div>
                    <div id="sidenavMenu" class="sidenav sidenav-right">
                        <a href="javascript:void(0)" class="closebtn closebtn-left">&times;</a>
                        <h2>Menü</h2>
                        <a class="nav-link nav-home" href="/"><i class="fas fa-home"></i> Főoldal</a>
                        <a class="nav-link nav-rolunk" href="/rolunk">Rólunk</a>
                        <a class="nav-link nav-garancia" href="/garancia">Garancia</a>
                        <a class="nav-link nav-rendeles_menete" href="/rendeles_menete">Rendelés menete</a>
                        <a class="nav-link nav-kapcsolat" href="/kapcsolat">Kapcsolat</a>
                        <a class="nav-link nav-kosar" href="/kosar">Kosár</a>

                        <form action="index.php?module=search" class="form-inline m-4" method="get">
                            <input type="hidden" name="module" value="search">
                            <div class="input-group w-100">

                                <input type="text" class="form-control" name="query" placeholder="kulcsszó" required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-warning"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="collapse navbar-collapse" id="navbar">

                        <ul class="navbar-nav mr-auto text-white">
                            <li class="nav-item"><a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{ url('/') }}"><i class="fas fa-home fa-fw"></i> Főoldal</a></li>
                            @foreach ($menu as $key => $menu_item)
                            <li class="nav-item"><a class="nav-link {{ (request()->is($key)) ? 'active' : '' }}" href="{{ url('/' . $key) }}"><i class="fas {{ $menu_item[0] }} fa-fw"></i> {{ $menu_item[1] }}</a></li>
                            @endforeach
                        </ul>

                    </div>
                </nav>
            </div>
        </div>
        <div class="container-fluid header d-none d-lg-block bg-dark ">
            <div class="container text-white pt-3">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <h2 class="text-center bg-dark p-2 m-0">
                            Logó
                        </h2>
                        <h2 class="text-center bg-dark p-2 m-0">
                            Webshop
                        </h2>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <div class="row my-3">
                                    <div class="col">
                                        <i class="fas fa-phone-alt"></i><span class="ml-1 mr-3"> 06-1/123-45-67</span>
                                        <i class="far fa-envelope"></i><span class="ml-1 mr-3"> info@valami.hu</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <form action="index.php?module=search" class="form-inline" method="get">
                                            <input type="hidden" name="module" value="search">
                                            <div class="form-row">
                                                <div class="col-auto">
                                                    <input type="text" class="form-control mr-3" name="query" placeholder="Keresés" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-auto">
                                                    <button type="submit" id="searchButton" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="right" title="Kereés!"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end">

                                <div class="row align-items-center justify-content-between ml-2 border rounded-pill cart">

                                    <div class="col-auto">
                                        100000 Ft. (0)
                                    </div>
                                    <div class="col-4 pl-0">
                                        <a id="cartButton" class="btn btn-success rounded-circle nav-kosar" href="{{ url('/kosar') }}" data-tooltip="tooltip" data-placement="bottom" title="Kosaram!">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown ml-5">
                                    <button class="btn btn-outline-success rounded-circle" type="button" id="profilButton" data-toggle="dropdown" data-tooltip="tooltip" data-placement="right" title="Profil!" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user fa-fw"></i>
                                    </button>
                                    <div class="dropdown-menu py-3 profil" aria-labelledby="profilButton">

                                        @guest
                                        @include('alerts.error')
                                        <form class="px-4" action="{{ url('/bejelentkezes') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="login_email">Email cím</label>
                                                <input type="email" class="form-control" id="login_email" name="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="login_password">Jelszó</label>
                                                <input type="password" class="form-control" id="login_password" name="password">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Bejelentkezés</button>
                                        </form>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ url('/regisztracio') }}">Nincs még fiókja? Regisztráljon!</a>
                                        <a class="dropdown-item" href="{{ url('/elfelejtett-jelszo') }}">Elfelejtette jelszavát?</a>
                                        @endguest

                                        @auth
                                        <div class="card mx-3 text-center border-0" style="width: 200px">
                                            <div class="card-header bg-white mb-3">
                                                Üdvözöljük <br><b>{{ auth()->user()->billing_name }}</b>
                                            </div>
                                            <div class="list-group list-group-flush">
                                                <a href="{{ url('/profil') }}" class="list-group-item list-group-item-action" aria-current="true">
                                                    Profil karbantartása
                                                </a>
                                            </div>
                                            <div class="card-footer bg-white border-top mt-3">
                                                <a href="{{ url('/kijelentkezes') }}" class="btn btn-warning">Kijelentkezés</a>
                                            </div>
                                        </div>

                                        @endauth

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
                        <div class="card-header p-3 bg-dark text-light text-uppercase user-select-none">
                            Kategóriák
                        </div>
                        <div class="card-body btn-group-vertical p-0">

                            @foreach ($categories as $category)
                            <a class="btn {{ (request()->is('termekek/'.$category->slug)) ? 'active' : '' }}" href="{{ url('/termekek/' . $category->slug) }}">{{ $category->name }}</a>
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

            <button id="topButton" title="Az oldal tetejére!"><i class="far fa-arrow-alt-circle-up"></i></button>

        </div>
        <div class="container-fluid bg-dark p-5">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0 d-flex align-items-end justify-content-center">
                    <div id="also_linkek" class="row text-center text-lg-left">

                        <div class="col-12 col-md-6">
                            <p><a href="{{ url('/') }}" class="{{ (request()->is('/')) ? 'active' : '' }}"><i class="fas fa-home fa-fw"></i> Főoldal</a></p>
                            @foreach ($menu as $key => $menu_item)
                            <p><a href="{{ url('/' . $key) }}" class="{{ (request()->is($key)) ? 'active' : '' }}"><i class="fas {{ $menu_item[0] }} fa-fw"></i> {{ $menu_item[1] }}</a></p>
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/e8e7489ac2.js" crossorigin="anonymous"></script>
        <script src="{{ URL::asset('scripts/app.js') }}"></script>
    </body>
</html>