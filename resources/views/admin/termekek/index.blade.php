@extends('admin.index')

@section('content')


<div class="row">
    <div class="col-12 col-lg-8">
            <div class="row justify-content-center">
                <div class="col-auto me-sm-auto">
                    <p class="h1 user-select-none">
                        Termékek
                    </p>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-primary btn-lg mb-5" href="{{ url('admin/termekek/uj') }}" role="button">
                        <i class="fas fa-plus fa-lg fa-fw"></i> Új termék
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
                            <th>Model</th>
                            <th>Kategória</th>
                            <th>Gyártó</th>
                            <th>Ár</th>
                            <th class="text-end">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="{{ $product->trashed() ? 'table-dark' : '' }}">
                                <td scope="row" class="user-select-none fw-bold">{{ $product->id }}</td>
                                <td class="text-nowrap">{{ $product->model }}</td>
                                <td class="text-nowrap @if ($product->category->trashed()) table-dark @endif">{{ $product->category->name }}</td>
                                <td class="text-nowrap @if ($product->brand->trashed()) table-dark @endif">{{ $product->brand->name }}</td>
                                <td class="text-nowrap">{{ $product->price }} Ft.</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        @if ($product->trashed())
                                        <a class="btn btn-danger btn-sm delete me-3" href="#"
                                                data-href="{{ url('admin/termekek/vegleg-torol/' . $product->id) }}"
                                                data-header="termék" data-name="{{ $product->model }}"
                                                data-id="{{ $product->id }}" data-category="{{ $product->category->name }}"
                                                data-brand="{{ $product->brand->name }}" role="button">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('admin/termekek/mutat/' . $product->id) }}" role="button">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm "
                                            href="{{ url('admin/termekek/szerkeszt/' . $product->id) }}" role="button">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </a>
                                        @if ($product->trashed())
                                            <a class="btn btn-success btn-sm"
                                                href="{{ url('admin/termekek/visszaallit/' . $product->id) }}" role="button">
                                                <i class="fas fa-trash-restore fa-sm fa-fw"></i>
                                            </a>
                                            @else
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('admin/termekek/torol/' . $product->id) }}" role="button">
                                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Jelenleg nincsenek termékek!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection