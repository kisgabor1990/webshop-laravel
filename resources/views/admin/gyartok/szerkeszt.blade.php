@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-6">
            @include('alerts.error')
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-edit fa-lg fa-fw"></i>
                    Gyártó módosítása
                </div>
                <form action="{{ url('admin/gyartok/szerkeszt/' . $brand->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Gyártó név" value="{{ $brand->name }}" required>
                            <label for="name">Gyártó név</label>
                            <div class="invalid-feedback">
                                A név megadása kötelező!
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm">Mentés</button>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/gyartok') }}" role="button">Mégsem</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
