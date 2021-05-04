@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-5 mb-5">
            <div class="card">
                <div class="card-header text-center user-select-none h3">{{ $product->id }} - {{ $product->model }} @if ($product->trashed()) (inaktív) @endif</div>
                <div class="card-body">
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
                                                <tr class="@if ($property->trashed()) table-dark @endif">
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
                                    <th scope="row" class="user-select-none">Leírás:</th>
                                    <td>{{ $product->description }}</td>
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
                <div class="card-footer text-start">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/termekek') }}" role="button">Vissza</a>
                </div>
            </div>
        </div>
    </div>

@endsection
