@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-5 mb-5">
            <div class="card">
                <div class="card-header text-center user-select-none h3">{{ $billing_address->name }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row" class="user-select-none w-50">Város:</th>
                                <td>{{ $billing_address->address->city }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none w-50">Utca / Házszám:</th>
                                <td>{{ $billing_address->address->address }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none w-50">Emelet / Ajtó:</th>
                                <td>{{ $billing_address->address->address2 }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none w-50">Irányítószám:</th>
                                <td>{{ $billing_address->address->zip }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none w-50">Cég / Magán:</th>
                                <td>{{ $billing_address->choose_company == "is_company" ? "Cég" : "Magánszemély" }}</td>
                            </tr>
                            @if ($billing_address->choose_company == "is_company")
                            <tr>
                                <th scope="row" class="user-select-none w-50">Adószám:</th>
                                <td>{{ $billing_address->tax_num }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th scope="row" class="user-select-none">Cím létrehozva:</th>
                                <td>{{ $billing_address->created_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Utoljára módosítva:</th>
                                <td>{{ $billing_address->updated_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Inaktív:</th>
                                <td>{{ $billing_address->deleted_at ? 'Igen' : 'Nem' }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Felhasználó:</th>
                                <td>{{ $billing_address->user->id ?? '' }} - {{ $billing_address->user->name ?? '' }}</td>
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
