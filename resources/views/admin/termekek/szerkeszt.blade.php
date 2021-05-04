@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-edit fa-lg fa-fw"></i>
                    Termék szerkesztése
                </div>
                <form action="{{ url('admin/termekek/szerkeszt/' . $product->id) }}" method="POST"
                    class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $product->category->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="col-12 col-lg-8 form-floating mb-3 mx-auto">
                                    <select class="form-select" id="brand_id" name="brand_id">
                                        @foreach ($product->category->brands as $brand)
                                            <option value="{{ $brand->id }}" @if ($brand->id == $product->brand->id) selected @endif>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="brand_id">Gyártó</label>
                                </div>
                                <div class="col-12 col-lg-8 form-floating mb-3 mx-auto">
                                    <input type="text" class="form-control" id="model" name="model" placeholder="Model"
                                        value="{{ $product->model }}" required>
                                    <label for="model">Model</label>
                                    <div class="invalid-feedback">
                                        A model megadása kötelező!
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8 form-floating mb-3 mx-auto">
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Ár"
                                        value="{{ $product->price }}" required>
                                    <label for="price">Ár</label>
                                    <div class="invalid-feedback">
                                        Az ár megadása kötelező!
                                    </div>
                                </div>
                                @foreach ($product->properties as $property)
                                    <div class="col-12 col-lg-8 form-floating mb-3 mx-auto">
                                        <input type="text" class="form-control" id="property_{{ $property->name }}"
                                            name="properties[{{ $property->id }}][value]"
                                            placeholder="{{ $property->name }}" value="{{ $property->pivot->value }}" required>
                                        <label for="property_{{ $property->name }}">{{ $property->name }}</label>
                                        <div class="invalid-feedback">
                                            A(z) {{ $property->name }} megadása kötelező!
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="col-12 form-floating mb-3 mx-auto">
                                    <textarea class="form-control" placeholder="Leírás" id="description" name="description"
                                        style="height: 200px" required>{{ $product->description }}</textarea>
                                    <label for="description">Leírás</label>
                                    <div class="invalid-feedback">
                                        A leírás megadása kötelező!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm">Mentés</button>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/termekek') }}" role="button">Mégsem</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
