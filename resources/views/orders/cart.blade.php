@extends('index')

@section('content')

<h1 class="text-center user-select-none mb-5">Kosár</h1>

<div id="cart_header" class="row fw-bold mb-3 d-none d-lg-flex align-items-center">
    <div class="col-12 col-lg-5 offset-lg-1">
        Név
    </div>
    <div class="col-6 col-lg-5 text-center">
        <div class="row align-items-center">
            <div class="col-12 col-lg-4 px-0">
                Bruttó ár
            </div>
            <div class="col-12 col-lg-4 px-0">
                Mennyiség
            </div>
            <div class="col-12 col-lg-4 px-0">
                Bruttó ár összesen
            </div>
        </div>
    </div>
</div>
<hr>

@php
    $total = 0;
@endphp
<div id="products">
    @foreach ($cart as $id => $product)
    @php
        $total += $product['price'] * $product['quantity'];
    @endphp
    <div class="row align-items-center product{{ $id }}">
        <div class="col-4 col-lg-1">
            <img src="{{ url($product['image']) }}" alt="{{ $product['name'] }}" class="img-fluid">
        </div>
        <div class="col-12 col-lg-5 order-first order-lg-0 mb-3 mb-lg-0">
            <a href="{{ url('termek/' . $product['slug']) }}" class="text-decoration-none text-reset">{{ $product['name'] }}</a>
        </div>
        <div class="col-8 col-lg-5 text-lg-center">
            <div class="row align-items-center">
                <div class="col-12 col-lg-4 ">
                    <div class="row align-items-center">
                        <div class="col-5 d-lg-none text-end px-0">
                            Bruttó ár:
                        </div>
                        <div class="col-7 col-lg-12">
                            {{ number_format($product['price'], 0, ',', ' ') }} Ft.
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 ">
                    <div class="row align-items-center">
                        <div class="col-5 d-lg-none text-end px-0">
                            Mennyiség:
                        </div>
                        <div class="col-7 col-lg-12">
                            <div class="input-group">
                                <a class="btn btn-danger fw-bold px-2 cart-decrease" data-id="{{ $id }}" data-href="{{ url('/kosar/'. $id . '/kevesebb') }}" role="button"><i
                                        class="fas fa-minus"></i></a>
                                <input type="text" class="form-control fw-bold text-center px-2"
                                    aria-label="Quantity" value="{{ $product['quantity'] }}" disabled>
                                <a class="btn btn-primary fw-bold px-2 cart-increase" data-id="{{ $id }}" data-href="{{ url('/kosar/'. $id . '/tobb') }}" role="button"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="row align-items-center">
                        <div class="col-5 d-lg-none fw-bold text-end lh-1 px-0">
                            Bruttó ár összesen:
                        </div>
                        <div class="col-7 col-lg-12 fw-bold">
                            <span class="product_total_price">{{ number_format($product['price'] * $product['quantity'], 0, ',', ' ') }}</span> Ft.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-1 text-end">
            <a class="btn btn-danger fw-bold px-2 removeFromCart" data-id="{{ $id }}" data-href="{{ url('/kosar/'. $id . '/torles') }}" role="button"><i
                class="fas fa-trash-alt"></i></a>
        </div>
    </div>
    <hr class="product{{ $id }}">
    @endforeach
</div>
<hr>
<div id="cart_footer">
    <div class="row mt-5 mb-3">
        <div class="col-12 col-lg-6 offset-lg-6">
            <div class="row fw-bold align-items-center">
                <div class="col-6 col-lg-8 fs-5 text-end text-uppercase">
                    Összesen (bruttó):
                </div>
                <div class="col-6 col-lg-4 fs-5 text-end">
                    <span class="cart_price">{{ number_format($total, 0, ',', ' ') }}</span> Ft.
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-lg-6 offset-lg-6">
            <div class="row fw-bold align-items-center">
                <div class="col-6 col-lg-8 fs-5 text-end text-uppercase">
                    Szállítási költség:
                </div>
                <div class="col-6 col-lg-4 fs-5 text-end">
                    {{ number_format(session('customer.shipping_price'), 0, ',', ' ') }} Ft.
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-lg-6 offset-lg-6">
            <div class="row fw-bold text-primary align-items-center">
                <div class="col-6 col-lg-8 fs-4 text-end text-uppercase">
                    Végösszeg:
                </div>
                <div class="col-6 col-lg-4 fs-4 text-end">
                    <span class="cart_total_price">{{ number_format($total + session('customer.shipping_price'), 0, ',', ' ') }}</span> Ft.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center my-5" id="orderButtonDiv">
    <a class="btn btn-dark btn-lg px-5" href="{{ url('/megrendeles') }}" role="button">Megrendelés</a>
</div>
    
@endsection