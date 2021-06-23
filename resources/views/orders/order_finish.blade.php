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

        <div class="card mb-5" style="margin-top: 6rem;">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Ez megy majd emailbe
            </div>
            <div class="card-body py-3 text-center">
                <p class="fw-bold fs-5">Kedves {{ $order->customer->name }}!</p> 
                <p>Köszönjük rendelésed! Hamarosan elkezdjük a feldolgozását, melyről újabb email üzenetet kapsz.</p>
                <p class="fw-bold fs-5 mt-5 mb-0">Rendelés azonosítód:</p>
                <p class="fw-bold fs-4 text-primary">{{ str_pad($order->id, 6, "0", STR_PAD_LEFT) }}</p>
                <p class="fw-bold fs-5 mt-5 mb-3">Rendelés részletei:</p>
                <div class="row text-start">
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-4 text-end pe-0">
                                <i class="far fa-calendar fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-8">
                                <p class="fw-bold mb-0">Rendelés dátuma:</p>
                                <p>{{ $order->created_at }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-4 text-end pe-0">
                                <i class="fas fa-piggy-bank fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-8">
                                <p class="fw-bold mb-0">Fizetési mód:</p>
                                <p>{{ $order->payment }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-4 text-end pe-0">
                                <i class="fas fa-map-marker-alt fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-8">
                                <p class="fw-bold mb-0">Átvétel helye:</p>
                                <p>{{ $order->shipping->address->zip }} {{ $order->shipping->address->city }}, {{ $order->shipping->address->address }} {{ $order->shipping->address->address2 }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-4 text-end pe-0">
                                <i class="fas fa-people-carry fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-8">
                                <p class="fw-bold mb-0">Átvétel módja:</p>
                                <p>{{ $order->shipping_mode }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="fw-bold fs-5 mt-5 mb-3">Termékek:</p>
                @php
                    $subtotal = 0;
                @endphp
                @foreach ($order->products as $product)
                    @php
                        $subtotal += $product->pivot->price * $product->pivot->quantity
                    @endphp
                    <div class="col-4 col-lg-2 offset-4 offset-lg-5 mt-5"><img src="{{ url($product->coverImage()->path) }}" alt="{{ $product['name'] }}" class="img-fluid"></div>
                    <p class="fs-5">{{ $product->pivot->quantity }} db.</p>
                    <p class="mb-0">{{ $product->pivot->product_name }}</p>
                    <p class="fw-bold fs-4 text-primary">{{ number_format($product->pivot->price, 0, ',', ' ') }} Ft.</p>
                @endforeach
                <hr>
                <p>Részösszeg: <span class="fw-bold fs-5 text-primary">{{ number_format($subtotal, 0, ',', ' ') }} Ft.</span></p>
                <p>Szállítás: <span class="fw-bold fs-5 text-primary">{{ number_format($order->shipping_price, 0, ',', ' ') }} Ft.</span></p>
                <p class="fw-bold fs-5">Összesen: <span class="fw-bold fs-5 text-primary">{{ number_format($order->shipping_price + $subtotal, 0, ',', ' ') }} Ft.</span></p>
                
            </div>
        </div>

@endsection
