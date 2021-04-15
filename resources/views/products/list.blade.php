@extends('index')

@section('content')

<h2 class="text-center user-select-none pb-3">{{ $category_name }}</h2>
<div id="filter" class="card my-3 rounded-lg">
    <div class="card-header bg-warning text-uppercase user-select-none d-flex justify-content-between" data-toggle="collapse" data-target="#collapseFilter">
        Szűrő
        <span><i class="far fa-arrow-alt-circle-down"></i></span>
    </div>
    <div class="card-body collapse p-0" id="collapseFilter">
        <form id="productFilter" action="">
            <div class="row row-cols-2 row-cols-lg-3 mx-3">
                <div class="col">
                    <h5 class="my-3">Márkák</h5>
                    @foreach ($filterBrand as $brand)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $brand->name }}" id="brand_{{ $brand->name }}" name="brand[]">
                        <label class="form-check-label" for="brand_{{ $brand->name }}">
                            {{ $brand->name }} ({{ $brand->count }})
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="col">
                    <h5 class="my-3">Tulajdonság</h5>
                    @foreach ($filterProperty as $property)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $property->name }}" id="brand_{{ $property->name }}" name="brand[]">
                        <label class="form-check-label" for="brand_{{ $property->name }}">
                            {{ $property->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="col">
                    <h5 class="my-3">Ár</h5>
                    <div class="form-group">
                        <label for="minPrice">Min:</label>
                        <input type="number" class="form-control" id="minPrice" name="price[min]">
                    </div>
                    <div class="form-group">
                        <label for="maxPrice">Max:</label>
                        <input type="number" class="form-control" id="maxPrice" name="price[max]">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary m-3">Szűrés</button>
                <button type="reset" id="resetButton" class="btn btn-danger m-3">Összes szűrő törlése</button>

            </div>
        </form>
    </div>
</div>
<hr>
<h4 class="text-center my-3">{{ $products->total() }} db. termék</h4>


<div class="row row-cols-1 row-cols-lg-3">
    @foreach ($products as $product)
    <div class="col mb-5 card-group">
        <div class="card shadow">
            <img class="card-img-top" src="https://via.placeholder.com/362x500/DDDDDD/808080?text=Kép+termékről" alt="Card image cap">
            <div class="card-body">
                <a href="{{ url('/termekek/' . $product->id) }}" class="text-reset text-decoration-none stretched-link">
                    <h5 class="card-title">{{ $product->property }} {{ $product->type }}</h5>
                </a>
                <p class="card-text">{{ $product->brand }}</p>
            </div>
            <div class="card-footer text-end">
                <b class="text-muted">{{ number_format($product->price, 0, ',', ' ') }} Ft.</b>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col d-flex justify-content-center">
        {{ $products->onEachSide(1)->links() }}
    </div>
</div>

@endsection