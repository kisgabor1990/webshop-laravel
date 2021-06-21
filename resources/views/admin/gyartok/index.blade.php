@extends('admin.index')

@section('content')


    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="row justify-content-center">
                <div class="col-auto me-sm-auto">
                    <p class="h1 user-select-none">
                        Gyártók
                    </p>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-primary btn-lg mb-5" href="{{ url('admin/gyartok/uj') }}" role="button">
                        <i class="fas fa-plus fa-lg fa-fw"></i> Új gyártó
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover" id="list">
                    <thead class="thead-inverse user-select-none">
                        <tr>
                            <th>#</th>
                            <th class="w-50">Név</th>
                            <th class="text-end">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr class="{{ $brand->trashed() ? 'table-dark' : '' }}">
                                <td scope="row" class="user-select-none fw-bold">{{ $brand->id }}</td>
                                <td class="text-nowrap">{{ $brand->name }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        @if ($brand->trashed())
                                        <a class="btn btn-danger btn-sm delete me-3" href="#"
                                                data-href="{{ url('admin/gyartok/vegleg-torol/' . $brand->id) }}"
                                                data-header="gyártó" data-name="{{ $brand->name }}"
                                                data-id="{{ $brand->id }}" role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Végleges törlés">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('admin/gyartok/mutat/' . $brand->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Megtekintés">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm "
                                            href="{{ url('admin/gyartok/szerkeszt/' . $brand->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Szerkesztés">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </a>
                                        @if ($brand->trashed())
                                            <a class="btn btn-success btn-sm"
                                                href="{{ url('admin/gyartok/visszaallit/' . $brand->id) }}" role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Visszaállítás">
                                                <i class="fas fa-trash-restore fa-sm fa-fw"></i>
                                            </a>
                                            @else
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('admin/gyartok/torol/' . $brand->id) }}" role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Törlés">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Nincs rögzített gyártó!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
