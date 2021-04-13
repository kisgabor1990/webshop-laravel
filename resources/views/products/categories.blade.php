@extends('index')

@section('content')

<h2 class="text-center user-select-none pb-5">Kategóriák</h2>

<div class="row row-cols-1 row-cols-lg-3">
    @foreach ($categories as $category)
    <div class="col mb-5 card-group">
        <div class="card shadow">
            <img class="card-img-top" src="https://via.placeholder.com/362x500/DDDDDD/808080?text=Kép+termékről" alt="Card image cap">
            <div class="card-body">
                <a href="{{ url('/termekek/' . $category->slug) }}" class="text-reset text-decoration-none stretched-link">
                    <h5 class="card-title text-center">{{ $category->name }}</h5>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection