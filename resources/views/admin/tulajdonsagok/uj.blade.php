@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-plus fa-lg fa-fw"></i>
                    Új tulajdonság
                </div>
                <form action="{{ url('admin/tulajdonsagok/uj') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <select class="form-select" id="category_id" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }} @if ($category->trashed()) (inaktív) @endif</option>
                                @endforeach
                            </select>
                            <label for="category_id">Kategória</label>
                        </div>
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tulajdonság név" value="{{ old('name') }}" required>
                            <label for="name">Tulajdonság név</label>
                            <div class="invalid-feedback">
                                A név megadása kötelező!
                            </div>
                        </div>
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
