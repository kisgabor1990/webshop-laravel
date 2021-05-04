@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-plus fa-lg fa-fw"></i>
                    Új termék
                </div>
                <form action="{{ url('admin/termekek/uj') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="col-12 col-lg-6 form-floating mb-3 mx-auto">
                            <select class="form-select" id="selected_category" name="selected_category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }} @if ($category->trashed()) (törölt) @endif</option>
                                @endforeach
                            </select>
                            <label for="selected_category">Kategória</label>
                        </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm">Tovább</button>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/termekek') }}" role="button">Mégsem</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
