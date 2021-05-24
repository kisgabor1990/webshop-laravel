@extends('admin.index')

@section('content')


    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="row justify-content-center">
                <div class="col-auto me-sm-auto">
                    <p class="h1 user-select-none">
                        Tulajdonságok
                    </p>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-primary btn-lg mb-5" href="{{ url('admin/tulajdonsagok/uj') }}" role="button">
                        <i class="fas fa-plus fa-lg fa-fw"></i> Új tulajdonság
                    </a>
                </div>
            </div>

            @include('alerts.error')
            @include('alerts.success')
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="list">
                    <thead class="thead-inverse user-select-none">
                        <tr>
                            <th>#</th>
                            <th>Kategória</th>
                            <th class="w-50">Név</th>
                            <th>Értékek</th>
                            <th class="text-end">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($properties as $property)
                            <tr class="{{ $property->trashed() ? 'table-dark' : '' }}">
                                <td scope="row" class="user-select-none fw-bold">{{ $property->id }}</td>
                                <td class="text-nowrap">{{ $property->category->name }}</td>
                                <td class="text-nowrap">{{ $property->name }}</td>
                                <td class="text-nowrap"> {{ $property->values->sortBy('name')->implode('name', ', ') }} </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        @if ($property->trashed())
                                        <a class="btn btn-danger btn-sm delete me-3" href="#"
                                                data-href="{{ url('admin/tulajdonsagok/vegleg-torol/' . $property->id) }}"
                                                data-header="tulajdonság" data-name="{{ $property->name }}"
                                                data-id="{{ $property->id }}" role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Végleges törlés">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('admin/tulajdonsagok/mutat/' . $property->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Megtekintés">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm "
                                            href="{{ url('admin/tulajdonsagok/szerkeszt/' . $property->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Szerkesztés">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </a>
                                        @if ($property->trashed())
                                            <a class="btn btn-success btn-sm"
                                                href="{{ url('admin/tulajdonsagok/visszaallit/' . $property->id) }}" role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Visszaállítás">
                                                <i class="fas fa-trash-restore fa-sm fa-fw"></i>
                                            </a>
                                            @else
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('admin/tulajdonsagok/torol/' . $property->id) }}" role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Törlés">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Nincs rögzített tulajdonság!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
