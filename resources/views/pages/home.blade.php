@extends('index')

@section('content')

@include('alerts.success')
@include('alerts.error')

    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
        
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1024x600/0000FF/808080?text=Hűtők" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1024x600/00FFFF/808080?text=Fagyasztók" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1024x600/808080/0000FF?text=Mosógépek" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1024x600/DDDDDD/808080?text=Szárítók" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1024x600/777777/333333?text=Stb..." class="d-block w-100" alt="...">
            </div>
        </div>
    </div>



@endsection

@section('newest')

    <div id="newest" class="row mx-0 my-3 my-lg-5">
        <div class="col border border-warning rounded-lg p-0">
            <div class="alert alert-warning mb-5">Legújabb termékeink!</div>
            <div class="row row-cols-1 row-cols-lg-4">
                @foreach ($newest as $product)
                    @include('pages.product_card')
                @endforeach


            </div>
            <div class="alert alert-warning text-end mb-0">Legújabb termékeink!</div>
        </div>
    </div>

@endsection
