@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-5 mb-5">
            <form action="{{ url('admin/rendelesek/szerkeszt/' . $order->id) }}" method="POST">
            @csrf
                <div class="card">
                    <div class="card-header text-center user-select-none h3">
                        #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row" class="user-select-none w-50">Rendelés leadva:</th>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Státusz:</th>
                                    <td>
                                        @if ($order->status != "Lezárt" && $order->status != "Törölt")
                                        <select class="form-select" id="status" name="status">
                                            @if ($order->status != "Feldolgozás alatt" && $order->status != "Futárnak átadva")
                                            <option value="Új megrendelés" @if ($order->status == "Új megrendelés") selected @endif>Új megrendelés</option>
                                            @endif
                                            @if ($order->status != "Futárnak átadva")
                                            <option value="Feldolgozás alatt" @if ($order->status == "Feldolgozás alatt") selected @endif>Feldolgozás alatt</option>
                                            @endif
                                            <option value="Futárnak átadva" @if ($order->status == "Futárnak átadva") selected @endif>Futárnak átadva</option>
                                            <option value="Lezárt">Lezárt</option>
                                        </select>
                                        @else
                                        {{ $order->status }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Fizetési mód:</th>
                                    <td>{{ $order->payment }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Fizetve:</th>
                                    <td>
                                        @if ( ! $order->isPaid && $order->status != "Törölt")
                                        <select class="form-select" id="isPaid" name="isPaid">
                                            <option value="1" @if ($order->isPaid) selected @endif>Igen</option>
                                            <option value="0" @if ( ! $order->isPaid) selected @endif>Nem</option>
                                        </select>
                                        @else
                                            {{ $order->isPaid ? "Igen" : "Nem" }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Megrendelő neve:</th>
                                    <td>{{ $order->customer->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Megrendelő telefonszáma:</th>
                                    <td>+36{{ $order->customer->phone }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Megrendelő e-mail címe:</th>
                                    <td>{{ $order->customer->email }}</td>
                                </tr>
                                @if ($order->user)
                                    <tr>
                                        <th scope="row" class="user-select-none">Felhasználó:</th>
                                        <td>{{ $order->user->name }} ({{ $order->user->id }})</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm">Mentés</button>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/rendelesek') }}"
                        role="button">Vissza</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-lg-6 offset-lg-1 mb-5">
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header text-center user-select-none h3">Számlázási adatok</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="user-select-none w-50">Név:</th>
                                        <td>{{ $order->billing->name }}</td>
                                    </tr>
                                    @if ($order->billing->choose_company == "is_company")
                                    <tr>
                                        <th scope="row" class="user-select-none">Adószám:</th>
                                        <td>{{ $order->billing->taxnum }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th scope="row" class="user-select-none">Város:</th>
                                        <td>{{ $order->billing->address->city }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="user-select-none">Utca / házszám:</th>
                                        <td>{{ $order->billing->address->address }}</td>
                                    </tr>
                                    @if ($order->billing->address->address2)
                                    <tr>
                                        <th scope="row" class="user-select-none">Emelet / ajtó:</th>
                                        <td>{{ $order->billing->address->address2 }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th scope="row" class="user-select-none">Irányítószám:</th>
                                        <td>{{ $order->billing->address->zip }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header text-center user-select-none h3">Szállítási adatok</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="user-select-none w-50">Átvétel módja:</th>
                                        <td>{{ $order->shipping_mode }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="user-select-none w-50">Név:</th>
                                        <td>{{ $order->shipping->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="user-select-none">Város:</th>
                                        <td>{{ $order->shipping->address->city }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="user-select-none">Utca / házszám:</th>
                                        <td>{{ $order->shipping->address->address }}</td>
                                    </tr>
                                    @if ($order->shipping->address->address2)
                                    <tr>
                                        <th scope="row" class="user-select-none">Emelet / ajtó:</th>
                                        <td>{{ $order->shipping->address->address2 }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th scope="row" class="user-select-none">Irányítószám:</th>
                                        <td>{{ $order->shipping->address->zip }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header text-center user-select-none h3">Megrendelt termékek</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
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
                                            <td>
                                                <a href="{{ url("/termek/" . $product->slug) }}" target="_blank" class="text-reset">{{ $product->pivot->product_name }}</a>
                                            </td>
                                            <td class="text-center">{{ number_format($product->pivot->price, 0, ',', ' ') }} Ft.</td>
                                            <td class="text-center">{{ $product->pivot->quantity }} db.</td>
                                            <td class="text-center">{{ number_format($product->pivot->price * $product->pivot->quantity, 0, ',', ' ') }} Ft.</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td>Szállítási költség</td>
                                            <td class="text-center">{{ number_format($order->shipping_price, 0, ',', ' ') }} Ft.</td>
                                            <td class="text-center">1 db.</td>
                                            <td class="text-center">{{ number_format($order->shipping_price, 0, ',', ' ') }} Ft.</td>
                                        </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-end fw-bold">Összesen:</td>
                                        <td colspan="2" class="text-center h4">{{ number_format($order->amount, 0, ',', ' ') }} Ft.</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
