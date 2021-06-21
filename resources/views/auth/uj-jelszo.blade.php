@extends('index')

@section('content')


    <div class="col-12 col-lg-6">
        <form action="{{ url('/uj-jelszo') }}" method="post" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="card">
                <div class="card-header">Új jelszó megadása</div>
                <div class="card-body">
                    <p>Kérjük adja meg az új jelszavát!</p>
                    <div class="form-group col-8 offset-2 mb-3">
                        <label for="email">Email cím</label>
                        <input type="email" class="form-control" id="reg_email" name="email" value="{{ $email }}"
                            required>
                        <div class="invalid-feedback">
                            Az email cím megadása kötelező és valósnak kell lennie!
                        </div>
                    </div>
                    <div class="form-group col-8 offset-2 mb-3">
                        <label for="password">Jelszó</label>
                        <input type="password" class="form-control" id="new_password" name="password" required>
                        <div class="invalid-feedback">
                            A jelszó megadása kötelező!
                        </div>
                    </div>
                    <div class="form-group col-8 offset-2 mb-3">
                        <label for="password_confirmation">Jelszó mégegyszer</label>
                        <input type="password" class="form-control" id="new_password2" name="password_confirmation"
                            required>
                        <div class="invalid-feedback">
                            A jelszó megadása kötelező!
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-secondary">Mentés</button>
                </div>
            </div>
        </form>
    </div>

@endsection
