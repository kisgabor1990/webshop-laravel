@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-5 mb-5">
            <div class="card">
                <div class="card-header text-center user-select-none h3">{{ $brand->id }} - {{ $brand->name }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row" class="user-select-none">Kategóriákhoz rendelve:</th>
                                <td>TODO</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Termékek:</th>
                                <td>TODO</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Márka létrehozva:</th>
                                <td>{{ $brand->created_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Utoljára módosítva:</th>
                                <td>{{ $brand->updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-start">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/markak') }}" role="button">Vissza</a>
                </div>
            </div>
        </div>
    </div>

@endsection