@extends('index')

@section('content')

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
                    <div class="col mb-5 card-group">
                        <div class="card shadow">
                            <img class="card-img-top px-3 pt-3"
                                src="https://via.placeholder.com/180x250/DDDDDD/808080?text=Kép+termékről"
                                alt="Card image cap">
                            <div class="card-body">
                                <div class="col-auto h5 user-select-none text-center mt-0" style="color: gold">
                                    @php
                                        $rating = $product->ratingsAvg();
                                    @endphp
                                    @foreach (range(1, 5) as $i)
                                        <span class="fa-stack" style="width:1em">
                                            <i class="far fa-star fa-stack-1x"></i>
                                            @if ($rating > 0)
                                                @if ($rating > 0.5)
                                                    <i class="fas fa-star fa-stack-1x"></i>
                                                @else
                                                    <i class="fas fa-star-half fa-stack-1x"></i>
                                                @endif
                                            @endif
                                            @php $rating--; @endphp
                                        </span>
                                    @endforeach
                                </div>
                                <a href="{{ url('/termekek/' . $product->id) }}"
                                    class="text-reset text-decoration-none stretched-link">
                                    <h5 class="card-title">{{ $product->property }} {{ $product->type }}</h5>
                                </a>
                                <p class="card-text">{{ $product->brand }}</p>
                                <p class="card-text mt-5">
                                <h6>Termékjellemzők:</h6>
                                <ul>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                </ul>
                                </p>
                            </div>
                            <div class="card-footer text-end">
                                <b class="h4 text-muted">{{ number_format($product->price, 0, ',', ' ') }} Ft.</b>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <div class="alert alert-warning text-end mb-0">Legújabb termékeink!</div>
        </div>
    </div>

@endsection
