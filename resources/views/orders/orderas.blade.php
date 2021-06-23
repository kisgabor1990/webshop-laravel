@extends('index')

@section('content')

<h1 class="text-center user-select-none mb-5">Megrendelés</h1>

<div class="row justify-content-center my-5 user-select-none">
    <div class="col-12 col-lg-10">
        <div class="row">
            <div class="col-12 col-lg-6 mb-5">
                <div class="card">
                    <div class="card-header text-center bg-dark text-white">
                        Visszatérő vásárló?
                    </div>
                    <div class="card-body text-center">
                        <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#loginModal" role="button">Bejelentkezés</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header text-center bg-dark text-white">
                        Új vásárló?
                    </div>
                    <div class="card-body">
                        <p class="text-center text-uppercase fw-bold">
                            Regisztráció előnyei:
                        </p>
                        <ul>
                            <li>Visszatérve gyorsabban tud vásárolni</li>
                            <li>Nyomonkövetheti a rendelését</li>
                            <li>Bárhonnan kezelheti kosarát</li>
                        </ul>
                        <div class="d-grid gap-2 mt-5">
                            <a class="btn btn-dark" href="{{ url('/megrendeles/regisztracio') }}" role="button">Regisztráció</a>
                            <a class="btn btn-dark" href="{{ url('/megrendeles/adatok') }}" role="button">Regisztráció nélkül vásárolok</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection