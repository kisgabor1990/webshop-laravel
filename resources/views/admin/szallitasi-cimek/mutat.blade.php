@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-5 mb-5">
            <div class="card">
                <div class="card-header text-center user-select-none h3">{{ $shipping_address->name }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row" class="user-select-none w-50">Város:</th>
                                <td>{{ $shipping_address->address->city }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none w-50">Utca / Házszám:</th>
                                <td>{{ $shipping_address->address->address }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none w-50">Emelet / Ajtó:</th>
                                <td>{{ $shipping_address->address->address2 }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none w-50">Irányítószám:</th>
                                <td>{{ $shipping_address->address->zip }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none w-50">Telefonszám:</th>
                                <td>+36{{ $shipping_address->phone }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none w-50">Megjegyzés:</th>
                                <td>{{ $shipping_address->comment }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Cím létrehozva:</th>
                                <td>{{ $shipping_address->created_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Utoljára módosítva:</th>
                                <td>{{ $shipping_address->updated_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Törölve:</th>
                                <td>{{ $shipping_address->deleted_at ? 'Igen' : 'Nem' }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Felhasználó:</th>
                                <td>{{ $shipping_address->user->id }} - {{ $shipping_address->user->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-primary btn-sm " href="{{ url()->previous() }}" role="button">Vissza</a>
                </div>
            </div>
        </div>
    </div>

@endsection
