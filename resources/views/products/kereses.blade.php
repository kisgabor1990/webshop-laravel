@extends('index')

@section('content')

    <div class="col-12 mb-5 text-center">
        <h2 class="user-select-none">Találatok a következőre: {{ $query }}</h2>
    </div>
    
    <hr>
    <h4 class="text-center my-3">{{ $products->total() }} db. termék</h4>


    <div class="row row-cols-1 row-cols-lg-3">
        @foreach ($products as $product)
            @include('pages.product_card')
        @endforeach
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            {{ $products->onEachSide(1)->appends(request()->all())->links() }}
        </div>
    </div>

@endsection
