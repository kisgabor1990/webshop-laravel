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
            <a href="{{ url('/termek/' . $product->slug) }}"
                class="text-reset text-decoration-none stretched-link">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="h6">{{ $product->brand->name }}</p>
            </a>
            <p class="card-text mt-3">
                <h6>Termékjellemzők:</h6>
                <ul>
                    @foreach ($product->properties->where('hasList', 1) as $property)
                        <li><span class="fw-bold">{{ $property->name }}:</span> {{ $property->pivot->value }}
                        </li>
                    @endforeach
                </ul>
                </p>
        </div>
        <div class="card-footer text-end">
            <b class="h4 text-muted">{{ number_format($product->price, 0, ',', ' ') }} Ft.</b>
        </div>
    </div>
</div>