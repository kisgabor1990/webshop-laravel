@extends('index')

@section('content')

    <h1 class="user-select-none mb-5 text-center">Adatok ellenőrzése</h1>

    <div class="position-relative m-4 user-select-none">
        <div class="progress" style="height: 30px;">
            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
        <span
            class="position-absolute top-50 translate-middle circle text-primary border border-primary border-5 rounded-circle"
            style="left: 25%;">1</span>
        <span
            class="position-absolute top-50 translate-middle circle text-primary border border-primary border-5 rounded-circle"
            style="left: 50%;">2</span>
        <span
            class="position-absolute top-50 translate-middle circle text-primary border border-primary border-5 rounded-circle"
            style="left: 75%;">3</span>
        <span
            class="position-absolute top-50 translate-middle circle text-primary border border-primary border-5 rounded-circle"
            style="left: 100%;">4</span>
    </div>
    <div class="position-relative m-4 d-none d-lg-block">
        <span class="position-absolute top-50 translate-middle" style="left: 25%;">Adatok megadása</span>
        <span class="position-absolute top-50 translate-middle" style="left: 50%;">Fizetés és szállítás</span>
        <span class="position-absolute top-50 translate-middle" style="left: 75%;">Adatok ellenőrzése</span>
        <span class="position-absolute top-50 translate-middle text-nowrap" style="left: 100%;">Megrendelés elküldése</span>
    </div>

        <div class="card mb-5" style="margin-top: 6rem;">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Köszönjük rendelését!
            </div>
            <div class="card-body py-3">
                <p class="text-center">
                    A megrendelés száma: <span class="text-primary fw-bold fs-4">{{ str_pad($order->id, 6, "0", STR_PAD_LEFT) }}</span>
                </p>
                
            </div>
        </div>

@endsection
