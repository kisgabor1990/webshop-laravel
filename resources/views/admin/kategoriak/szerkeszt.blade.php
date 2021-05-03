@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-edit fa-lg fa-fw"></i>
                    Kategória módosítása
                </div>
                <form action="{{ url('admin/kategoriak/szerkeszt/' . $category->id) }}" method="POST"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Kategória név"
                                value="{{ $category->name }}" required>
                            <label for="name">Kategória név</label>
                            <div class="invalid-feedback">
                                A név megadása kötelező!
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mb-3 mx-auto">
                            <p class="h4">Márkák:</p>
                            @forelse ($brands as $brand)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $brand->id }}"
                                        id="brand_{{ $brand->name }}" name="brands[]"
                                        @if (in_array($brand->id, $category->brands->pluck('id')->toArray())) checked @endif
                                        >
                            <label class="form-check-label" for="brand_{{ $brand->name }}">
                                {{ $brand->name }} @if ($brand->trashed()) (inaktív) @endif
                            </label>
                        </div>
                        @empty
                            <p class="h6">Jelenleg nincs márka rögzítve!</p>
                            @endforelse
                        </div>
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
