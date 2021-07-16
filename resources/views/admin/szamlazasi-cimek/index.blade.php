@extends('admin.index')

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-auto me-sm-auto">
                    <p class="h1 user-select-none">
                        <i class="far fa-address-card fa-fw"></i> Számlázási címek
                    </p>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-primary btn-lg mb-5" href="{{ url('admin/szamlazasi-cimek/uj') }}"
                        role="button">
                        <i class="fas fa-plus fa-lg fa-fw"></i> Új számlázási cím
                    </a>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover @if (count($billing_addresses)) list @endif">
                    <thead class="thead-inverse user-select-none">
                        <tr class="align-middle">
                            <th rowspan="2">Felhasználó</th>
                            <th rowspan="2">Email cím</th>
                            <th rowspan="2">Név</th>
                            <th rowspan="2">Adószám</th>
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
                        @forelse ($billing_addresses as $billing_address)
                            <tr class="{{ $billing_address->trashed() ? 'table-dark' : '' }}">
                                <td class="text-nowrap">{{ $billing_address->user->name }}</td>
                                <td class="text-nowrap">{{ $billing_address->user->email }}</td>
                                <td class="text-nowrap">{{ $billing_address->name }}</td>
                                <td class="text-nowrap">{{ $billing_address->tax_num }}</td>
                                <td class="text-nowrap">{{ $billing_address->address->city }}</td>
                                <td class="text-nowrap">{{ $billing_address->address->address }}</td>
                                <td class="text-nowrap">{{ $billing_address->address->address2 }}</td>
                                <td class="text-nowrap">{{ $billing_address->address->zip }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        @if ($billing_address->trashed())
                                            <a class="btn btn-danger btn-sm delete me-3" href="#"
                                                data-href="{{ url('admin/szamlazasi-cimek/vegleg-torol/' . $billing_address->id) }}"
                                                data-header="számlázási cím" data-name="{{ $billing_address->name }}"
                                                data-user="{{ $billing_address->user->name ?? '' }}"
                                                data-address="{{ $billing_address->address->zip }} {{ $billing_address->address->city }}, {{ $billing_address->address->address }} {{ $billing_address->address->address2 }}"
                                                data-id="{{ $billing_address->id }}" role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Végleges törlés">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('admin/szamlazasi-cimek/mutat/' . $billing_address->id) }}"
                                            role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Megtekintés">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm "
                                            href="{{ url('admin/szamlazasi-cimek/szerkeszt/' . $billing_address->id) }}"
                                            role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Szerkesztés">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </a>
                                        @if ($billing_address->trashed())
                                            <a class="btn btn-success btn-sm"
                                                href="{{ url('admin/szamlazasi-cimek/visszaallit/' . $billing_address->id) }}"
                                                role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Visszaállítás">
                                                <i class="fas fa-trash-restore fa-sm fa-fw"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('admin/szamlazasi-cimek/torol/' . $billing_address->id) }}"
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
