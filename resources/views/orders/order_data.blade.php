@extends('index')

@section('content')

    <h1 class="user-select-none mb-5 text-center">Adatok megadása</h1>

    <div class="position-relative m-4 user-select-none">
        <div class="progress" style="height: 30px;">
            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
        <span
            class="position-absolute top-50 translate-middle circle text-primary border border-primary border-5 rounded-circle"
            style="left: 25%;">1</span>
        <span
            class="position-absolute top-50 translate-middle circle text-secondary border border-200 border-5 rounded-circle"
            style="left: 50%;">2</span>
        <span
            class="position-absolute top-50 translate-middle circle text-secondary border border-200 border-5 rounded-circle"
            style="left: 75%;">3</span>
        <span
            class="position-absolute top-50 translate-middle circle text-secondary border border-200 border-5 rounded-circle"
            style="left: 100%;">4</span>
    </div>
    <div class="position-relative m-4 d-none d-lg-block">
        <span class="position-absolute top-50 translate-middle" style="left: 25%;">Adatok megadása</span>
        <span class="position-absolute top-50 translate-middle" style="left: 50%;">Fizetés és szállítás</span>
        <span class="position-absolute top-50 translate-middle" style="left: 75%;">Adatok ellenőrzése</span>
        <span class="position-absolute top-50 translate-middle text-nowrap" style="left: 100%;">Megrendelés elküldése</span>
    </div>
    <form class="needs-validation" action="{{ url('/megrendeles/adatok') }}" method="post" novalidate>
        @csrf
        <div class="card mb-5" style="margin-top: 6rem;">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Kapcsolattartó adatok
            </div>
            <div class="card-body py-5">
                <div class="col-12 col-lg-6 offset-lg-3">
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Teljes név"
                            value="{{ session('customer') ? session('customer.name') : $user->name ?? old('name') }}" required>
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
                                value="{{ session('customer') ? session('customer.phone') : $user->shipping_address->phone ?? old('phone') }}"
                                placeholder="Telefonszám" required>
                            <label for="phone">Telefonszám</label>
                            <div class="invalid-tooltip">
                                A telefonszám megadása kötelező!
                            </div>
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="valami@valami.hu"
                            value="{{ session('customer') ? session('customer.email') : $user->email ?? old('email') }}" required>
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
                            value="is_company" required @if ( (session('customer') && session('customer.choose_company') == 'is_company') || (!session('customer') && ($user?->billing_address->choose_company == "is_company" || old('choose_company') == 'is_company'))) checked @endif>
                        <label class="form-check-label" for="is_company">
                            Cég
                        </label>
                    </div>
                    <div class="form-check form-check-inline position-relative mb-5">
                        <input class="form-check-input" type="radio" name="choose_company" id="is_person" value="is_person"
                            required @if ((session('customer') && session('customer.choose_company') == 'is_person') || (!session('customer') && ($user?->billing_address->choose_company == "is_person" || old('choose_company') == 'is_person'))) checked @endif>
                        <label class="form-check-label" for="is_person">
                            Magánszemély
                        </label>
                        <div class="invalid-tooltip">
                            Egyet kötelező választani!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="billing_name" name="billing_name" placeholder="Név"
                            value="{{ session('customer') ? session('customer.billing_name') : $user->billing_address->name ?? old('billing_name') }}" required>
                        <label for="billing_name">Név</label>
                        <div class="invalid-tooltip">
                            A név megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5" id="taxnumDiv">
                        <input type="text" class="form-control" id="taxnum" name="taxnum" placeholder="Adószám"
                            value="{{ session('customer') ? session('customer.taxnum') : $user->billing_address->tax_num ?? old('taxnum') }}" pattern="\d{8}-[1-5]-\d{2}" required>
                        <label for="taxnum">Adószám</label>
                        <div class="form-text">Helyes formátum: xxxxxxxx-y-zz</div>
                        <div class="invalid-tooltip">
                            Cég esetén az adószám nem lehet üres, vagy a formátum nem megfelelő!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="Város"
                            value="{{ session('customer') ? session('customer.billing_city') : $user->billing_address->address->city ?? old('billing_city') }}" required>
                        <label for="billing_city">Város</label>
                        <div class="invalid-tooltip">
                            A város megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="billing_address" name="billing_address"
                            placeholder="Utca / Házszám" value="{{ session('customer') ? session('customer.billing_address') : $user->billing_address->address->address ?? old('billing_address') }}" required>
                        <label for="billing_address">Utca / Házszám</label>
                        <div class="invalid-tooltip">
                            A cím megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="billing_address2" name="billing_address2"
                            placeholder="Emelet / Ajtó" value="{{ session('customer') ? session('customer.billing_address2') : $user->billing_address->address->address2 ?? old('billing_address2') }}">
                        <label for="billing_address2">Emelet / Ajtó</label>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="number" class="form-control" id="billing_zip" name="billing_zip"
                            placeholder="Irányítószám" value="{{ session('customer') ? session('customer.billing_zip') : $user->billing_address->address->zip ?? old('billing_zip') }}" min="1000" max="9999" required>
                        <label for="billing_zip">Irányítószám</label>
                        <div class="invalid-tooltip">
                            Az irányítószám megadása kötelező!
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="shipping_same" name="shipping_same" value="true"
                            @if (session('customer.shipping_same') || old('shipping_same')) checked @endif>
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
                            value="{{ session('customer') ? session('customer.shipping_name') : $user->shipping_address->name ?? old('shipping_name') }}" required>
                        <label for="shipping_name">Név</label>
                        <div class="invalid-tooltip">
                            A név megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="shipping_city" name="shipping_city" placeholder="Város"
                            value="{{ session('customer') ? session('customer.shipping_city') : $user->shipping_address->address->city ?? old('shipping_city') }}" required>
                        <label for="shipping_city">Város</label>
                        <div class="invalid-tooltip">
                            A város megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                            placeholder="Utca / Házszám" value="{{ session('customer') ? session('customer.shipping_address') : $user->shipping_address->address->address ?? old('shipping_address') }}" required>
                        <label for="shipping_address">Utca / Házszám</label>
                        <div class="invalid-tooltip">
                            A cím megadása kötelező!
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control" id="shipping_address2" name="shipping_address2"
                            placeholder="Emelet / Ajtó" value="{{ session('customer') ? session('customer.shipping_address2') : $user->shipping_address->address->address2 ?? old('shipping_address2') }}">
                        <label for="shipping_address2">Emelet / Ajtó</label>
                    </div>
                    <div class="form-floating">
                        <input type="number" class="form-control" id="shipping_zip" name="shipping_zip"
                            placeholder="Irányítószám" value="{{ session('customer') ? session('customer.shipping_zip') : $user->shipping_address->address->zip ?? old('shipping_zip') }}" min="1000" max="9999" required>
                        <label for="shipping_zip">Irányítószám</label>
                        <div class="invalid-tooltip">
                            Az irányítószám megadása kötelező!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-5 position-relative bg-white p-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="aszf" name="aszf" value="true" required>
                <label class="form-check-label" for="aszf">
                    Elfogadom az <a class="info" role="button" data-href="{{ url('/aszf') }}" data-bs-toggle="modal"
                        data-bs-target="#infoModal">Általános szerződési feltételek</a>et és az <a class="info"
                        role="button" data-href="{{ url('/adatkezeles') }}" data-bs-toggle="modal"
                        data-bs-target="#infoModal">Adatkezelési tájékoztató</a>t.
                </label>
                <div class="invalid-tooltip">
                    Az ÁSZF elfogadása kötelező!
                </div>
            </div>
        </div>
        <div class="col-12 mb-5 text-center">
            <button type="submit" class="btn btn-dark">Tovább</button>
        </div>
    </form>

@endsection
