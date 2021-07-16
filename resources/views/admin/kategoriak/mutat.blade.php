@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-5 mb-5">
            <div class="card">
                <div class="card-header text-center user-select-none h3">{{ $category->id }} - {{ $category->name }}
                    @if ($category->trashed()) (inaktív) @endif
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row" class="user-select-none w-50">URL:</th>
                                <td>{{ $category->slug }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Alkategóriák:</th>
                                <td>
                                        @forelse ($category->subCategories as $subCategory)
                                        <li>{{ $subCategory->name }}
                                        </li>
                                        @empty
                                        Nincs alkategória!
                                        @endforelse
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Termékek száma:</th>
                                <td>{{ count($category->products) }} db.</td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Tulajdonságok:</th>
                                <td>
                                        @forelse ($category->properties as $property)
                                        <li>{{ $property->name }} @if ($property->trashed()) (inaktív) @endif
                                        </li>
                                        @empty
                                        Nincs tulajdonság társítva!
                                        @endforelse
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="user-select-none">Gyártók:</th>
                                <td>
                                        @forelse ($category->brands as $brand)
                                        <li>{{ $brand->name }} @if ($brand->trashed()) (inaktív) @endif
                                        </li>
                                        @empty
                                        Nincs gyártó társítva!
                                        @endforelse
                                </td>
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
                                <th scope="row" class="user-select-none">Inaktív:</th>
                                <td>{{ $category->deleted_at ? 'Igen' : 'Nem' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-primary btn-sm" href="{{ url('admin/kategoriak') }}"
                    role="button">Vissza</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 offset-lg-1 mb-5">
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header text-center user-select-none h3">Termékek</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="list">
                                <thead class="user-select-none">
                                    <tr>
                                        <th>Gyártó</th>
                                        <th>Termékazonosító</th>
                                        @foreach ($category->properties as $property)
                                            <th>{{ $property->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($category->products as $product)
                                        <tr style="transform: rotate(0);">
                                            
                                                <td><a href="{{ url('admin/termekek/mutat/' . $product->id) }}" class="stretched-link text-reset text-decoration-none">{{ $product->brand->name }}</a></td>
                                                <td>{{ $product->model }}</td>
                                                @foreach ($product->properties as $property)
                                                    <td class="text-nowrap">{{ $property->pivot->value }}</td>
                                                @endforeach
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
                {{-- {{ $products->onEachSide(1)->links() }} --}}
            </div>
        </div>
    </div>

@endsection
