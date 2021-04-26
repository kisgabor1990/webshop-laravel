<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop Admin felület</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('admin/dashboard') }}">Admin felület</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu"
                    aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <div class="navbar-nav">
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" aria-current="page"
                            href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard fa-lg fa-fw"
                                aria-hidden="true"></i> Dashboard</a>
                        <a class="nav-link {{ request()->is('admin/felhasznalok') ? 'active' : '' }}"
                            aria-current="page" href="{{ url('admin/felhasznalok') }}"><i
                                class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i> Felhasználók</a>
                        <a class="nav-link {{ request()->is('admin/kategoriak') ? 'active' : '' }}" aria-current="page"
                            href="{{ url('admin/kategoriak') }}"><i class="fa fa-tags fa-lg fa-fw"
                                aria-hidden="true"></i> Kategóriák</a>
                        <a class="nav-link {{ request()->is('admin/termekek') ? 'active' : '' }}" aria-current="page"
                            href="{{ url('admin/termekek') }}"><i class="fas fa-store fa-lg fa-fw"
                                aria-hidden="true"></i> Termékek</a>
                        <a class="nav-link {{ request()->is('admin/rendelesek') ? 'active' : '' }}"
                            aria-current="page" href="{{ url('admin/rendelesek') }}"><i
                                class="fas fa-clipboard-list fa-lg fa-fw"></i> Rendelések</a>
                        <a class="nav-link" aria-current="page" href="{{ url('/home') }}"><i
                                class="fa fa-sign-out fa-lg fa-fw" aria-hidden="true"></i> Kilépés</a>

                    </div>
                </div>
            </div>
        </nav>

    <div class="container my-5">
        <div class="row row-cols-md-2 row-cols-xxl-4 justify-content-center">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/e8e7489ac2.js" crossorigin="anonymous"></script>
</body>

</html>
