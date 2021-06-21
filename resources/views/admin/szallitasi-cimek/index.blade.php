@extends('admin.index')

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-auto me-sm-auto">
                    <p class="h1 user-select-none">
                        <i class="far fa-address-card fa-fw"></i> Szállítási címek
                    </p>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-primary btn-lg mb-5" href="{{ url('admin/szallitasi-cimek/uj') }}"
                        role="button">
                        <i class="fas fa-plus fa-lg fa-fw"></i> Új szállítási cím
                    </a>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="list">
                    <thead class="thead-inverse user-select-none">
                        <tr class="align-middle">
                            <th rowspan="2">#</th>
                            <th rowspan="2">Felhasználó</th>
                            <th rowspan="2">Név</th>
                            <th rowspan="2">Telefonszám</th>
                            <th colspan="4">Cím</th>
                            <th rowspan="2" class="text-end">Műveletek</th>
                        </tr>
                        <tr>
                            <th>Város</th>
                            <th class="text-nowrap">Utca / Házszám</th>
                            <th class="text-nowrap">Emelet / Ajtó</th>
                            <th>Irányítószám</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shipping_addresses as $shipping_address)
                            <tr class="{{ $shipping_address->trashed() ? 'table-dark' : '' }}">
                                <td scope="row" class="user-select-none fw-bold">{{ $shipping_address->id }}</td>
                                <td class="text-nowrap">{{ $shipping_address->user->name ?? '' }}</td>
                                <td class="text-nowrap">{{ $shipping_address->name }}</td>
                                <td class="text-nowrap">{{ $shipping_address->phone }}</td>
                                <td class="text-nowrap">{{ $shipping_address->address->city }}</td>
                                <td class="text-nowrap">{{ $shipping_address->address->address }}</td>
                                <td class="text-nowrap">{{ $shipping_address->address->address2 }}</td>
                                <td class="text-nowrap">{{ $shipping_address->address->zip }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        @if ($shipping_address->trashed())
                                            <a class="btn btn-danger btn-sm delete me-3" href="#"
                                                data-href="{{ url('admin/szallitasi-cimek/vegleg-torol/' . $shipping_address->id) }}"
                                                data-header="szállítási cím" data-name="{{ $shipping_address->name }}"
                                                data-user="{{ $shipping_address->user->name ?? '' }}"
                                                data-address="{{ $shipping_address->address->zip }} {{ $shipping_address->address->city }}, {{ $shipping_address->address->address }} {{ $shipping_address->address->address2 }}"
                                                data-id="{{ $shipping_address->id }}" role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Végleges törlés">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('admin/szallitasi-cimek/mutat/' . $shipping_address->id) }}"
                                            role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Megtekintés">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm "
                                            href="{{ url('admin/szallitasi-cimek/szerkeszt/' . $shipping_address->id) }}"
                                            role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Szerkesztés">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </a>
                                        @if ($shipping_address->trashed())
                                            <a class="btn btn-success btn-sm"
                                                href="{{ url('admin/szallitasi-cimek/visszaallit/' . $shipping_address->id) }}"
                                                role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Visszaállítás">
                                                <i class="fas fa-trash-restore fa-sm fa-fw"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('admin/szallitasi-cimek/torol/' . $shipping_address->id) }}"
                                                role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Törlés">
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
