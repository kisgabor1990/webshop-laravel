@extends('index')

@section('content')


    <div class="col-12 col-lg-6">
        @include('alerts.error')
        @include('alerts.success')
        <form action="{{ url('/elfelejtett-jelszo') }}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="card">
                <div class="card-header">Elfelejtett jelszó</div>
                <div class="card-body">
                    <p>Kérjük adja meg az email címét!</p>
                    <div class="form-group col-8 offset-2">
                        <label for="email">Email cím</label>
                        <input type="email" class="form-control" id="email_recovery" name="email" required>
                        <div class="invalid-feedback">
                            Az email cím megadása kötelező és valósnak kell lennie!
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-secondary">Küldés</button>
                </div>
            </div>
        </form>
    </div>

@endsection
