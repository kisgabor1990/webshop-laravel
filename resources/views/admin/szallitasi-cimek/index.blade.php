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
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover @if (count($shipping_addresses)) list @endif">
                    <thead class="thead-inverse user-select-none">
                        <tr class="align-middle">
                            <th rowspan="2">Felhasználó</th>
                            <th rowspan="2">Email cím</th>
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
                                <td class="text-nowrap">{{ $shipping_address->user->name }}</td>
                                <td class="text-nowrap">{{ $shipping_address->user->email }}</td>
                                <td class="text-nowrap">{{ $shipping_address->name }}</td>
                                <td class="text-nowrap">{{ $shipping_address->phone }}</td>
                                @if ($shipping_address->address)
                                    <td class="text-nowrap">{{ $shipping_address->address->city }}</td>
                                    <td class="text-nowrap">{{ $shipping_address->address->address }}</td>
                                    <td class="text-nowrap">{{ $shipping_address->address->address2 }}</td>
                                    <td class="text-nowrap">{{ $shipping_address->address->zip }}</td>
                                @else
                                    <td colspan="4" class="text-nowrap"></td>
                                @endif
                                <td class="text-end">
                                    <div class="btn-group" role="group">
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
