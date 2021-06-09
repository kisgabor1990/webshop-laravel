<div class="modal-header">
    <h5 class="modal-title" id="loginModalLabel">Bejelentkezés</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ url('/bejelentkezes') }}" method="post" class="needs-validation" novalidate>
<div class="modal-body">
        @csrf
        <div class="col-12 col-lg-8 mx-auto form-group mb-3">
            <label for="email">Email cím</label>
            <input type="email" class="form-control" id="login_email" name="email" required>
            <div class="invalid-feedback">
                Az email cím megadása kötelező és valósnak kell lennie!
            </div>
        </div>
        <div class="col-12 col-lg-8 mx-auto form-group mb-3">
            <label for="password">Jelszó</label>
            <input type="password" class="form-control" id="login_password" name="password" required>
            <div class="invalid-feedback">
                A jelszó megadása kötelező!
            </div>
        </div>
    </div>
    <div class="modal-footer text-center">
        <button type="submit" class="btn btn-primary">Bejelentkezés</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
        <a class="dropdown-item" href="{{ url('/regisztracio') }}">Nincs még fiókja? Regisztráljon!</a>
        <a class="dropdown-item" href="{{ url('/elfelejtett-jelszo') }}">Elfelejtette jelszavát?</a>
    </div>
</form>