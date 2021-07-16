@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-edit fa-lg fa-fw"></i>
                    Felhasználó módosítása
                </div>
                <form action="{{ url('admin/felhasznalok/szerkeszt/' . $user->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Teljes név" value="{{ $user->name }}" required>
                            <label for="name">Név</label>
                            <div class="invalid-feedback">
                                A név megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="email" class="form-control" id="email" name="email" placeholder="valami@valami.hu" value="{{ $user->email }}"
                                required>
                            <label for="email">Email cím</label>
                            <div class="invalid-feedback">
                                Az email cím megadása kötelező és valósnak kell lennie!
                            </div>
                        </div>
                        @if ($user->is_admin != 2)
                            <div class="col-12 col-lg-6 orm-check form-switch shadow-lg rounded-pill mb-3 mx-auto">
                                <input class="form-check-input" type="checkbox" id="isAdmin" name="isAdmin" value="true"
                                @if ($user->is_admin) checked @endif>
                                <label class="form-check-label" for="isAdmin">
                                    Admin
                                </label>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm">Mentés</button>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/felhasznalok') }}" role="button">Mégsem</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
