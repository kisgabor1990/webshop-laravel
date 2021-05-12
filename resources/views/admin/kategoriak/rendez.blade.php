@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-sort-numeric-down fa-lg fa-fw"></i> Sorba rendezés
                </div>
                <form action="{{ url('admin/kategoriak/rendez') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="col-12 col-lg-6 mb-3">
                            <ol id="sortable">
                                @foreach ($categories as $category)
                                <li class="mb-3" style="cursor: move">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="category_{{ $category->id }}"
                                        name="categories[]" placeholder="Kategróia név" value="{{ $category->name }}"
                                        readonly style="cursor: move">
                                        <span class="input-group-text"><i class="fa fa-sort fa-fw fa-lg" aria-hidden="true"></i></span>
                                      </div>
                                </li>
                                @endforeach
                            </ol>
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

@section('scripts')
    <script>
        $("#sortable").sortable({cancel: null});
        $("#sortable").disableSelection();

    </script>
@endsection
