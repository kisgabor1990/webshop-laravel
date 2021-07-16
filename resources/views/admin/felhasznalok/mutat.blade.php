@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-5 mb-5">
            <div class="card">
                <div class="card-header text-center user-select-none h3">#{{ $user->id }} - {{ $user->name }}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row" class="user-select-none w-50">E-mail cím:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">E-mail cím megerősítve:</th>
                                    <td>{{ $user->email_verified_at ?? "Nincs megerősítve!" }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Fiók létrehozva:</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Utoljára módosítva:</th>
                                    <td>{{ $user->updated_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Jelszó módosítás szükséges:</th>
                                    <td>{{ $user->password_must_change ? "Igen" : "Nem" }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Inaktív:</th>
                                    <td>{{ $user->deleted_at ? "Igen" : "Nem" }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Megrendelései:</th>
                                    <td>TODO</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/felhasznalok') }}" role="button">Vissza</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 offset-lg-1 mb-5">
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header text-center user-select-none h3">Számlázási adatok</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="user-select-none">
                                    <tr>
                                        <th>Név</th>
                                        <th class="text-nowrap">Adószám <small>(Cég esetén)</small></th>
                                        <th colspan="4">Cím</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($user->billing_address)
                                        <tr class="@if ($user->billing_address->trashed()) table-dark @endif" style="transform: rotate(0);">
                                            <td class="text-nowrap"><a href="{{ url('admin/szamlazasi-cimek/mutat/' . $user->billing_address->id) }}" class="stretched-link text-reset text-decoration-none">{{ $user->billing_address->name }}</a></td>
                                            <td class="text-nowrap">{{ $user->billing_address->tax_num }}</td>
                                            <td class="text-nowrap">{{ $user->billing_address->address->city }}</td>
                                            <td class="text-nowrap">{{ $user->billing_address->address->address }}</td>
                                            <td class="text-nowrap">{{ $user->billing_address->address->address2 }}</td>
                                            <td class="text-nowrap">{{ $user->billing_address->address->zip }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-nowrap">Nem található számlázási cím!</td>
                                        </tr>
                                    @endif
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
                                <thead class="user-select-none">
                                    <tr>
                                        <th>Név</th>
                                        <th>Telefonszám</th>
                                        <th colspan="4">Cím</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($user->shipping_address)
                                        <tr class="@if ($user->shipping_address->trashed()) table-dark @endif" style="transform: rotate(0);">
                                            <td class="text-nowrap"><a href="{{ url('admin/szallitasi-cimek/mutat/' . $user->shipping_address->id) }}" class="stretched-link text-reset text-decoration-none">{{ $user->shipping_address->name }}</a></td>
                                            <td class="text-nowrap">+36{{ $user->shipping_address->phone }}</td>
                                            <td class="text-nowrap">{{ $user->shipping_address->address->city }}</td>
                                            <td class="text-nowrap">{{ $user->shipping_address->address->address }}</td>
                                            <td class="text-nowrap">{{ $user->shipping_address->address->address2 }}</td>
                                            <td class="text-nowrap">{{ $user->shipping_address->address->zip }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-nowrap">Nem található szállítási cím!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header text-center user-select-none h3">Leadott megrendelések</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="user-select-none">
                                    <tr class="text-center">
                                        <th>Azonosító</th>
                                        <th class="text-nowrap">Rendelés ideje</th>
                                        <th>Státusz</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @forelse ($billing_addresses as $billing_address)
                                        <tr style="transform: rotate(0);">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Nincs rögzített megrendelés!</td>
                                        </tr>
                                    @endforelse --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
