@extends('index')

@section('content')

<div class="row"> 
    <div class="col-12 col-lg-5">
        <!--Carousel Wrapper-->
        <div id="carousel-thumb" class="carousel shadow slide carousel-thumbnails" data-ride="carousel">
            <!--Slides-->
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="https://via.placeholder.com/350x500/DDDDDD/808080?text=Kép+termékről" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://via.placeholder.com/350x500/DDDDDD/808080?text=Kép+termékről" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://via.placeholder.com/350x500/DDDDDD/808080?text=Kép+termékről" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://via.placeholder.com/350x500/DDDDDD/808080?text=Kép+termékről" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://via.placeholder.com/350x500/DDDDDD/808080?text=Kép+termékről" alt="Third slide">
                </div>
            </div>
            <!--/.Slides-->
            <!--Controls-->
            <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <!--/.Controls-->
            <ol class="carousel-indicators">
                <li data-target="#carousel-thumb" data-slide-to="0" class="active"> <img class="d-block w-100 img-fluid" src="https://via.placeholder.com/35x50/DDDDDD/808080?text=Kép+termékről"></li>
                <li data-target="#carousel-thumb" data-slide-to="1"><img class="d-block w-100 img-fluid" src="https://via.placeholder.com/35x50/DDDDDD/808080?text=Kép+termékről"></li>
                <li data-target="#carousel-thumb" data-slide-to="2"><img class="d-block w-100 img-fluid" src="https://via.placeholder.com/35x50/DDDDDD/808080?text=Kép+termékről"></li>
                <li data-target="#carousel-thumb" data-slide-to="3"><img class="d-block w-100 img-fluid" src="https://via.placeholder.com/35x50/DDDDDD/808080?text=Kép+termékről"></li>
                <li data-target="#carousel-thumb" data-slide-to="4"><img class="d-block w-100 img-fluid" src="https://via.placeholder.com/35x50/DDDDDD/808080?text=Kép+termékről"></li>
            </ol>
        </div>
        <!--/.Carousel Wrapper-->
    </div>
    <div class="col-12 col-lg-7 pt-5">
        <p class="h2">{{ $product->property }} {{ $product->type }}</p>
        <p class="h6">{{ $product->brand }}</p>
        <hr>
        <p class="h1">{{ $product->price }} Ft.</p>
        <p class="mt-5"><a id="addToCartButton" class="btn btn-outline-success shadow" href="#" data-tooltip="tooltip" data-placement="right" title="Kosárba rakom!"><i class="fas fa-cart-plus"></i></a></p>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <div class="card border-0">
            <div class="card-header  bg-light">
                <ul class="nav nav-tabs card-header-tabs " id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Leírás</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Általános információ</a>
                    </li>
                </ul>
            </div>
            <div class="card-body shadow border border-top-0">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        Leírás
                    </div>
                    <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <table class="table table-hover">
                            <tbody>
                                <tr class="border-top-0">
                                    <th scope="row">Márka:</th>
                                    <td>márka</td>
                                </tr>
                                <tr>
                                    <th scope="row">Típus:</th>
                                    <td>típus</td>
                                </tr>
                                <tr>
                                    <th scope="row">Méretek:</th>
                                    <td>méret szé x ho x ma Cm</td>
                                </tr>
                                <tr>
                                    <th scope="row">Szín:</th>
                                    <td>Fehér</td>
                                </tr>
                                <tr>
                                    <th scope="row">Garancia: </th>
                                    <td>2 év</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('similar')

<div id="similar" class="row mx-0 my-3 my-lg-5">
    <div class="col border border-warning rounded-lg p-0">
        <div class="alert alert-warning mb-5">Hasonló termékek!</div>
        <div class="row row-cols-1 row-cols-lg-4">
                                        @foreach ($similar as $product)
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
        <div class="alert alert-warning text-right mb-0">Hasonló termékek!</div>
    </div>
</div>

@endsection