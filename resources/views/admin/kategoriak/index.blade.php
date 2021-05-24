@extends('admin.index')

@section('content')


<div class="row">
    <div class="col-12 col-lg-8 mb-5">
            <div class="row justify-content-center">
                <div class="col-auto me-sm-auto">
                    <p class="h1 user-select-none">
                       <i class="fa fa-tags fa-fw" aria-hidden="true"></i> Kategóriák
                    </p>
                </div>
                @if (count($categories) > 1)
                <div class="col-auto">
                    <a class="btn btn-outline-primary btn-lg mb-2" href="{{ url('admin/kategoriak/rendez') }}" role="button">
                        <i class="fas fa-sort-numeric-down fa-lg fa-fw"></i> Sorba rendezés
                    </a>
                </div>
                @endif
                <div class="col-auto">
                    <a class="btn btn-outline-primary btn-lg mb-5" href="{{ url('admin/kategoriak/uj') }}" role="button">
                        <i class="fas fa-plus fa-lg fa-fw"></i> Új kategória
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
                            <th>Név</th>
                            <th>Alkategóriák</th>
                            <th class="text-end">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="{{ $category->trashed() ? 'table-dark' : '' }} align-middle">
                                <td scope="row" class="user-select-none fw-bold">{{ $category->order }}</td>
                                <td class="text-nowrap">{{ $category->name }}</td>
                                <td class="">{{ $category->subCategories->implode('name', ', ') }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        @if ($category->trashed())
                                        <a class="btn btn-danger btn-sm delete me-3" href="#"
                                                data-href="{{ url('admin/kategoriak/vegleg-torol/' . $category->id) }}"
                                                data-header="kategória" data-name="{{ $category->name }}"
                                                data-id="{{ $category->id }}" role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Végleges törlés">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('admin/kategoriak/mutat/' . $category->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Megtekintés">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm "
                                            href="{{ url('admin/kategoriak/szerkeszt/' . $category->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Szerkesztés">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </a>
                                        @if ($category->trashed())
                                            <a class="btn btn-success btn-sm"
                                                href="{{ url('admin/kategoriak/visszaallit/' . $category->id) }}" role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Visszaállítás">
                                                <i class="fas fa-trash-restore fa-sm fa-fw"></i>
                                            </a>
                                            @else
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('admin/kategoriak/torol/' . $category->id) }}" role="button"
                                                data-bs-tooltip="tooltip" data-placement="top" title="Törlés">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-lg-3 offset-lg-1 justify-content-center">
            <div class="card mb-3 mx-auto" style="width:18rem;">
                <div class="card-header text-center user-select-none h3">Gyártók</div>
                <div class="card-body">
                    <p>Aktív: {{ count($brands->where('deleted_at', null)) }} db.</p>
                    <p>Inaktív: {{ count($brands->where('deleted_at', '!=', null)) }} db.</p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/gyartok') }}" role="button">Gyártók</a>
                </div>
            </div>
            <div class="card mb-5 mx-auto" style="width:18rem;">
                <div class="card-header text-center user-select-none h3">Tulajdonságok</div>
                <div class="card-body">
                    <p>Aktív: {{ count($properties->where('deleted_at', null)) }} db.</p>
                    <p>Inaktív: {{ count($properties->where('deleted_at', '!=', null)) }} db.</p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/tulajdonsagok') }}" role="button">Tulajdonságok</a>
                </div>
            </div>
        </div>
    </div>

@endsection
