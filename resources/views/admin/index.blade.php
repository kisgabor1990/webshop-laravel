<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop Admin felület</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('styles/style.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand me-5" href="{{ url('admin/dashboard') }}">Webshop Admin felület</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <div class="navbar-nav">
                    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }} me-3"
                        aria-current="page" href="{{ url('admin/dashboard') }}"><i
                            class="fa fa-dashboard fa-lg fa-fw me-2" aria-hidden="true"></i> Dashboard</a>
                    <a class="nav-link {{ request()->is('admin/felhasznalok') ? 'active' : '' }} me-3"
                        aria-current="page" href="{{ url('admin/felhasznalok') }}"><i
                            class="fa fa-user fa-lg fa-fw me-2" aria-hidden="true"></i> Felhasználók</a>
                    <a class="nav-link {{ request()->is('admin/kategoriak') ? 'active' : '' }} me-3"
                        aria-current="page" href="{{ url('admin/kategoriak') }}"><i
                            class="fa fa-tags fa-lg fa-fw me-2" aria-hidden="true"></i>
                        Kategóriák</a>
                    <a class="nav-link {{ request()->is('admin/termekek') ? 'active' : '' }} me-3" aria-current="page"
                        href="{{ url('admin/termekek') }}"><i class="fas fa-store fa-lg fa-fw me-2"
                            aria-hidden="true"></i>
                        Termékek</a>
                    <a class="nav-link {{ request()->is('admin/rendelesek') ? 'active' : '' }} me-3"
                        aria-current="page" href="{{ url('admin/rendelesek') }}"><i
                            class="fas fa-clipboard-list fa-lg fa-fw me-2"></i>
                        Rendelések</a>
                    <a class="nav-link" aria-current="page" href="{{ url('/home') }}"><i
                            class="fa fa-sign-out fa-lg fa-fw me-2" aria-hidden="true"></i> Kilépés</a>

                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
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
                    <p>
                        Ez a művelet visszavonhatatlan!
                    </p>
                    <p class="mb-0">A felhasználó:</p>
                    <ul>
                        <li>Neve: <span class="name fw-bold"></span></li>
                        <li>E-mail címe: <span class="email fw-bold"></span></li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/e8e7489ac2.js" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('scripts/app.js') }}"></script>
</body>

</html>
