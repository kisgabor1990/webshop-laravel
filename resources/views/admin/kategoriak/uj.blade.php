@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-plus fa-lg fa-fw"></i>
                    Új kategória
                </div>
                <form action="{{ url('admin/kategoriak/uj') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Kategróia név"
                                value="{{ old('name') }}" required>
                            <label for="name">Kategória név</label>
                            <div class="invalid-feedback">
                                A név megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mb-3 mx-auto">
                            <p class="h4">Gyártók:</p>
                            @forelse ($brands as $brand)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $brand->id }}"
                                        id="brand_{{ $brand->name }}" name="brands[]" @if(is_array(old('brands')) && in_array($brand->id, old('brands'))) checked @endif>
                                    <label class="form-check-label" for="brand_{{ $brand->name }}">
                                        {{ $brand->name }} @if ($brand->trashed()) (inaktív) @endif
                                    </label>
                                </div>
                            @empty
                                <p class="h6">Jelenleg nincs gyártó rögzítve!</p>
                            @endforelse
                        </div>
                        <div class="col-12 col-lg-6 form-check form-switch mb-3 mx-auto">
                            <input class="form-check-input" type="checkbox" id="add_values" name="add_values">
                            <label class="form-check-label" for="add_values">Alkategóriák létrehozása</label>
                        </div>
                        <fieldset disabled>
                            <div class="col-12 col-lg-6 mb-3 mx-auto" id="values" style="display: none">
                                <div class="col-12 d-block-inline mb-3 text-center">
                                    <a class="btn btn-primary btn-sm" id="add_value" href="#" role="button">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm">Mentés</button>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/kategoriak') }}" role="button">Mégsem</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
