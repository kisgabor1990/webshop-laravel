@extends('index')

@section('content')

    <div class="accordion" id="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFolyamatban">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFolyamatban"
                        aria-expanded="true" aria-controls="collapseFolyamatban">
                    Folyamatban lévő megrendelések ({{ count($user->orders->where('status', '!=', 'Lezárt')) }})
                </button>
            </h2>
            <div id="collapseFolyamatban" class="accordion-collapse collapse show" aria-labelledby="headingFolyamatban"
                 data-bs-parent="#accordion">
                <div class="accordion-body">

                    <div class="accordion" id="ordersFolyamatban">
                        @forelse ($user->orders->where('status', '!=', 'Lezárt') as $order)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $order->id }}">
                                <button class="accordion-button collapsed lh-lg fs-5 fw-bold fst-italic" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}"
                                        aria-expanded="false" aria-controls="collapse{{ $order->id }}" style="letter-spacing: 2px">
                                    #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                </button>
                            </h2>
                            <div id="collapse{{ $order->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $order->id }}"
                                 data-bs-parent="#ordersFolyamatban">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-8 offset-0 offset-lg-2">
                                            <p class="fs-4">Megrendelés bizonylatszáma: <span class="h3">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span> </p>
                                            <p>Rendelés leadva: <span class="fw-bold"> {{ $order->created_at->format("Y. m. d.") }} </span></p>
                                            <p>Végösszeg: <span class="fw-bold">{{ number_format($order->amount, 0, ',', ' ') }} Ft. </span></p>
                                            <p>Átvétel módja: <span class="fw-bold">{{ $order->shipping_mode }}</span></p>
                                            <p>Átvétel helye: <span class="fw-bold">{{ $order->shipping->address->zip }} {{ $order->shipping->address->city }}, {{ $order->shipping->address->address }} {{ $order->shipping->address->address2 }}</span></p>
                                            <div class="accordion" id="moreInfo">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingMore{{ $order->id }}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMore{{ $order->id }}" aria-expanded="false" aria-controls="collapseMore{{ $order->id }}">
                                                            Rendelés részletei
                                                        </button>
                                                    </h2>
                                                    <div id="collapseMore{{ $order->id }}" class="accordion-collapse collapse" aria-labelledby="headingMore{{ $order->id }}" data-bs-parent="#moreInfo">
                                                        <div class="accordion-body">
                                                            <p class="fs-4 fw-bold">Megrendelt termékek</p>
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>Egységár</th>
                                                                        <th>Mennyiség</th>
                                                                        <th>Összesen</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($order->products as $product)
                                                                        <tr>
                                                                            <td class="fw-bold">
                                                                                <a href="{{ url("/termek/" . $product->slug) }}"
                                                                                   target="_blank"
                                                                                   class="text-reset">{{ $product->pivot->product_name }}</a>
                                                                            </td>
                                                                            <td class="text-nowrap text-center">{{ number_format($product->pivot->price, 0, ',', ' ') }}
                                                                                Ft.
                                                                            </td>
                                                                            <td class="text-center">{{ $product->pivot->quantity }}
                                                                                db.
                                                                            </td>
                                                                            <td class="text-nowrap text-center">{{ number_format($product->pivot->price * $product->pivot->quantity, 0, ',', ' ') }}
                                                                                Ft.
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    <tr>
                                                                        <td class="fw-bold">Szállítási költség</td>
                                                                        <td class="text-nowrap text-center">{{ number_format($order->shipping_price, 0, ',', ' ') }}
                                                                            Ft.
                                                                        </td>
                                                                        <td class="text-center">1 db.</td>
                                                                        <td class="text-nowrap text-center">{{ number_format($order->shipping_price, 0, ',', ' ') }}
                                                                            Ft.
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                    <tfoot>
                                                                    <tr>
                                                                        <td class="text-end">Bruttó végösszeg:</td>
                                                                        <td colspan="3"
                                                                            class="fw-bold fs-4 text-center">{{ number_format($order->amount, 0, ',', ' ') }}
                                                                            Ft.
                                                                        </td>
                                                                    </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>Jelenleg nincs folyamatban lévő megrendelése!</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingLezárt">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseLezárt" aria-expanded="false" aria-controls="collapseLezárt">
                    Lezárt megrendelések ({{ count($user->orders->where('status', 'Lezárt')) }})
                </button>
            </h2>
            <div id="collapseLezárt" class="accordion-collapse collapse" aria-labelledby="headingLezárt"
                 data-bs-parent="#accordion">
                <div class="accordion-body">

                    <div class="accordion" id="ordersLezárt">
                        @forelse ($user->orders->where('status', 'Lezárt') as $order)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $order->id }}">
                                    <button class="accordion-button collapsed lh-lg fs-5 fw-bold fst-italic" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}"
                                            aria-expanded="false" aria-controls="collapse{{ $order->id }}" style="letter-spacing: 2px">
                                        #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $order->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $order->id }}"
                                     data-bs-parent="#ordersLezárt">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-12 col-lg-8 offset-0 offset-lg-2">
                                                <p class="fs-4">Megrendelés bizonylatszáma: <span class="h3">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span> </p>
                                                <p>Rendelés leadva: <span class="fw-bold"> {{ $order->created_at->format("Y. m. d.") }} </span></p>
                                                <p>Végösszeg: <span class="fw-bold">{{ number_format($order->amount, 0, ',', ' ') }} Ft. </span></p>
                                                <p>Átvétel módja: <span class="fw-bold">{{ $order->shipping_mode }}</span></p>
                                                <p>Átvétel helye: <span class="fw-bold">{{ $order->shipping->address->zip }} {{ $order->shipping->address->city }}, {{ $order->shipping->address->address }} {{ $order->shipping->address->address2 }}</span></p>
                                                <div class="accordion" id="moreInfo">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingMore{{ $order->id }}">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMore{{ $order->id }}" aria-expanded="false" aria-controls="collapseMore{{ $order->id }}">
                                                                Rendelés részletei
                                                            </button>
                                                        </h2>
                                                        <div id="collapseMore{{ $order->id }}" class="accordion-collapse collapse" aria-labelledby="headingMore{{ $order->id }}" data-bs-parent="#moreInfo">
                                                            <div class="accordion-body">
                                                                <p class="fs-4 fw-bold">Megrendelt termékek</p>
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th>Egységár</th>
                                                                            <th>Mennyiség</th>
                                                                            <th>Összesen</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach($order->products as $product)
                                                                            <tr>
                                                                                <td class="fw-bold">
                                                                                    <a href="{{ url("/termek/" . $product->slug) }}"
                                                                                       target="_blank"
                                                                                       class="text-reset">{{ $product->pivot->product_name }}</a>
                                                                                </td>
                                                                                <td class="text-nowrap text-center">{{ number_format($product->pivot->price, 0, ',', ' ') }}
                                                                                    Ft.
                                                                                </td>
                                                                                <td class="text-center">{{ $product->pivot->quantity }}
                                                                                    db.
                                                                                </td>
                                                                                <td class="text-nowrap text-center">{{ number_format($product->pivot->price * $product->pivot->quantity, 0, ',', ' ') }}
                                                                                    Ft.
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td class="fw-bold">Szállítási költség</td>
                                                                            <td class="text-nowrap text-center">{{ number_format($order->shipping_price, 0, ',', ' ') }}
                                                                                Ft.
                                                                            </td>
                                                                            <td class="text-center">1 db.</td>
                                                                            <td class="text-nowrap text-center">{{ number_format($order->shipping_price, 0, ',', ' ') }}
                                                                                Ft.
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                        <tfoot>
                                                                        <tr>
                                                                            <td class="text-end">Bruttó végösszeg:</td>
                                                                            <td colspan="3"
                                                                                class="fw-bold fs-4 text-center">{{ number_format($order->amount, 0, ',', ' ') }}
                                                                                Ft.
                                                                            </td>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Jelenleg nincs lezárt megrendelése!</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
