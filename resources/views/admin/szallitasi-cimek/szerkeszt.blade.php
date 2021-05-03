@extends('admin.index')

@section('content')

    @include('alerts.error')

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-plus fa-lg fa-fw"></i>
                    Szállítási cím módosítása
                </div>
                <form action="{{ url('admin/szallitasi-cimek/szerkeszt/' . $shipping_address->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <select class="form-select" id="user_id" name="user_id">
                                <option value="" @if ($shipping_address->user_id == "") selected @endif>Nem tartozik felhasználóhoz!</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($shipping_address->user_id == $user->id) selected @endif>{{ $user->name }} - {{ $user->email }}</option>
                                @endforeach
                            </select>
                            <label for="user_id">Felhasználó (Név - Email cím)</label>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Név"
                                value="{{ $shipping_address->name }}" required>
                            <label for="name">Név</label>
                            <div class="invalid-feedback">
                                A név megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mb-3 mx-auto">
                            <div class="input-group">
                                <div class="input-group-prepend d-flex align-items-stretch">
                                    <div class="input-group-text" id="btnGroupAddon">+36</div>
                                </div>
                                <div class="col form-floating">
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $shipping_address->phone }}"
                                    placeholder="Telefonszám" required>
                                    <label for="phone">Telefonszám</label>
                                    <div class="invalid-feedback">
                                        A telefonszám megadása kötelező!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="city" name="city" placeholder="Város"
                                value="{{ $shipping_address->address->city }}" required>
                            <label for="city">Város</label>
                            <div class="invalid-feedback">
                                A város megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Utca / Házszám"
                                value="{{ $shipping_address->address->address }}" required>
                            <label for="address">Utca / Házszám</label>
                            <div class="invalid-feedback">
                                A cím megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="address2" name="address2"
                                placeholder="Emelet / Ajtó" value="{{ $shipping_address->address->address2 }}">
                            <label for="address2">Emelet / Ajtó</label>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="number" class="form-control" id="zip" name="zip" placeholder="Irányítószám"
                                value="{{ $shipping_address->address->zip }}" required>
                            <label for="zip">Irányítószám</label>
                            <div class="invalid-feedback">
                                Az irányítószám megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <textarea class="form-control" placeholder="Megjegyzés" id="comment" name="comment" style="height: 100px">{{ $shipping_address->comment }}</textarea>
                            <label for="comment">Megjegyzés</label>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm">Mentés</button>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/szallitasi-cimek') }}"
                            role="button">Mégsem</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
