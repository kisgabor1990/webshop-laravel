@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-plus fa-lg fa-fw"></i>
                    Új termék - {{ $category->name }}
                </div>
                <form action="{{ url('admin/termekek/uj') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="col-12 col-lg-8 form-floating mb-3 mx-auto">
                                    <select class="form-select" id="brand_id" name="brand_id">
                                        @foreach ($category->brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="brand_id">Gyártó</label>
                                </div>
                                <div class="col-12 col-lg-8 form-floating mb-3 mx-auto">
                                    <input type="text" class="form-control" id="model" name="model" placeholder="Model"
                                        value="{{ old('model') }}" required>
                                    <label for="model">Model</label>
                                    <div class="invalid-feedback">
                                        A model megadása kötelező!
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8 form-floating mb-3 mx-auto">
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Ár"
                                        value="{{ old('price') }}" required>
                                    <label for="price">Ár</label>
                                    <div class="invalid-feedback">
                                        Az ár megadása kötelező!
                                    </div>
                                </div>
                                @foreach ($category->properties as $property)
                                    @if ($property->hasList)
                                    <div class="col-12 col-lg-8 form-floating mb-3 mx-auto">
                                        <select class="form-select" id="property_{{ $property->name }}" name="values[{{ $property->id }}][value]">
                                            @foreach ($property->values->sortBy('name') as $value)
                                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="property_{{ $property->name }}">{{ $property->name }}</label>
                                    </div>
                                    @else
                                        <div class="col-12 col-lg-8 form-floating mb-3 mx-auto">
                                            <input type="text" class="form-control" id="property_{{ $property->name }}"
                                                name="values[{{ $property->id }}][value]"
                                                placeholder="{{ $property->name }}" required>
                                            <label for="property_{{ $property->name }}">{{ $property->name }}</label>
                                            <div class="invalid-feedback">
                                                A(z) {{ $property->name }} megadása kötelező!
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="col-12 col-lg-8 mb-3 mx-auto">
                                    <label for="cover_image">Borítókép</label>
                                    <input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="Borítókép"
                                        accept="image/*" required>
                                    <div class="invalid-feedback">
                                        A borítókép megadása kötelező!
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8 mb-3 mx-auto">
                                    <label for="images">További képek</label>
                                    <input type="file" class="form-control" id="images" name="images[]" placeholder="További képek"
                                        multiple accept="image/*">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="col-12 form-floating mb-3 mx-auto">
                                    <textarea class="form-control" placeholder="Leírás" id="description" name="description"
                                        style="height: 200px" required>{{ old('description') }}</textarea>
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
