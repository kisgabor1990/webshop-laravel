@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-5 mb-5">
            <div class="card">
                <div class="card-header text-center user-select-none h3">{{ $user->id }} - {{ $user->name }}</div>
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
                                    <td>{{ $user->email_verified_at }}</td>
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
                                    <th scope="row" class="user-select-none">Törölve:</th>
                                    <td>@if ($user->deleted_at)Igen @else Nem @endif</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Számlázási címei:</th>
                                    <td>{{ count($user->billing_addresses) }} db.</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Szállítási címei:</th>
                                    <td>{{ count($user->shipping_addresses) }} db.</td>
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
                                    @forelse ($user->billing_addresses as $billing)
                                        <tr class="@if ($billing->trashed()) table-dark @endif" style="transform: rotate(0);">
                                            <td class="text-nowrap"><a href="{{ url('admin/szamlazasi-cimek/mutat/' . $billing->id) }}" class="stretched-link text-reset text-decoration-none">{{ $billing->name }}</a></td>
                                            <td class="text-nowrap">{{ $billing->tax_num }}</td>
                                            <td class="text-nowrap">{{ $billing->address->city }}</td>
                                            <td class="text-nowrap">{{ $billing->address->address }}</td>
                                            <td class="text-nowrap">{{ $billing->address->address2 }}</td>
                                            <td class="text-nowrap">{{ $billing->address->zip }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">Nincs rögzített számlázási adat!</td>
                                        </tr>
                                    @endforelse
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
                                    @forelse ($user->shipping_addresses as $shipping)
                                        <tr class="@if ($shipping->trashed()) table-dark @endif" style="transform: rotate(0);">
                                            <td class="text-nowrap"><a href="{{ url('admin/szallitasi-cimek/mutat/' . $shipping->id) }}" class="stretched-link text-reset text-decoration-none">{{ $shipping->name }}</a></td>
                                            <td class="text-nowrap">+36{{ $shipping->phone }}</td>
                                            <td class="text-nowrap">{{ $shipping->address->city }}</td>
                                            <td class="text-nowrap">{{ $shipping->address->address }}</td>
                                            <td class="text-nowrap">{{ $shipping->address->address2 }}</td>
                                            <td class="text-nowrap">{{ $shipping->address->zip }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">Nincs rögzített szállítási adat!</td>
                                        </tr>
                                    @endforelse
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
