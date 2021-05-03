@extends('admin.index')

@section('content')


<div class="row">
    <div class="col-12 col-lg-8">
            <div class="row justify-content-center">
                <div class="col-auto me-sm-auto">
                    <p class="h1 user-select-none">
                        Felhasználók
                    </p>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-primary btn-lg mb-5" href="{{ url('admin/felhasznalok/uj') }}" role="button">
                        <i class="fas fa-plus fa-lg fa-fw"></i> Új felhasználó
                    </a>
                </div>
            </div>
            
            @include('alerts.error')
            @include('alerts.success')
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-inverse user-select-none">
                        <tr>
                            <th>#</th>
                            <th class="w-50">Név</th>
                            <th>E-mail cím</th>
                            <th class="text-end">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="{{ $user->trashed() ? 'table-dark' : '' }}">
                                <td scope="row" class="user-select-none fw-bold">{{ $user->id }}</td>
                                <td class="text-nowrap">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        @if ($user->trashed())
                                        <a class="btn btn-danger btn-sm delete me-3" href="#"
                                                    data-href="{{ url('admin/felhasznalok/vegleg-torol/' . $user->id) }}"
                                                    data-header="felhasználó" data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-id="{{ $user->id }}" role="button">
                                                    <i class="fas fa-trash fa-sm fa-fw"></i>
                                                </a>
                                        @endif
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('admin/felhasznalok/mutat/' . $user->id) }}" role="button">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm "
                                            href="{{ url('admin/felhasznalok/szerkeszt/' . $user->id) }}" role="button">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </a>
                                        @if ($user->is_admin == 0)
                                            @if ($user->trashed())
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ url('admin/felhasznalok/visszaallit/' . $user->id) }}" role="button">
                                                    <i class="fas fa-trash-restore fa-sm fa-fw"></i>
                                                </a>
                                            @else
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('admin/felhasznalok/torol/' . $user->id) }}" role="button">
                                            <i class="fas fa-trash fa-sm fa-fw"></i>
                                        </a>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-lg-3 offset-lg-1 order-first order-lg-last justify-content-center">
            <div class="card mb-3 mx-auto" style="width:18rem;">
                <div class="card-header text-center user-select-none h3">Számlázási címek</div>
                <div class="card-body">
                    <p>Aktív: {{ count($billing_addresses->where('deleted_at', null)) }} db.</p>
                    <p>Inaktív: {{ count($billing_addresses->where('deleted_at', '!=', null)) }} db.</p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/szamlazasi-cimek') }}" role="button">Számlázási címek</a>
                </div>
            </div>
            <div class="card mb-5 mx-auto" style="width:18rem;">
                <div class="card-header text-center user-select-none h3">Szállítási címek</div>
                <div class="card-body">
                    <p>Aktív: {{ count($shipping_addresses->where('deleted_at', null)) }} db.</p>
                    <p>Inaktív: {{ count($shipping_addresses->where('deleted_at', '!=', null)) }} db.</p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/szallitasi-cimek') }}" role="button">Szállítási címek</a>
                </div>
            </div>
        </div>
    </div>

@endsection
