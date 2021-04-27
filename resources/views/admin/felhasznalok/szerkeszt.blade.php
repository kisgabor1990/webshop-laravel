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
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Jelszó">
                            <label for="password">Jelszó</label>
                            <div class="invalid-feedback">
                                A jelszó megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Jelszó újra">
                            <label for="password_confirmation">Jelszó újra</label>
                            <div class="invalid-feedback">
                                A jelszó megadása kötelező!
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm">Mentés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
