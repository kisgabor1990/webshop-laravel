<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop Admin felület</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('styles/style.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand me-5" href="{{ url('admin/dashboard') }}">Webshop Admin felület</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav w-100">
                    <li class="nav-item me-xxl-3">
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }} "
                            aria-current="page" href="{{ url('admin/dashboard') }}"><i
                                class="fa fa-dashboard fa-lg fa-fw me-xxl-2" aria-hidden="true"></i> Dashboard</a>
                    </li>
                    <li class="nav-item dropdown me-xxl-3">
                        <a class="nav-link dropdown-toggle {{ request()->is('admin/felhasznalok*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user fa-lg fa-fw me-xxl-2" aria-hidden="true"></i> Felhasználók
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                          <li>
                                <a class="dropdown-item {{ request()->is('admin/felhasznalok*') ? 'active' : '' }}" 
                                    href="{{ url('admin/felhasznalok') }}">
                                        Felhasználók
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item {{ request()->is('admin/szamlazasi-cimek*') ? 'active' : '' }}" href="{{ url('admin/szamlazasi-cimek') }}">Számlázási címek</a></li>
                          <li><a class="dropdown-item {{ request()->is('admin/szallitasi-cimek*') ? 'active' : '' }}" href="{{ url('admin/szallitasi-cimek') }}">Szállítási címek</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown me-xxl-3">
                        <a class="nav-link dropdown-toggle {{ request()->is('admin/kategoriak*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-tags fa-lg fa-fw me-xxl-2" aria-hidden="true"></i>
                            Kategóriák
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                          <li>
                                <a class="dropdown-item {{ request()->is('admin/kategoriak*') ? 'active' : '' }}" 
                                    href="{{ url('admin/kategoriak') }}">
                                        Kategóriák
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item {{ request()->is('admin/gyartok*') ? 'active' : '' }}" href="{{ url('admin/gyartok') }}">Gyártók</a></li>
                          <li><a class="dropdown-item {{ request()->is('admin/tulajdonsagok*') ? 'active' : '' }}" href="{{ url('admin/tulajdonsagok') }}">Tulajdonságok</a></li>
                        </ul>
                    </li>
                    <li class="nav-item me-xxl-3">
                        <a class="nav-link {{ request()->is('admin/termekek*') ? 'active' : '' }} " aria-current="page"
                            href="{{ url('admin/termekek') }}"><i class="fas fa-store fa-lg fa-fw me-xxl-2"
                                aria-hidden="true"></i>
                            Termékek</a>
                    </li>
                    <li class="nav-item me-auto">
                        <a class="nav-link {{ request()->is('admin/rendelesek*') ? 'active' : '' }}"
                            aria-current="page" href="{{ url('admin/rendelesek') }}"><i
                                class="fas fa-clipboard-list fa-lg fa-fw me-xxl-2"></i>
                            Rendelések</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('/home') }}"><i
                                class="fa fa-sign-out fa-lg fa-fw me-xxl-2" aria-hidden="true"></i> Kilépés</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    

    <div class="container my-5" id="maincontent">
        @yield('content')
    </div>

    <div class="modal" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">A <span class="modal_header"></span> törlésére készül.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="h3">
                        Biztos akarja?
                    </p>
                    <p class="mb-0">A <span class="modal_header"></span> adatai:</p>
                    <ul>
                        <li>ID: <span class="id fw-bold"></span></li>
                        <li>Név: <span class="name fw-bold"></span></li>
                        @if (request()->is('admin/felhasznalok'))
                            <li>E-mail cím: <span class="email fw-bold"></span></li>
                        @endif
                        @if (request()->is('admin/szamlazasi-cimek') || request()->is('admin/szallitasi-cimek'))
                            <li>Cím: <span class="address fw-bold"></span></li>
                            <li>Felhasználó: <span class="user fw-bold"></span></li>
                        @endif
                        @if (request()->is('admin/termekek'))
                            <li>Gyártó: <span class="brand fw-bold"></span></li>
                            <li>Kategória: <span class="category fw-bold"></span></li>
                        @endif
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
                    <a href="#" data-href="" class="btn btn-danger delete">TÖRLÉS</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e8e7489ac2.js" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('scripts/jquery.ui.touch-punch.js') }}"></script>
    <script src="{{ URL::asset('scripts/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
