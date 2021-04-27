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
                                    <td>{{ count($billing_addresses) }} db.</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Szállítási címei:</th>
                                    <td>{{ count($shipping_addresses) }} db.</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="user-select-none">Megrendelései:</th>
                                    <td>{{ count($billing_addresses) }} db.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-start">
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
                                        <th>Adószám<br><small>(Cég esetén)</small></th>
                                        <th>Cím</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($billing_addresses as $billing)
                                        <tr>
                                            <td>{{ $billing->name }}</td>
                                            <td>{{ $billing->tax_num }}</td>
                                            <td>
                                                {{ $billing->city }} <br>
                                                {{ $billing->address }} <br>
                                                {{ $billing->zip }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Nincs rögzített számlázási adat!</td>
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
                                        <th colspan="3">Cím</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($shipping_addresses as $shipping)
                                        <tr>
                                            <td class="w-50">{{ $shipping->name }}</td>
                                            <td>{{ $shipping->phone }}</td>
                                            <td>{{ $shipping->city }}</td>
                                            <td>{{ $shipping->address }}</td>
                                            <td>{{ $shipping->zip }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Nincs rögzített szállítási adat!</td>
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
                                        <th>Rendelés ideje</th>
                                        <th>Státusz</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($billing_addresses as $billing_address)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Nincs rögzített megrendelés!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
