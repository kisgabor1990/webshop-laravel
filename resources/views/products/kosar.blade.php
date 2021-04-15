@extends('index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-8">
            @php $total = 0; @endphp
            @if (session('cart'))
                <hr class="mt-0 mb-5">
                @foreach (session('cart') as $id => $product)
                    @php
                        $total += $product['price'] * $product['quantity'];
                    @endphp
                    <div class="row shadow">
                        <div class="col-12 col-lg-3 pe-0 my-3 text-center">
                            <img src="https://via.placeholder.com/140x200/DDDDDD/808080?text=Kép+termékről" alt="">
                        </div>
                        <div class="col-12 col-lg-6 my-4 d-flex flex-column">
                            <div class="col-12 mb-auto h5">{{ $product['name'] }}</div>
                            <div class="col-12 d-flex mt-3">
                                <div class="col-4 me-auto me-lg-3">
                                    <div class="input-group">
                                        <a class="btn btn-danger fw-bold px-2" href="{{ url('/kosar/'. $id . '/kevesebb') }}" role="button"><i
                                                class="fas fa-minus"></i></a>
                                        <input type="text" class="form-control fw-bold text-center px-2"
                                            aria-label="Quantity" value="{{ $product['quantity'] }}" disabled>
                                        <a class="btn btn-primary fw-bold px-2" href="{{ url('/kosar/'. $id . '/tobb') }}" role="button"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="col-2 text-end">
                                    <a class="btn btn-danger fw-bold px-2" href="{{ url('/kosar/'. $id . '/torles') }}" role="button"><i
                                            class="fas fa-trash-alt"></i></a>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 mt-4 text-center h4">
                            {{ number_format($product['price'] * $product['quantity'], 0, ',', ' ') }} Ft.
                        </div>
                    </div>
                    <hr class="my-5">
                @endforeach
            @else
                <p class="h3">A kosár üres!</p>
            @endif
        </div>
        <div class="col-11 col-lg-3 offset-1 mt-5 mt-lg-0">
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th colspan="2" class="h3 user-select-none">Kosaram</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row" class="user-select-none">Összeg</td>
                        <td class="text-end fw-bold">{{ number_format($total, 0, ',', ' ') }} Ft.</td>
                    </tr>
                    <tr>
                        <td scope="row" class="user-select-none">Szállítás</td>
                        <td class="text-end fw-bold">0 Ft.</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="user-select-none">Végösszeg</th>
                        <td class="text-end fw-bold">{{ number_format($total, 0, ',', ' ') }} Ft.</td>
                    </tr>
                </tfoot>
            </table>
            @if (session('cart'))
            <div class="text-end my-3">
                <a class="btn btn-success btn-lg " href="#" role="button">Megrendelés</a>
            </div>
            @endif
            <div class="text-end">
                <a class="btn btn-link btn-sm text-decoration-none" href="{{ url('/termekek') }}" role="button">Vásárlás folytatása</a>
            </div>
        </div>
    </div>

@endsection
