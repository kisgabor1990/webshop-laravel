<div class="row">
    <div class="col-12" id="products">
        @php $total = 0; @endphp
        @if ($cart)
            <hr class="mt-0 mb-5">
            @foreach ($cart as $id => $product)
                @php
                    $total += $product['price'] * $product['quantity'];
                @endphp
                <div class="row shadow product{{ $id }}">
                    <div class="col-12 col-lg-3 px-3 px-lg-2 my-3 text-center">
                        <img src="{{ url($product['image']) }}" alt="{{ $product['name'] }}" class="img-fluid">
                    </div>
                    <div class="col-12 col-lg-9 my-3 d-flex flex-column">
                        <div class="col-12 h5">
                            <a href="{{ url('termek/' . $product['slug']) }}" class="text-reset text-decoration-none">
                                {{ $product['name'] }}
                            </a>
                            <p class="h6">{{ $product['brand'] }}</p>
                            <small>Egységár:</small>
                            <p class="h4 mb-3">
                                {{ number_format($product['price'], 0, ',', ' ') }} Ft.
                            </p>
                            
                        </div>
                        <div class="col-12 d-flex my-3">
                            <div class="col-4 col-lg-5 me-auto">
                                <div class="input-group">
                                    <a class="btn btn-danger fw-bold px-2 cart-decrease" data-id="{{ $id }}" data-href="{{ url('/kosar/'. $id . '/kevesebb') }}" role="button"><i
                                            class="fas fa-minus"></i></a>
                                    <input type="text" class="form-control fw-bold text-center px-2"
                                        aria-label="Quantity" value="{{ $product['quantity'] }}" disabled>
                                    <a class="btn btn-primary fw-bold px-2 cart-increase" data-id="{{ $id }}" data-href="{{ url('/kosar/'. $id . '/tobb') }}" role="button"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-2 text-end">
                                <a class="btn btn-danger fw-bold px-2 removeFromCart" data-id="{{ $id }}" data-href="{{ url('/kosar/'. $id . '/torles') }}" role="button"><i
                                        class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                        <small>Összesen:</small>
                            <p class="h4">
                                <span class="product_total_price">{{ number_format($product['price'] * $product['quantity'], 0, ',', ' ') }}</span> Ft.
                            </p>
                    </div>
                </div>
                <hr class="my-5 product{{ $id }}">
            @endforeach
        @else
            <p class="h3">A kosár üres!</p>
        @endif
    </div>
    <div class="col-12 mt-5">
        <table class="table text-light mb-5">
            <thead>
                <tr>
                    <th colspan="2" class="h3 user-select-none">Kosaram</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row" class="user-select-none">Összeg</td>
                    <td class="text-end fw-bold"><span class="cart_price">{{ number_format($total, 0, ',', ' ') }}</span> Ft.</td>
                </tr>
                <tr>
                    <td scope="row" class="user-select-none">Szállítás</td>
                    <td class="text-end fw-bold">{{ number_format(session('customer.shipping_price') ?? 0, 0, ',', ' ') }} Ft.</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="user-select-none">Végösszeg</th>
                    <td class="text-end fw-bold"><span class="cart_total_price">{{ number_format($total + (session('customer.shipping_price') ?? 0), 0, ',', ' ') }}</span> Ft.</td>
                </tr>
            </tfoot>
        </table>
        @if ($cart)
        <div class="text-end my-3" id="orderButtonDiv">
            <a class="btn btn-success btn-lg " href="{{ url('/megrendeles') }}" role="button">Megrendelés</a>
        </div>
        @endif
        <div class="text-end">
            <a class="btn btn-link btn-sm text-reset text-decoration-none" data-bs-dismiss="offcanvas" role="button">Vásárlás folytatása</a>
        </div>
    </div>
</div>