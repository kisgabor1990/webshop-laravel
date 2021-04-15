@extends('index')

@section('content')

    <div class="col-12 col-lg-6">
        @include('alerts.error')
        @include('alerts.success')
        <div class="card">
            <div class="card-header bg-success text-white">Bejelentkezés</div>
            <div class="card-body">
                <form action="{{ url('/bejelentkezes') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email">Email cím</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">
                            Az email cím megadása kötelező és valósnak kell lennie!
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Jelszó</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="invalid-feedback">
                            A jelszó megadása kötelező!
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <button type="submit" class="btn btn-primary">Bejelentkezés</button>
                    </div>
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('/regisztracio') }}">Nincs még fiókja? Regisztráljon!</a>
                <a class="dropdown-item" href="{{ url('/elfelejtett-jelszo') }}">Elfelejtette jelszavát?</a>
            </div>
        </div>
    </div>

@endsection
