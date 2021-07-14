@extends('index')

@section('content')

    <h1 class="user-select-none mb-5 text-center">Adatok ellenőrzése</h1>

    <div class="position-relative m-4 user-select-none">
        <div class="progress" style="height: 30px;">
            <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
        <a href="{{ url('megrendeles/adatok') }}"
            class="position-absolute top-50 translate-middle py-0 btn btn-outline-primary circle border border-primary border-5 rounded-circle"
            style="left: 25%;">1</a>
        <a href="{{ url('megrendeles/fizetes-es-szallitas') }}"
            class="position-absolute top-50 translate-middle py-0 btn btn-outline-primary circle border border-primary border-5 rounded-circle"
            style="left: 50%;">2</a>
        <span
            class="position-absolute top-50 translate-middle circle text-primary border border-primary border-5 rounded-circle"
            style="left: 75%;">3</span>
        <span
            class="position-absolute top-50 translate-middle circle text-secondary border border-200 border-5 rounded-circle"
            style="left: 100%;">4</span>
    </div>
    <div class="position-relative m-4 d-none d-lg-block">
        <span class="position-absolute top-50 translate-middle" style="left: 25%;">Adatok megadása</span>
        <span class="position-absolute top-50 translate-middle" style="left: 50%;">Fizetés és szállítás</span>
        <span class="position-absolute top-50 translate-middle" style="left: 75%;">Adatok ellenőrzése</span>
        <span class="position-absolute top-50 translate-middle text-nowrap" style="left: 100%;">Megrendelés elküldése</span>
    </div>
    <form class="needs-validation" action="{{ url('/megrendeles/ellenorzes') }}" method="post" novalidate>
        @csrf
        <div class="card mb-5" style="margin-top: 6rem;">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Kapcsolattartó adatok <span class="text-primary fw-bold ms-3"><a href="{{ url('/megrendeles/adatok') }}"><i class="fa fa-edit" aria-hidden="true"></i></a></span>
            </div>
            <div class="card-body py-3">
                <div class="col-12 col-lg-10 offset-lg-1 text-center">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                                <div class="col">Név</div>
                                <div class="col fw-bold mt-1">{{ session('customer.name') }}</div>
                        </div>
                        <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                                <div class="col">E-mail</div>
                                <div class="col fw-bold mt-1">{{ session('customer.email') }}</div>
                        </div>
                        <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                                <div class="col">Telefonszám</div>
                                <div class="col fw-bold mt-1">+36{{ session('customer.phone') }}</div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-group col-12 col-lg-6">
                <div class="card mb-5">
                    <div class="card-header text-center text-uppercase bg-dark text-white">
                        Számlázási adatok <span class="text-primary fw-bold ms-3"><a href="{{ url('/megrendeles/adatok') }}"><i class="fa fa-edit" aria-hidden="true"></i></a></span>
                    </div>
                    <div class="card-body py-3">
                        <div class="col-12 col-lg-10 offset-lg-1">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="col-6 text-end">Név:</td>
                                        <td class="col-6 fw-bold">{{ session('customer.billing_name') }}</td>
                                    </tr>
                                    @if (session('customer.taxnum'))
                                    <tr>
                                        <td class="text-end">Adószám:</td>
                                        <td class="fw-bold">{{ session('customer.taxnum') }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="text-end">Irányítószám:</td>
                                        <td class="fw-bold">{{ session('customer.billing_zip') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">Település:</td>
                                        <td class="fw-bold">{{ session('customer.billing_city') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">Utca, házszám:</td>
                                        <td class="fw-bold">{{ session('customer.billing_address') }}</td>
                                    </tr>
                                    @if (session('customer.billing_address2'))
                                    <tr>
                                        <td class="text-end">Emelet, ajtó:</td>
                                        <td class="fw-bold">{{ session('customer.billing_address2') }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-group col-12 col-lg-6">
                <div class="card mb-5">
                    <div class="card-header text-center text-uppercase bg-dark text-white">
                        Szállítási adatok <span class="text-primary fw-bold ms-3"><a href="{{ url('/megrendeles/adatok') }}"><i class="fa fa-edit" aria-hidden="true"></i></a></span>
                    </div>
                    <div class="card-body py-3">
                        <div class="col-12 col-lg-10 offset-lg-1">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="col-6 text-end">Név:</td>
                                        <td class="col-6 fw-bold">{{ session('customer.shipping_name') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">Irányítószám:</td>
                                        <td class="fw-bold">{{ session('customer.shipping_zip') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">Település:</td>
                                        <td class="fw-bold">{{ session('customer.shipping_city') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">Utca, házszám:</td>
                                        <td class="fw-bold">{{ session('customer.shipping_address') }}</td>
                                    </tr>
                                    @if (session('customer.shipping_address2'))
                                    <tr>
                                        <td class="text-end">Emelet, ajtó:</td>
                                        <td class="fw-bold">{{ session('customer.shipping_address2') }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-5">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Termékek <span class="text-primary fw-bold ms-3"><a href="{{ url('/megrendeles/kosar') }}"><i class="fa fa-edit" aria-hidden="true"></i></a></span>
            </div>
            <div class="card-body py-3">
                    <div class="row fw-bold mb-3 d-none d-lg-flex align-items-center">
                        <div class="col-12 col-lg-6 offset-lg-1">
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
                    @foreach ($cart as $product)
                    @php
                        $total += $product['price'] * $product['quantity'];
                    @endphp
                    <div class="row align-items-center">
                        <div class="col-4 col-lg-1">
                            <img src="{{ url($product['image']) }}" alt="{{ $product['name'] }}" class="img-fluid">
                        </div>
                        <div class="col-12 col-lg-6 order-first order-lg-0 mb-3 mb-lg-0">
                            {{ $product['name'] }}
                        </div>
                        <div class="col-8 col-lg-5 text-lg-center">
                            <div class="row">
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
                                            {{ $product['quantity'] }} db.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 ">
                                    <div class="row align-items-center">
                                        <div class="col-5 d-lg-none fw-bold text-end lh-1 px-0">
                                            Bruttó ár összesen:
                                        </div>
                                        <div class="col-7 col-lg-12  fw-bold">
                                            {{ number_format($product['price'] * $product['quantity'], 0, ',', ' ') }} Ft.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    <hr>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-6 offset-lg-6">
                            <div class="row fw-bold align-items-center">
                                <div class="col-6 col-lg-6 fs-5 text-end text-uppercase">
                                    Összesen<span class="d-none d-lg-inline"> (bruttó)</span>:
                                </div>
                                <div class="col-6 col-lg-6 fs-5 text-end">
                                    {{ number_format($total, 0, ',', ' ') }} Ft.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-6 offset-lg-6">
                            <div class="row fw-bold align-items-center">
                                <div class="col-6 col-lg-6 fs-5 text-end text-uppercase">
                                    Szállítás<span class="d-none d-lg-inline">i költség</span>:
                                </div>
                                <div class="col-6 col-lg-6 fs-5 text-end">
                                    {{ number_format(session('customer.shipping_price'), 0, ',', ' ') }} Ft.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-6 offset-lg-6">
                            <div class="row fw-bold text-primary align-items-center">
                                <div class="col-6 col-lg-6 fs-4 text-end text-uppercase">
                                    Végösszeg:
                                </div>
                                <div class="col-6 col-lg-6 fs-4 text-end">
                                    {{ number_format($total + session('customer.shipping_price'), 0, ',', ' ') }} Ft.
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="card-group col-12 col-lg-6">
                <div class="card mb-5">
                    <div class="card-header text-center text-uppercase bg-dark text-white">
                        Fizetési mód <span class="text-primary fw-bold ms-3"><a href="{{ url('/megrendeles/fizetes-es-szallitas') }}"><i class="fa fa-edit" aria-hidden="true"></i></a></span>
                    </div>
                    <div class="card-body py-3 fw-bold">
                        {{ session('customer.payment') }}
                    </div>
                </div>
            </div>
            <div class="card-group col-12 col-lg-6">
                <div class="card mb-5">
                    <div class="card-header text-center text-uppercase bg-dark text-white">
                        Szállítási mód <span class="text-primary fw-bold ms-3"><a href="{{ url('/megrendeles/fizetes-es-szallitas') }}"><i class="fa fa-edit" aria-hidden="true"></i></a></span>
                    </div>
                    <div class="card-body py-3 fw-bold">
                        {{ session('customer.shipping_mode') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-5">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Megjegyzés
            </div>
            <div class="card-body py-3">
                <div class="form-group p-3">
                    <textarea id="comment" name="comment" rows="5" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="col-12 mb-5 bg-white text-center">
            A megrendelés elküldésével elfogadom az <a class="info" role="button" data-href="{{ url('/aszf') }}" data-bs-toggle="modal"
            data-bs-target="#infoModal">Általános szerződési feltételek</a>et és az <a class="info"
            role="button" data-href="{{ url('/adatkezeles') }}" data-bs-toggle="modal"
            data-bs-target="#infoModal">Adatkezelési tájékoztató</a>t.<br>
            Tudomásul veszem, hogy a megrendelés elküldése fizetési kötelezettséggel jár.
        </div>
        
        
        <div class="col-12 mb-5 d-flex justify-content-between">
            <a href="{{ url('/megrendeles/fizetes-es-szallitas') }}" class="btn btn-secondary">Vissza</a>
            <button type="submit" class="btn btn-dark">Megrendel</button>
        </div>
    </form>

@endsection
