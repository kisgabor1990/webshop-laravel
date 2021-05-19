@extends('index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-5">
            <!--Carousel Wrapper-->
            <div id="carousel-thumb" class="carousel shadow slide carousel-thumbnails" data-bs-ride="carousel">
                <!--Slides-->
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item text-center active">
                        <img class="img-fluid"
                        src="{{ url($product->coverImage()->path) }}" alt="{{ $product->name }}" style="height: 550px; object-fit: contain;">
                    </div>
                    @foreach ($product->images->where('isCover', 0) as $image)
                    <div class="carousel-item text-center">
                        <img class="img-fluid"
                        src="{{ url($image->path) }}" alt="{{ $product->name }}" style="height: 550px; object-fit: contain;">
                    </div>
                    @endforeach
                </div>
                <!--/.Slides-->
                <!--Controls-->
                <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-thumb" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <!--/.Controls-->
                <ol class="carousel-indicators">
                    @foreach ($product->images as $key => $image)
                    <li data-bs-target="#carousel-thumb" data-bs-slide-to="{{ $key }}" class="active"> <img
                        class="d-block w-100 img-fluid"
                        src="{{ url($image->path) }}">
                    </li>
                    @endforeach
                </ol>
            </div>
            <!--/.Carousel Wrapper-->
        </div>
        <div class="col-12 col-lg-7 mt-3">
            <div class="row">
                <div class="col-auto h2 user-select-none" style="color: gold">
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
                <div class="col-auto h5 d-flex align-items-center">
                    ({{ number_format($product->ratingsAvg(), 1, '.', ' ') }} /
                    {{ $product->ratingsCount() }} értékelés)</div>
            </div>
            <p class="h2">{{ $product->name }}</p>
            <p class="h6">{{ $product->brand->name }}</p>
            <hr>
            <p class="h1">{{ number_format($product->price, 0, ',', ' ') }} Ft.</p>
            <p class="mt-5"><a id="addToCartButton" class="btn btn-outline-success rounded-circle shadow"
                    href="{{ url('/kosarba-rakom/' . $product->slug) }}" data-bs-tooltip="tooltip" data-placement="right"
                    title="Kosárba rakom!"><i class="fas fa-cart-plus fa-fw"></i></a></p>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-header  bg-light">
                    <ul class="nav nav-tabs card-header-tabs " id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#description"
                                role="tab" aria-controls="description" aria-selected="true">Leírás</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="info-tab" data-bs-toggle="tab" href="#info" role="tab"
                                aria-controls="info" aria-selected="false">Jellemzők</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="info-tab" data-bs-toggle="tab" href="#rate" role="tab"
                                aria-controls="rate" aria-selected="false">Vélemények</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body shadow border border-top-0">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="description-tab">
                            {{ $product->description }}
                        </div>
                        <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <div class="col-12 col-lg-4">

                                <table class="table table-hover">
                                    <tbody>
                                        @foreach ($product->properties as $property)
                                        <tr class="border-top-0">
                                            <th class="user-select-none" scope="row">{{ $property->name }}:</th>
                                            <td>{{ $property->pivot->value }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="rate" role="tabpanel" aria-labelledby="info-tab">
                            @auth
                                @if ($user->rated()->contains('id', $product->id))
                                    <div class="text-center my-3">
                                        <p class="h5 user-select-none">Az Ön véleménye:</p>
                                        <p class="user-select-none" style="color: gold">
                                            @for ($i = 0; $i < $myOpinion->rate; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </p>
                                        <p>
                                            {{ $myOpinion->comment }}
                                        </p>
                                        <p>
                                        <div class="btn-group   !spacing" role="group" aria-label="edit">
                                            <a class="btn btn-primary"
                                                href="{{ url('/termekek/' . $product->id . '/velemeny/szerkesztes') }}"
                                                role="button">Szerkesztés </a>
                                            <a class="btn btn-danger"
                                                href="{{ url('/termekek/' . $product->id . '/velemeny/torles') }}"
                                                role="button">Törlés </a>
                                        </div>
                                        </p>
                                    </div>

                                @else
                                    <form action="{{ url('/termekek/' . $product->id . '/velemeny') }}" method="POST"
                                        class="needs-validation" novalidate>
                                        @csrf
                                        <div class="col-12 col-lg-6 offset-lg-3">
                                            <div class="d-flex justify-content-center mb-3">

                                                <div class="rating">
                                                    <label>
                                                        <input type="radio" name="stars" value="1">
                                                        <span class="icon">★</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="stars" value="2">
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="stars" value="3">
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="stars" value="4">
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="stars" value="5" checked>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                        <span class="icon">★</span>
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="form-check mb-3">
                                                <label id="opinion_label" for="opinion" class="required">Az Ön
                                                    véleménye:</label>
                                                <textarea id="opinion" name="opinion" rows="5" class="form-control"
                                                    required></textarea>
                                                <div class="invalid-feedback">
                                                    A mező nem lehet üres!
                                                </div>
                                            </div>
                                            <div class="text-center"><button type="submit" class="btn btn-primary">Küld</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            @endauth
                            @guest
                                <div class="text-center my-3">
                                    <p class="h3">Vélemény írásához be kell jelentkezni!</p>
                                </div>
                            @endguest
                            <hr>

                            @forelse ($opinions as $opinion)
                                <div class="row">
                                    <div class="col-12 col-lg-10 user-select-none">
                                        <span class="fw-bold">{{ $opinion->name }}</span>
                                        ({{ $opinion->updated_at->format('Y, M j') }})
                                    </div>
                                    <div class="col-12 col-lg-2 user-select-none text-lg-end" style="color: gold">
                                        @for ($i = 0; $i < $opinion->rate; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </div>
                                    <div class="col my-3 px-4 px-lg-5">
                                        {{ $opinion->comment }}
                                    </div>
                                    <hr>
                                </div>
                            @empty
                                <div class="col-12">
                                    Még nincs vélemény a termékről!
                                </div>

                            @endforelse
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
                    <div class="card-body">
                        <div class="col-auto text-center">
                            <img class="img-fluid px-3 pt-3"
                                src="{{ url($product->coverImage()->path) }}"
                                alt="Card image cap" style="height: 300px">
                        </div>
                        <div class="col-auto h5 user-select-none text-center mt-0" style="color: gold">
                            @php
                                $rating = $product->ratings->avg();
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
                        <a href="{{ url('/termekek/' . $product->category->slug . '/' . $product->subCategory->slug . '/' . $product->slug) }}"
                            class="text-reset text-decoration-none stretched-link">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="h6">{{ $product->brand->name }}</p>
                        </a>
                        {{-- <p class="card-text mt-3">
                        <h6>Termékjellemzők:</h6>
                        <ul>
                            @foreach ($product->properties as $property)
                            <li><span class="fw-bold">{{ $property->name }}:</span> {{ $property->pivot->value }}</li>
                            @endforeach
                        </ul>
                        </p> --}}
                    </div>
                    <div class="card-footer text-end">
                        <b class="h4 text-muted">{{ number_format($product->price, 0, ',', ' ') }} Ft.</b>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
        <div class="alert alert-warning text-end mb-0">Hasonló termékek!</div>
    </div>
</div>

@if (session()->has('success'))
    <div class="modal fade" id="addToCartSuccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center h4">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>

@endif

@endsection

@section('scripts')
<script>
    var myModal = new bootstrap.Modal(document.getElementById('addToCartSuccess'))
    @if (session()->has('success'))
        myModal.show();
        setTimeout(function () {
        myModal.hide();
        },2000)
    @endif

</script>
@endsection
