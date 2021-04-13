@extends('index')

@section('content')

    @include('alerts.error')
    @include('alerts.success')


    <div class="w-100">
        <div class="card">

            <div class="card-header bg-success text-white">Regisztráció</div>
            <div class="card-body">
                <form id="regForm" class="needs-validation" action="{{ url('/regisztracio') }}" method="post" novalidate>
                    @csrf
                    <div class="row">

                        <div class="col-12 col-lg-6 mb-5">
                            <p class="h3 mb-5">Regisztrációs adatok</p>

                            <div class="form-group mb-3">
                                <label for="email">Email cím</label>
                                <input type="email" class="form-control" id="reg_email" name="email"
                                    value="{{ old('email') }}" required>
                                <div class="invalid-feedback">
                                    Az email cím megadása kötelező és valósnak kell lennie!
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Jelszó</label>
                                <input type="password" class="form-control" id="reg_password" name="password" required>
                                <div class="invalid-feedback">
                                    A jelszó megadása kötelező!
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Jelszó mégegyszer</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                                <div class="invalid-feedback">
                                    A jelszó megadása kötelező!
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="choose_company" id="is_company"
                                    value="is_company" required @if (old('choose_company') == 'is_company') checked @endif>
                                <label class="form-check-label" for="is_company">
                                    Cég
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="choose_company" id="is_person"
                                    value="is_person" required @if (old('choose_company') == 'is_person') checked @endif>
                                <label class="form-check-label" for="is_person">
                                    Magánszemély
                                </label>
                                <div class="invalid-feedback">
                                    Egyet kötelező választani!
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mb-5">
                            <p class="h3 mb-5">Kapcsolattartó adatok</p>
                            <div class="form-group mb-3">
                                <label for="phone">Telefonszám</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" id="btnGroupAddon">+36</div>
                                    </div>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone') }}" required>
                                    <div class="invalid-feedback">
                                        A telefonszám megadása kötelező!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mb-5">
                            <p class="h3 mb-5">Számlázási adatok</p>
                            <div class="form-group mb-3">
                                <label for="billing_name">Teljes név</label>
                                <input type="text" class="form-control" id="billing_name" name="billing_name"
                                    value="{{ old('billing_name') }}" required>
                                <div class="invalid-feedback">
                                    A név megadása kötelező!
                                </div>
                            </div>
                            <div id="taxnum" class="form-group mb-3" @if (old('choose_company') == 'is_person') style="display: none" @endif>
                                <label for="billing_taxnum">Cég esetén adószám</label>
                                <input type="number" class="form-control" id="billing_taxnum" name="billing_taxnum"
                                    value="{{ old('billing_taxnum') }}" required>
                                <div class="invalid-feedback">
                                    Az adószám megadása cég esetén kötelező!
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="billing_city">Város</label>
                                <input type="text" class="form-control" id="billing_city" name="billing_city"
                                    value="{{ old('billing_city') }}" required>
                                <div class="invalid-feedback">
                                    A város megadása kötelező!
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="billing_address">Utca / Házszám</label>
                                <input type="text" class="form-control" id="billing_address" name="billing_address"
                                    value="{{ old('billing_address') }}" required>
                                <div class="invalid-feedback">
                                    A lakcím megadása kötelező!
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="billing_zip">Irányítószám</label>
                                <input type="number" class="form-control" id="billing_zip" name="billing_zip"
                                    value="{{ old('billing_zip') }}" required>
                                <div class="invalid-feedback">
                                    Az irányítószám megadása kötelező!
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="shipping_same" name="shipping_same"
                                    value="true" @if (old('shipping_same')) checked @endif>
                                <label class="form-check-label" for="shipping_same">
                                    A szállítási adatok megegyeznek a számlázási adatokkal.
                                </label>
                            </div>
                        </div>
                        <div id="shippingData" class="col-12 col-lg-6 mb-5" @if (old('shipping_same')) style="display: none" @endif>
                            <p class="h3 mb-5">Szállítási adatok</p>
                            <div class="form-group mb-3">
                                <label for="shipping_name">Teljes név</label>
                                <input type="text" class="form-control" id="shipping_name" name="shipping_name"
                                    value="{{ old('shipping_name') }}" required>
                                <div class="invalid-feedback">
                                    A név megadása kötelező!
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="shipping_city">Város</label>
                                <input type="text" class="form-control" id="shipping_city" name="shipping_city"
                                    value="{{ old('shipping_city') }}" required>
                                <div class="invalid-feedback">
                                    A város megadása kötelező!
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="shipping_address">Utca / Házszám</label>
                                <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                                    value="{{ old('shipping_address') }}" required>
                                <div class="invalid-feedback">
                                    A lakcím megadása kötelező!
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="shipping_zip">Irányítószám</label>
                                <input type="number" class="form-control" id="shipping_zip" name="shipping_zip"
                                    value="{{ old('shipping_zip') }}" required>
                                <div class="invalid-feedback">
                                    Az irányítószám megadása kötelező!
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-5">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="aszf" name="aszf" value="true" required>
                                <label class="form-check-label" for="aszf">
                                    Elfogadom az Általános szerződési feltételeket és az Adatkezelési tájékoztatót.
                                </label>
                                <div class="invalid-feedback">
                                    Az ÁSZF elfogadása kötelező!
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-success">Regisztráció</button>
            </div>
            </form>
        </div>
    </div>

@endsection
