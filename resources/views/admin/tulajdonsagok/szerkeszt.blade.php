@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-edit fa-lg fa-fw"></i>
                    Tulajdonság módosítása
                </div>
                <form action="{{ url('admin/tulajdonsagok/szerkeszt/' . $property->id) }}" method="POST"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tulajdonság név"
                                value="{{ $property->name }}" required>
                            <label for="name">Tulajdonság név</label>
                            <div class="invalid-feedback">
                                A név megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 form-check form-switch mb-3 mx-auto">
                            <input class="form-check-input" type="checkbox" id="add_values" name="add_values" @if ($property->hasList) checked @endif>
                            <label class="form-check-label" for="add_values">Lista létrehozása a tulajdonsághoz</label>
                        </div>
                        <fieldset disabled>
                            <div class="col-12 col-lg-6 mb-3 mx-auto" id="values" style="display: none">
                                <div class="col-12 d-block-inline mb-3 text-center">
                                    <a class="btn btn-primary btn-sm" id="add_value" href="#" role="button">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </a>
                                </div>
                                @foreach ($property->values as $value)
                                    <div class="input-group mb-5 edit_value{{ $value->id }}">
                                        <div class="col form-floating position-relative">
                                            <input type="tel" class="form-control" name="values[]"
                                                value="{{ $value->name }}" placeholder="Érték" required>
                                            <label>Érték</label>
                                            <div class="invalid-tooltip">
                                                Az érték megadása kötelező!
                                            </div>
                                        </div>
                                        <div class="input-group-prepend d-flex align-items-stretch">
                                            <div class="input-group-text" id="btnGroupAddon">
                                                <a class="btn btn-danger btn-sm remove_value" data-id="edit_value{{ $value->id }}"
                                                    href="#" role="button">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm">Mentés</button>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/tulajdonsagok') }}" role="button">Mégsem</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
