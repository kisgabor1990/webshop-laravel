@extends('index')

@section('content')

    <h1 class="user-select-none mb-5 text-center">Személyes adatok módosítása</h1>

    <form class="needs-validation" action="{{ url('/profil') }}" method="post" novalidate>
        @csrf
        <div class="card mb-5" style="margin-top: 6rem;">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Kapcsolattartó adatok
            </div>
            <div class="card-body py-5">
                <div class="col-12 col-lg-6 offset-lg-3">
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Teljes név"
                               value="{{ $user->name ?? old('name') }}"
                               autocomplete="name" disabled>
                        <label for="name">Név</label>
                        <div class="invalid-tooltip">
                            A név megadása kötelező!
                        </div>
                    </div>
                    <div class="input-group mb-5">
                        <div class="input-group-prepend">
                            <div class="input-group-text h-100" id="btnGroupAddon">+36</div>
                        </div>
                        <div class="col form-floating">
                            <input type="tel" class="form-control" id="phone" name="phone"
                                   value="{{ $user->shipping_address->phone ?? old('phone') }}"
                                   placeholder="Telefonszám" autocomplete="tel-national" required>
                            <label for="phone">Telefonszám</label>
                            <div class="invalid-tooltip">
                                A telefonszám megadása kötelező!
                            </div>
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="valami@valami.hu"
                               value="{{ $user->email ?? old('email') }}"
                               autocomplete="email" disabled>
                        <label for="email">Email cím</label>
                        <div class="invalid-tooltip">
                            Az email cím megadása kötelező és valósnak kell lennie!
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card mb-5">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Számlázási adatok
            </div>
            <div class="card-body py-5">
                <div class="col-12 col-lg-6 offset-lg-3">
                    <div class="form-check form-check-inline position-relative">
                        <input class="form-check-input" type="radio" name="choose_company" id="is_company"
                               value="is_company" required @if ( ($user?->billing_address?->choose_company == "is_company" || old('choose_company') == 'is_company') ) checked @endif>
                        <label class="form-check-label" for="is_company">
                            Cég
                        </label>
                    </div>
                    <div class="form-check form-check-inline position-relative mb-5">
                        <input class="form-check-input" type="radio" name="choose_company" id="is_person" value="is_person"
                               required @if ( ($user?->billing_address?->choose_company == "is_person" || old('choose_company') == 'is_person') ) checked @endif>
                        <label class="form-check-label" for="is_person">
                            Magánszemély
                        </label>
                        <div class="invalid-tooltip">
                            Egyet kötelező választani!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="billing_name" name="billing_name" placeholder="Név"
                               value="{{ $user->billing_address->name ?? old('billing_name') }}"
                               autocomplete="billing name" required>
                        <label for="billing_name">Név</label>
                        <div class="invalid-tooltip">
                            A név megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5" id="taxnumDiv">
                        <input type="text" class="form-control" id="taxnum" name="taxnum" placeholder="Adószám"
                               value="{{ $user->billing_address->tax_num ?? old('taxnum') }}" pattern="\d{8}-[1-5]-\d{2}" required>
                        <label for="taxnum">Adószám</label>
                        <div class="form-text">Helyes formátum: xxxxxxxx-y-zz</div>
                        <div class="invalid-tooltip">
                            Cég esetén az adószám nem lehet üres, vagy a formátum nem megfelelő!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="Város"
                               value="{{ $user->billing_address->address->city ?? old('billing_city') }}"
                               autocomplete="billing address-level2" required>
                        <label for="billing_city">Város</label>
                        <div class="invalid-tooltip">
                            A város megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="billing_address" name="billing_address"
                               placeholder="Utca / Házszám" value="{{ $user->billing_address->address->address ?? old('billing_address') }}"
                               autocomplete="billing address-line1" required>
                        <label for="billing_address">Utca / Házszám</label>
                        <div class="invalid-tooltip">
                            A cím megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="billing_address2" name="billing_address2"
                               placeholder="Emelet / Ajtó" value="{{ $user->billing_address->address->address2 ?? old('billing_address2') }}"
                               autocomplete="billing address-line2">
                        <label for="billing_address2">Emelet / Ajtó</label>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="number" class="form-control" id="billing_zip" name="billing_zip"
                               placeholder="Irányítószám" value="{{ $user->billing_address->address->zip ?? old('billing_zip') }}" min="1000" max="9999"
                               autocomplete="billing postal-code" required>
                        <label for="billing_zip">Irányítószám</label>
                        <div class="invalid-tooltip">
                            Az irányítószám megadása kötelező!
                        </div>
                    </div>
                    <div class="form-check form-switch py-3 shadow-lg rounded-pill">
                        <input class="form-check-input" type="checkbox" id="shipping_same" name="shipping_same" value="true">
                        <label class="form-check-label" for="shipping_same">
                            A szállítási adatok megegyeznek a számlázási adatokkal.
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-5">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Szállítási adatok
            </div>
            <div class="card-body py-5">
                <div id="shippingData" class="col-12 col-lg-6 offset-lg-3">
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="shipping_name" name="shipping_name" placeholder="Név"
                               value="{{ $user->shipping_address->name ?? old('shipping_name') }}"
                               autocomplete="shipping name" required>
                        <label for="shipping_name">Név</label>
                        <div class="invalid-tooltip">
                            A név megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="shipping_city" name="shipping_city" placeholder="Város"
                               value="{{ $user->shipping_address->address->city ?? old('shipping_city') }}"
                               autocomplete="shipping address-level2" required>
                        <label for="shipping_city">Város</label>
                        <div class="invalid-tooltip">
                            A város megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                               placeholder="Utca / Házszám" value="{{ $user->shipping_address->address->address ?? old('shipping_address') }}"
                               autocomplete="shipping address-line1" required>
                        <label for="shipping_address">Utca / Házszám</label>
                        <div class="invalid-tooltip">
                            A cím megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="shipping_address2" name="shipping_address2"
                               placeholder="Emelet / Ajtó" value="{{ $user->shipping_address->address->address2 ?? old('shipping_address2') }}"
                               autocomplete="shipping address-line2">
                        <label for="shipping_address2">Emelet / Ajtó</label>
                    </div>
                    <div class="form-floating">
                        <input type="number" class="form-control" id="shipping_zip" name="shipping_zip"
                               placeholder="Irányítószám" value="{{ $user->shipping_address->address->zip ?? old('shipping_zip') }}" min="1000" max="9999"
                               autocomplete="shipping postal-code" required>
                        <label for="shipping_zip">Irányítószám</label>
                        <div class="invalid-tooltip">
                            Az irányítószám megadása kötelező!
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

