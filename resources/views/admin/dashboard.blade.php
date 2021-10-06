@extends('admin.index')

@section('content')

    <div class="row justify-content-center justify-content-lg-start">
        <div class="col-auto mb-2">
            <div class="card" style="width:18rem;">
                <div class="card-header text-center user-select-none h3">Felhasználók</div>
                <div class="card-body">
                    <p>Aktív: <span class="fw-bold"> {{ count($users->where('deleted_at', null)) }} db.</span></p>
                    <p>Inaktív: <span class="fw-bold"> {{ count($users->where('deleted_at', '!=', null)) }} db.</span></p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/felhasznalok') }}"
                    role="button">Felhasználók</a>
                </div>
            </div>
        </div>
        <div class="col-auto my-auto d-none d-xxl-block">
            <i class="far fa-hand-point-right fa-5x"></i>
        </div>
        <div class="col-auto mb-2">
            <div class="card" style="width:18rem;">
                <div class="card-header text-center user-select-none h3">Számlázási címek</div>
                <div class="card-body">
                    <p>Aktív: <span class="fw-bold"> {{ count($billing_addresses->where('deleted_at', null)) }} db.</span></p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/szamlazasi-cimek') }}"
                    role="button">Számlázási címek</a>
                </div>
            </div>
        </div>
        <div class="col-auto mb-2">
            <div class="card" style="width:18rem;">
                <div class="card-header text-center user-select-none h3">Szállítási címek</div>
                <div class="card-body">
                    <p>Aktív: <span class="fw-bold"> {{ count($shipping_addresses->where('deleted_at', null)) }} db.</span></p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/szallitasi-cimek') }}"
                    role="button">Szállítási címek</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center justify-content-lg-start mt-5">
        <div class="col-auto mb-2">
            <div class="card" style="width:18rem;">
                <div class="card-header text-center user-select-none h3">Kategóriák</div>
                <div class="card-body">
                    <p>Aktív: <span class="fw-bold"> {{ count($categories->where('deleted_at', null)) }} db.</span></p>
                    <p>Inaktív: <span class="fw-bold"> {{ count($categories->where('deleted_at', '!=', null)) }} db.</span></p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/kategoriak') }}" role="button">Kategóriák</a>
                </div>
            </div>
        </div>
        <div class="col-auto my-auto d-none d-xxl-block">
            <i class="far fa-hand-point-right fa-5x"></i>
        </div>
        <div class="col-auto mb-2">
            <div class="card" style="width:18rem;">
                <div class="card-header text-center user-select-none h3">Gyártók</div>
                <div class="card-body">
                    <p>Aktív: <span class="fw-bold"> {{ count($brands->where('deleted_at', null)) }} db.</span></p>
                    <p>Inaktív: <span class="fw-bold"> {{ count($brands->where('deleted_at', '!=', null)) }} db.</span></p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/gyartok') }}"
                    role="button">Gyártók</a>
                </div>
            </div>
        </div>
        <div class="col-auto mb-2">
            <div class="card" style="width:18rem;">
                <div class="card-header text-center user-select-none h3">Tulajdonságok</div>
                <div class="card-body">
                    <p>Aktív: <span class="fw-bold"> {{ count($properties->where('deleted_at', null)) }} db.</span></p>
                    <p>Inaktív: <span class="fw-bold"> {{ count($properties->where('deleted_at', '!=', null)) }} db.</span></p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/tulajdonsagok') }}"
                    role="button">Tulajdonságok</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center justify-content-lg-start mt-5">
        <div class="col-auto">
            <div class="card" style="width:18rem;">
                <div class="card-header text-center user-select-none h3">Termékek</div>
                <div class="card-body">
                    <p>Aktív: <span class="fw-bold"> {{ count($products->where('deleted_at', null)) }} db.</span></p>
                    <p>Inaktív: <span class="fw-bold"> {{ count($products->where('deleted_at', '!=', null)) }} db.</span></p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/termekek') }}" role="button">Termékek</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center justify-content-lg-start mt-5">
        <div class="col-auto">
            <div class="card">
                <div class="card-header text-center user-select-none h3">Rendelések</div>
                <div class="card-body">
                     <p>Új megrendelések: <span class="fw-bold"> {{ count($orders->where('status', 'Új megrendelés')) }} db.</span></p>
                     <p>Folyamatban lévő megrendelések: <span class="fw-bold"> {{ count($orders->where('status', '!=', 'Új megrendelés')->where('status', '!=', 'Lezárt')->where('status', '!=', 'Törölt')) }} db.</span></p>
                     <p>Lezárt megrendelések: <span class="fw-bold"> {{ count($orders->where('status', 'Lezárt')) }} db.</span></p>
                     <p>Törölt megrendelések: <span class="fw-bold"> {{ count($orders->where('status', 'Törölt')) }} db.</span></p>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/rendelesek') }}" role="button">Rendelések</a>
                </div>
            </div>
        </div>
    </div>

@endsection
