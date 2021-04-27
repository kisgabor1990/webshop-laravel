@extends('admin.index')

@section('content')

    <div class="row justify-content-center">
        <div class="col-auto me-sm-auto">
            <p class="h1 user-select-none">
                Kategóriák
            </p>
        </div>
        <div class="col-auto">
            <a class="btn btn-outline-primary btn-lg mb-5" href="{{ url('admin/kategoriak/uj') }}" role="button">
                <i class="fas fa-plus fa-lg fa-fw"></i> Új kategória
            </a>
        </div>
    </div>

    @include('alerts.error')
    @include('alerts.success')

    <div class="col-12">
        <table class="table table-striped table-hover">
            <thead class="thead-inverse user-select-none">
                <tr>
                    <th>#</th>
                    <th class="w-50">Név</th>
                    <th>URL</th>
                    <th class="text-end">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)

                    <tr>
                        <td scope="row" class="user-select-none fw-bold">{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a class="btn btn-primary btn-sm "
                                    href="{{ url('admin/kategoriak/mutat/' . $category->id) }}" role="button">
                                    <i class="fas fa-eye fa-sm fa-fw"></i>
                                </a>
                                <a class="btn btn-warning btn-sm "
                                    href="{{ url('admin/kategoriak/szerkeszt/' . $category->id) }}" role="button">
                                    <i class="fas fa-edit fa-sm fa-fw"></i>
                                </a>
                                @if ($category->trashed())
                                    <a class="btn btn-dark btn-sm"
                                        href="{{ url('admin/kategoriak/visszaallit/' . $category->id) }}" role="button">
                                        <i class="fas fa-trash-restore fa-sm fa-fw"></i>
                                    </a>
                                @else
                                    <a class="btn btn-danger btn-sm delete" href="#"
                                        data-href="{{ url('admin/kategoriak/torol/' . $category->id) }}"
                                        data-header="kategória" data-name="{{ $category->name }}" role="button">
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

@endsection
