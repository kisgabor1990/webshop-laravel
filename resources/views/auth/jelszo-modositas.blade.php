@extends('index')

@section('content')

    <h1 class="user-select-none mb-5 text-center">Jelszó módosítása</h1>

    <form class="needs-validation" action="{{ url('/profil/jelszo-modositas') }}" method="post" novalidate>
    @csrf
        <div class="card mb-5">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Jelenlegi jelszó
            </div>
            <div class="card-body py-5">
                <div class="col-12 col-lg-6 offset-lg-3">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Jelszó"
                               autocomplete="current-password" required>
                        <label for="old_password">Jelszó</label>
                        <div class="invalid-tooltip">
                            A jelszó megadása kötelező!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-5">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Új jelszó
            </div>
            <div class="card-body py-5">
                <div class="col-12 col-lg-6 offset-lg-3">
                    <div class="form-floating mb-5">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Jelszó"
                               autocomplete="new-password" required>
                        <label for="password">Jelszó</label>
                        <div class="invalid-tooltip">
                            A jelszó megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                               placeholder="Jelszó újra" autocomplete="new-password" required>
                        <label for="password_confirmation">Jelszó újra</label>
                        <div class="invalid-tooltip">
                            A jelszó megadása kötelező!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-5 text-center">
            <button type="submit" class="btn btn-dark">Módosítás</button>
        </div>

    </form>

@endsection

