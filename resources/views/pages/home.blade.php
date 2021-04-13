@extends('index')

@section('content')

<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://via.placeholder.com/1024x600/0000FF/808080?text=Hűtők" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/1024x600/00FFFF/808080?text=Fagyasztók" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/1024x600/808080/0000FF?text=Mosógépek" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/1024x600/DDDDDD/808080?text=Szárítók" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/1024x600/777777/333333?text=Stb..." class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

@endsection

@section('newest')

<div id="newest" class="row mx-0 my-3 my-lg-5">
    <div class="col border border-warning rounded-lg p-0">
        <div class="alert alert-warning mb-5">Legújabb termékeink!</div>
        <div class="row row-cols-1 row-cols-lg-4">
                                        @foreach ($newest as $product)
                                            <div class="col mb-5 card-group">
                                                <div class="card shadow">
                                                    <img class="card-img-top" src="https://via.placeholder.com/362x500/DDDDDD/808080?text=Kép+termékről" alt="Card image cap">
                                                    <div class="card-body">
                                                        <a href="{{ url('/termekek/' . $product->id) }}" class="text-reset text-decoration-none stretched-link">
                                                            <h5 class="card-title">{{ $product->property }} {{ $product->type }}</h5>
                                                        </a>
                                                        <p class="card-text">{{ $product->brand }}</p>
                                                    </div>
                                                    <div class="card-footer text-right">
                                                        <b class="text-muted">{{ $product->price }} Ft.</b>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


        </div>
        <div class="alert alert-warning text-right mb-0">Legújabb termékeink!</div>
    </div>
</div>

@endsection