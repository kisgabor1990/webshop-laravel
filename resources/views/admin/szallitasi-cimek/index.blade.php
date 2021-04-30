@extends('admin.index')

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-auto me-sm-auto">
                    <p class="h1 user-select-none">
                        Szállítási címek
                    </p>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-primary btn-lg mb-5" href="{{ url('admin/szallitasi-cimek/uj') }}"
                        role="button">
                        <i class="fas fa-plus fa-lg fa-fw"></i> Új szállítási cím
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
                            <th>Felhasználó</th>
                            <th>Név</th>
                            <th>Telefonszám</th>
                            <th colspan="4">Cím</th>
                            <th class="text-end">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shipping_addresses as $shipping_address)
                            <tr class="{{ $shipping_address->trashed() ? 'bg-dark text-white' : '' }}">
                                <td scope="row" class="user-select-none fw-bold">{{ $shipping_address->id }}</td>
                                <td class="text-nowrap">{{ $shipping_address->user }}</td>
                                <td class="text-nowrap">{{ $shipping_address->name }}</td>
                                <td class="text-nowrap">{{ $shipping_address->phone }}</td>
                                <td class="text-nowrap">{{ $shipping_address->city }}</td>
                                <td class="text-nowrap">{{ $shipping_address->address }}</td>
                                <td class="text-nowrap">{{ $shipping_address->address2 }}</td>
                                <td class="text-nowrap">{{ $shipping_address->zip }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        @if ($shipping_address->trashed())
                                            <a class="btn btn-danger btn-sm delete me-3" href="#"
                                                data-href="{{ url('admin/szallitasi-cimek/vegleg-torol/' . $shipping_address->id) }}"
                                                data-header="szállítási cím" data-name="{{ $shipping_address->name }}"
                                                data-user="{{ $shipping_address->user }}"
                                                data-address="{{ $shipping_address->city }}, {{ $shipping_address->address }} {{ $shipping_address->address2 }}"
                                                data-id="{{ $shipping_address->id }}" role="button">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('admin/szallitasi-cimek/mutat/' . $shipping_address->id) }}"
                                            role="button">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm "
                                            href="{{ url('admin/szallitasi-cimek/szerkeszt/' . $shipping_address->id) }}"
                                            role="button">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </a>
                                        @if ($shipping_address->trashed())
                                            <a class="btn btn-success btn-sm"
                                                href="{{ url('admin/szallitasi-cimek/visszaallit/' . $shipping_address->id) }}"
                                                role="button">
                                                <i class="fas fa-trash-restore fa-sm fa-fw"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('admin/szallitasi-cimek/torol/' . $shipping_address->id) }}"
                                                role="button">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">Nincs rögzített szállítási adat!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
