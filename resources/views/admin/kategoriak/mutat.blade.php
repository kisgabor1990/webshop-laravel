@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-5 mb-5">
            <div class="card">
                <div class="card-header text-center user-select-none h3">{{ $category->id }} - {{ $category->name }} @if ($category->trashed()) (inaktív) @endif</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row" class="user-select-none w-50">URL:</th>
                                <td>{{ $category->slug }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Kategória létrehozva:</th>
                                <td>{{ $category->created_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Utoljára módosítva:</th>
                                <td>{{ $category->updated_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Törölve:</th>
                                <td>{{ $category->deleted_at ? 'Igen' : 'Nem' }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Termékek száma:</th>
                                <td>{{ $products->total() }} db.</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Tulajdonságok:</th>
                                <td>
                                    <ul>
                                        @forelse ($category->properties as $property)
                                        <li>{{ $property->name }} @if ($property->trashed()) (inaktív) @endif</li>
                                        @empty
                                        Nincs tulajdonság társítva!
                                        @endforelse
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Márkák:</th>
                                <td>
                                    <ul>
                                        @forelse ($brands as $brand)
                                        <li>{{ $brand->name }} @if ($brand->trashed()) (inaktív) @endif</li>
                                        @empty
                                        Nincs márka társítva!
                                        @endforelse
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-start">
                    <a class="btn btn-primary btn-sm " href="{{ url('admin/kategoriak') }}" role="button">Vissza</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 offset-lg-1 mb-5">
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header text-center user-select-none h3">Termékek</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="user-select-none">
                                    <tr>
                                        <th>Márka</th>
                                        <th>Termékazonosító</th>
                                        <th>Tulajdonság</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>{{ $product->brand }}</td>
                                            <td></td>
                                            <td class="text-nowrap">{{ $product->property }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Nincs termék a kategóriában!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                {{ $products->onEachSide(1)->links() }}
            </div>
        </div>
    </div>

@endsection
