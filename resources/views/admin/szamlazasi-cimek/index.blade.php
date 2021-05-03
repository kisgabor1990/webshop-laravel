@extends('admin.index')

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-auto me-sm-auto">
                    <p class="h1 user-select-none">
                        Számlázási címek
                    </p>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-primary btn-lg mb-5" href="{{ url('admin/szamlazasi-cimek/uj') }}"
                        role="button">
                        <i class="fas fa-plus fa-lg fa-fw"></i> Új számlázási cím
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
                            <th>Adószám</th>
                            <th colspan="4">Cím</th>
                            <th class="text-end">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($billing_addresses as $billing_address)
                            <tr class="{{ $billing_address->trashed() ? 'bg-dark text-white' : '' }}">
                                <td scope="row" class="user-select-none fw-bold">{{ $billing_address->id }}</td>
                                <td class="text-nowrap">{{ $billing_address->user->name ?? '' }}</td>
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
                                                data-user="{{ $billing_address->user->name }}"
                                                data-address="{{ $billing_address->city }}, {{ $billing_address->address }} {{ $billing_address->address2 }}"
                                                data-id="{{ $billing_address->id }}" role="button">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('admin/szamlazasi-cimek/mutat/' . $billing_address->id) }}"
                                            role="button">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm "
                                            href="{{ url('admin/szamlazasi-cimek/szerkeszt/' . $billing_address->id) }}"
                                            role="button">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </a>
                                        @if ($billing_address->trashed())
                                            <a class="btn btn-success btn-sm"
                                                href="{{ url('admin/szamlazasi-cimek/visszaallit/' . $billing_address->id) }}"
                                                role="button">
                                                <i class="fas fa-trash-restore fa-sm fa-fw"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('admin/szamlazasi-cimek/torol/' . $billing_address->id) }}"
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
