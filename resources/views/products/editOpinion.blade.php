@extends('index')

@section('content')

    <form action="{{ url('/termekek/' . $product->id . '/velemeny/modositas') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="col-12 col-lg-6 offset-lg-3">
            <div class="d-flex justify-content-center mb-3">

                <div class="rating">
                    <label>
                        <input type="radio" name="stars" value="1" @if ($myOpinion->rate == 1) checked @endif>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars" value="2" @if ($myOpinion->rate == 2) checked @endif>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars" value="3" @if ($myOpinion->rate == 3) checked @endif>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars" value="4" @if ($myOpinion->rate == 4) checked @endif>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars" value="5" @if ($myOpinion->rate == 5) checked @endif>
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
                <textarea id="opinion" name="opinion" rows="5" class="form-control" required>{{ $myOpinion->comment }}</textarea>
                <div class="invalid-feedback">
                    A mező nem lehet üres!
                </div>
            </div>
            <div class="text-center"><button type="submit" class="btn btn-success">Mentés</button>
            </div>
        </div>
    </form>

@endsection
