@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-5 mb-5">
            <div class="card">
                <div class="card-header text-center user-select-none h3">{{ $category->id }} - {{ $category->name }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row" class="user-select-none w-50">URL:</th>
                                <td>{{ $category->slug }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Kategória létrehozva:</th>
                                <td>{{ $category->created_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Utoljára módosítva:</th>
                                <td>{{ $category->updated_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Törölve:</th>
                                <td>@if ($category->deleted_at)Igen @else Nem @endif</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-start">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/kategoriak') }}" role="button">Vissza</a>
                </div>
            </div>
        </div>
        {{-- <div class="col-12 col-lg-6 offset-lg-1 mb-5">
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header text-center user-select-none h3">Számlázási adatok</div>
                    <div class="card-body">
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
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header text-center user-select-none h3">Szállítási adatok</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="user-select-none">
                                <tr>
                                    <th>Név</th>
                                    <th>Telefonszám</th>
                                    <th>Cím</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($shipping_addresses as $shipping)
                                    <tr>
                                        <td>{{ $shipping->name }}</td>
                                        <td>{{ $shipping->phone }}</td>
                                        <td>
                                            {{ $shipping->city }} <br>
                                            {{ $shipping->address }} <br>
                                            {{ $shipping->zip }}
                                        </td>
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
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header text-center user-select-none h3">Leadott megrendelések</div>
                    <div class="card-body">
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
        </div> --}}
    </div>

@endsection
