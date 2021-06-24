@extends('index')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-4">
            <!--Carousel Wrapper-->
            <div id="carousel-thumb" class="carousel shadow slide carousel-thumbnails" data-bs-ride="carousel">
                <!--Slides-->
                <div class="carousel-inner" role="listbox">
                    @foreach ($images as $key => $image)
                        <div class="carousel-item text-center @if ($key==0) active @endif" data-bs-toggle="modal" data-bs-target="#galleryModal">
                            <img class="d-block w-100" src="{{ url($image->path) }}" alt="{{ $product->name }}"
                                data-bs-target="#galleryCarousel" data-bs-slide-to="{{ $key }}">
                        </div>
                    @endforeach
                </div>
                <!--/.Slides-->
                <!--Controls-->
                @if (count($images) > 1)
                    <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-thumb" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                @endif
                <!--/.Controls-->
                <ol class="carousel-indicators">
                    @foreach ($images as $key => $image)
                        <li data-bs-target="#carousel-thumb" data-bs-slide-to="{{ $key }}" class="@if ($key==0) active @endif"> <img
                                class="d-block w-100 img-fluid" src="{{ url($image->path) }}">
                        </li>
                    @endforeach
                </ol>
            </div>
            <!--/.Carousel Wrapper-->
        </div>
        {{-- Modal galéria --}}
        <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        {{-- Carousel galéria --}}
                        <div id="galleryCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
                            data-bs-interval="false">
                            <div class="carousel-inner">
                                @foreach ($images as $key => $image)
                                    <div class="carousel-item @if ($key==0) active @endif">
                                        <img src="{{ url($image->path) }}" class="d-block w-100" alt="..."
                                            data-bs-dismiss="modal">
                                    </div>
                                @endforeach
                            </div>
                            @if (count($images) > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                        {{-- /.Carousel galéria --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- /.Modal galéria --}}
        <div class="col-12 col-lg-7 mt-3">
            <div class="row">
                <div class="col-auto h2 user-select-none" style="color: gold">
                    @php
                        $rating = $product->ratings->avg('value');
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
                    ({{ number_format($product->ratings->avg('value'), 1, '.', ' ') }} /
                    {{ $product->ratings->count() }} értékelés)</div>
            </div>
            <p class="h2">{{ $product->name }}</p>
            <p class="h6">{{ $product->brand->name }}</p>
            <hr>
            <p class="h1">{{ number_format($product->price, 0, ',', ' ') }} Ft.</p>
            <p class="mt-5"><a id="addToCartButton" class="btn btn-outline-success rounded-circle shadow"
                    data-href="{{ url('/kosarba-rakom/' . $product->slug) }}" data-bs-tooltip="tooltip"
                    data-bs-placement="right" title="Kosárba rakom!"><i class="fas fa-cart-plus fa-fw"></i></a></p>
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
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <div class="col-12 col-lg-4">

                                <table class="table table-hover">
                                    <tbody>
                                        @foreach ($product->properties->whereNull('deleted_at') as $property)
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
                                @if ($product->ratings->contains('model_id', $user->id))
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
                @include('pages.product_card')
            @endforeach


        </div>
        <div class="alert alert-warning text-end mb-0">Hasonló termékek!</div>
    </div>
</div>

{{-- Modal sikeres kosárba helyezés --}}
<div class="modal fade" id="addToCartSuccess" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center h4">
                A termék sikeresen hozzá lett adva a kosárhoz!
            </div>
        </div>
    </div>
</div>
{{-- /.Modal sikeres kosárba helyezés --}}

@endsection
