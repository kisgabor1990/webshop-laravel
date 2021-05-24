@extends('index')

@section('content')

    <div class="col-12 mb-5 text-center">
        <h2 class="user-select-none">{{ $category->name }}</h2>
    </div>
    @if (!$category->category_id)
        <div class="col-12 col-lg-4 list-group mb-5">
            @foreach ($category->subCategories as $subCategory)
                <a href="{{ url('termekek/' . $category->slug . '/' . $subCategory->slug) }}"
                    class="list-group-item list-group-item-action">{{ $subCategory->name }}</a>
            @endforeach
        </div>
    @else
        <div class="col-auto mb-5">
            <a href="{{ url('termekek/' . $category->category->slug) }}" class="btn btn-outline-danger">
                <i class="fas fa-chevron-left"></i> {{ $category->category->name }}
            </a>
        </div>
    @endif
    
    <div class="accordion accordion-flush my-5" id="filter">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed bg-warning type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <i class="fas fa-filter fa-fw me-1"></i> Szűrő
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#filter">
            <div class="accordion-body">
                <form id="productFilter" action="">
                    <div class="row row-cols-2 row-cols-lg-4 mx-3">
                        <div class="col">
                            <h6 class="my-3">Gyártók</h6>
                            @foreach ($category->brands?->whereNull('deleted_at') ?? $category->category->brands->whereNull('deleted_at') as $brand)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $brand->name }}"
                                        id="brand_{{ $brand->name }}" name="brand[]">
                                    <label class="form-check-label" for="brand_{{ $brand->name }}">
                                        {{ $brand->name }} ({{ !$category->category_id ? $brand->products->where('category_id', $category->id)->count() : $brand->products->where('subcategory_id', $category->id)->count() }})
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @foreach (($category->properties?->whereNull('deleted_at') ?? $category->category->properties->whereNull('deleted_at'))->where('hasList', 1) as $property)
                            <div class="col">
                                <h6 class="my-3">{{ $property->name }}</h6>
                                @foreach ($property->values->sortBy('name') as $value)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $value->name }}"
                                            id="{{ $property->name }}_{{ $value->name }}"
                                            name="{{ $property->name }}[]">
                                        <label class="form-check-label" for="{{ $property->name }}_{{ $value->name }}">
                                            {{ $value->name }} ({{ $category->hasSubCategories ? $property->products->whereNull('brand.deleted_at')->where('pivot.value', $value->name)->count() : $property->products->whereNull('brand.deleted_at')->where('subcategory_id', $category->id)->where('pivot.value', $value->name)->count() }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <div class="col">
                            <h5 class="my-3">Ár</h5>
                            <div class="form-group">
                                <label for="minPrice" class="form-label">Min: <span id="minPrice_value" class="fw-bold"></span></label>
                                <input type="range" class="form-range" id="minPrice" name="price[min]"
                                min="0" max="{{ $products->max('price') }}"
                                step="1000" value="0">
                            </div>
                            <div class="form-group">
                                <label for="maxPrice" class="form-label">Max: <span id="maxPrice_value" class="fw-bold"></span></label>
                                <input type="range" class="form-range" id="maxPrice" name="price[max]"
                                min="0" max="{{ round($products->max('price'), -3) }}"
                                step="1000" value="{{ round($products->max('price'), -3) }}">
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
        </div>
      </div>
    <hr>
    <h4 class="text-center my-3">{{ $products->total() }} db. termék</h4>


    <div class="row row-cols-1 row-cols-lg-3">
        @foreach ($products->whereNull('brand.deleted_at') as $product)
            @include('pages.product_card')
        @endforeach
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            {{ $products->onEachSide(1)->links() }}
        </div>
    </div>

@endsection
