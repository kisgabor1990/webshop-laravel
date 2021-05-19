@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 mb-5">
            <div class="card">
                <div class="card-header text-center user-select-none h3">{{ $product->id }} - {{ $product->name }}
                    @if ($product->trashed()) (inaktív) @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-5">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="user-select-none">Kategória:</th>
                                            <td>{{ $product->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="user-select-none">Gyártó:</th>
                                            <td>{{ $product->brand->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="user-select-none">Ár:</th>
                                            <td>{{ $product->price }} Ft.</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="user-select-none">Tulajdonságok:</th>
                                            <td>
                                                <table>
                                                    @forelse ($product->properties as $property)
                                                        <tr class="@if ($property->trashed()) bg-dark text-white @endif">
                                                            <th class="user-select-none">{{ $property->name }} </th>
                                                            <td class="ps-3">{{ $property->pivot->value }}</td>
                                                        </tr>
                                                    @empty
                                                        Nincs tulajdonság társítva!
                                                    @endforelse
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="user-select-none">Termék létrehozva:</th>
                                            <td>{{ $product->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="user-select-none">Utoljára módosítva:</th>
                                            <td>{{ $product->updated_at }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="user-select-none">Törölve:</th>
                                            <td>{{ $product->deleted_at ? 'Igen' : 'Nem' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 offset-lg-1">
                            <div class="col-12">
                                <p class="h4 user-select-none">Leírás</p>
                                {{ $product->description }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 my-5">
                            <p class="h4 user-select-none mb-3">Képek</p>
                            <div class="row">
                                @forelse ($product->images->sortBy('id') as $image)
                                    <div class="col-6 col-lg-4 mb-5 text-center">
                                        @if ($image->isCover) <p class="text-center mb-0">Borítókép</p> @endif
                                        <img src="{{ url($image->path) }}" class="img-fluid" alt="{{ $product->model }}">
                                    </div>
                                @empty
                                    <div class="col-12 mb-3">
                                        Nincsenek képek!
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-start">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/termekek') }}" role="button">Vissza</a>
                </div>
            </div>
        </div>
    </div>

@endsection
