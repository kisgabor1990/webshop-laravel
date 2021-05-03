@extends('admin.index')

@section('content')

@include('alerts.error')

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-plus fa-lg fa-fw"></i>
                    Számlázási cím módosítása
                </div>
                <form action="{{ url('admin/szamlazasi-cimek/szerkeszt/' . $billing_address->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-3 mx-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="choose_company" id="is_company"
                                        value="is_company" required @if ($billing_address->choose_company == 'is_company') checked @endif>
                                    <label class="form-check-label" for="is_company">
                                        Cég
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="choose_company" id="is_person"
                                        value="is_person" required @if ($billing_address->choose_company == 'is_person') checked @endif>
                                    <label class="form-check-label" for="is_person">
                                        Magánszemély
                                    </label>
                                    <div class="invalid-feedback">
                                        Egyet kötelező választani!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <select class="form-select" id="user_id" name="user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($billing_address->user_id == $user->id) selected @endif>{{ $user->name }} - {{ $user->email }}</option>
                                @endforeach
                            </select>
                            <label for="user_id">Felhasználó (Név - Email cím)</label>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Név"
                                value="{{ $billing_address->name }}" required>
                            <label for="name">Név</label>
                            <div class="invalid-feedback">
                                A név megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto" id="taxnumDiv">
                            <input type="text" class="form-control" id="taxnum" name="taxnum" placeholder="Adószám"
                                value="{{ $billing_address->tax_num }}" pattern="\d{8}-[1-5]-\d{2}" required>
                            <label for="taxnum">Adószám</label>
                            <div class="form-text">Helyes formátum: xxxxxxxx-y-zz</div>
                            <div class="invalid-feedback">
                                Cég esetén az adószám nem lehet üres, vagy a formátum nem megfelelő!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="city" name="city" placeholder="Város"
                                value="{{ $billing_address->address->city }}" required>
                            <label for="city">Város</label>
                            <div class="invalid-feedback">
                                A város megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Utca / Házszám"
                                value="{{ $billing_address->address->address }}" required>
                            <label for="address">Utca / Házszám</label>
                            <div class="invalid-feedback">
                                A cím megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="address2" name="address2"
                                placeholder="Emelet / Ajtó" value="{{ $billing_address->address->address2 }}">
                            <label for="address2">Emelet / Ajtó</label>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="number" class="form-control" id="zip" name="zip" placeholder="Irányítószám"
                                value="{{ $billing_address->address->zip }}" required>
                            <label for="zip">Irányítószám</label>
                            <div class="invalid-feedback">
                                Az irányítószám megadása kötelező!
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm">Mentés</button>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/szamlazasi-cimek') }}"
                            role="button">Mégsem</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
