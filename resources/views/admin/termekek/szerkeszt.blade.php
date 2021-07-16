@extends('admin.index')

@section('content')

    <div class="row">
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header user-select-none h3">
                    <i class="fas fa-edit fa-lg fa-fw"></i>
                    Termék szerkesztése
                </div>
                <form action="{{ url('admin/termekek/szerkeszt/' . $product->id) }}" method="POST"
                    class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $product->category->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                @if ($product->category->subCategories->count())
                                <div class="col-12 col-lg-10 form-floating mb-3 mx-auto">
                                    <select class="form-select" id="subcategory_id" name="subcategory_id">
                                        @foreach ($product->category->subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}" @if ($subCategory->id == $product->subCategory?->id) selected @endif>{{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="subcategory_id">Alkategória</label>
                                </div>
                                @endif
                                <div class="col-12 col-lg-10 form-floating mb-3 mx-auto">
                                    <select class="form-select" id="brand_id" name="brand_id">
                                        @foreach ($product->category->brands as $brand)
                                            <option value="{{ $brand->id }}" @if ($brand->id == $product->brand->id) selected @endif>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="brand_id">Gyártó</label>
                                </div>
                                <div class="col-12 col-lg-10 form-floating mb-3 mx-auto">
                                    <input type="text" class="form-control" id="model" name="model" placeholder="Megnevezés"
                                        value="{{ $product->model }}" required>
                                    <label for="model">Megnevezés</label>
                                    <div class="invalid-feedback">
                                        A megnevezés megadása kötelező!
                                    </div>
                                </div>
                                <div class="col-12 col-lg-10 form-floating mb-3 mx-auto">
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Ár"
                                        value="{{ $product->price }}" required>
                                    <label for="price">Ár</label>
                                    <div class="invalid-feedback">
                                        Az ár megadása kötelező!
                                    </div>
                                </div>
                                @foreach ($product->category->properties as $property)
                                <div class="col-12 col-lg-10 form-floating mb-3 mx-auto @if ($property->trashed()) text-white @endif">
                                    @if ($property->hasList)
                                        <select class="form-select @if ($property->trashed()) bg-dark text-white @endif" id="property_{{ $property->name }}" name="values[{{ $property->id }}][value]">
                                            @foreach ($property->values->sortBy('name') as $value)
                                                <option value="{{ $value->name }}"@if ($product->properties->find($property->id)->pivot->value == $value->name) selected @endif>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="property_{{ $property->name }}">{{ $property->name }}</label>
                                    @else
                                        <input type="text" class="form-control @if ($property->trashed()) bg-dark text-white @endif" id="property_{{ $property->name }}"
                                            name="values[{{ $property->id }}][value]"
                                            placeholder="{{ $property->name }}"
                                            value="{{ $product->properties->find($property->id)?->pivot->value }}" required>
                                        <label for="property_{{ $property->name }}">{{ $property->name }}</label>
                                        <div class="invalid-feedback">
                                            A(z) {{ strtolower($property->name) }} megadása kötelező!
                                        </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            <div class="col-12 col-lg-8">
                                <p class="h4 user-select-none my-3 mt-lg-0">Leírás</p>
                                <div class="col-12 form-floating mb-3 mx-auto">
                                    <textarea class="form-control" placeholder="Leírás" id="description" name="description"
                                        style="height: 200px" required>{{ $product->description }}</textarea>
                                    <div class="invalid-feedback">
                                        A leírás megadása kötelező!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="h4 user-select-none my-3">Képek</p>
                        <div class="row row-cols-1 row-cols-lg-4">
                            @foreach ($product->images->sortBy('id') as $image)
                                <div class="col mb-3 image_{{ $image->id }}">
                                    <input type="hidden" name="images[]" value="{{ $image->id }}">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" 
                                                    name="cover_image" id="cover_image_{{ $image->id }}"
                                                    value="{{ $image->id }}" @if ($image->isCover) checked @endif required>
                                                <label class="form-check-label" for="cover_image_{{ $image->id }}">
                                                  {{ $image->isCover ? 'Maradjon ez a borítókép' : 'Legyen ez a borítókép' }}
                                                </label>
                                                <div class="invalid-feedback">
                                                    Egyet kötelező választani!
                                                </div>
                                              </div>
                                        </div>
                                        <div class="card-body row align-items-center">
                                            <img src="{{ url($image->path) }}" class="img-fluid" alt="{{ $product->model }}">
                                        </div>
                                        @if (!$image->isCover)
                                        <div class="card-footer text-center">
                                            <a class="btn btn-outline-danger btn-sm remove_value" data-id="image_{{ $image->id }}" href="#" role="button">
                                                <i class="fa fa-times fa-fw fa-lg" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-4 mb-3">
                                <label for="images">További képek</label>
                                <input type="file" class="form-control" id="images" name="new_images[]" placeholder="További képek"
                                    multiple accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm">Mentés</button>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/termekek') }}" role="button">Mégsem</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ), {
            toolbar: {
					items: [
						'heading',
						'|',
						'alignment',
						'bold',
						'italic',
						'underline',
						'|',
						'link',
						'|',
						'bulletedList',
						'numberedList',
						'|',
						'indent',
						'outdent',
						'|',
						'insertTable',
						'mediaEmbed',
						'horizontalLine',
						'|',
						'undo',
						'redo'
					]
				},
				language: 'hu',
					licenseKey: '',
				} )
				.then( editor => {
					window.editor = editor;
				} )
				.catch( error => {
					console.error( 'Oops, something went wrong!' );
					console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
					console.warn( 'Build id: 59xuwaexfk17-yfb2zuy2g9e9' );
					console.error( error );
				} );
</script>

@endsection