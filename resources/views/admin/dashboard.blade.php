@extends('admin.index')

@section('content')

    <div class="col-auto mb-5">
        <div class="card" style="width:18rem;">
            <div class="card-header text-center user-select-none h3">Felhasználók</div>
            <div class="card-body">
                {{ $user_count }} db.
            </div>
            <div class="card-footer text-end">
                <a class="btn btn-primary btn-sm " href="{{ url('admin/felhasznalok') }}" role="button">Felhasználók</a>
            </div>
        </div>
    </div>
    <div class="col-auto mb-5">
        <div class="card" style="width:18rem;">
            <div class="card-header text-center user-select-none h3">Kategóriák</div>
            <div class="card-body">
                {{ $category_count }} db.
            </div>
            <div class="card-footer text-end">
                <a class="btn btn-primary btn-sm " href="{{ url('admin/kategoriak') }}" role="button">Kategóriák</a>
            </div>
        </div>
    </div>
    <div class="col-auto mb-5">
        <div class="card" style="width:18rem;">
            <div class="card-header text-center user-select-none h3">Termékek</div>
            <div class="card-body">
                {{ $product_count }} db.
            </div>
            <div class="card-footer text-end">
                <a class="btn btn-primary btn-sm " href="{{ url('admin/termekek') }}" role="button">Termékek</a>
            </div>
        </div>
    </div>
    <div class="col-auto mb-5">
        <div class="card" style="width:18rem;">
            <div class="card-header text-center user-select-none h3">Rendelések</div>
            <div class="card-body">
                {{ $user_count }} db.
            </div>
            <div class="card-footer text-end">
                <a class="btn btn-primary btn-sm " href="{{ url('admin/rendelesek') }}" role="button">Rendelések</a>
            </div>
        </div>
    </div>

@endsection
