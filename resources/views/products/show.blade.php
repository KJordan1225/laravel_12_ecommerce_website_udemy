@extends('layouts.app')


@section('title')
    {{ $product->name }}
@endsection


@section('content')
    <div class="row my-2">
        <div class="col-md-12">
            <div class="bg-white shadow-sm p-3">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="carousel slide" id="productsCarousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img 
                                        src="{{ asset($product->thumbnail) }}" 
                                        class="card-img-top d-block w-100 rounded" 
                                        alt="{{ $product->name }}">
                                </div>
                                @if ($product->first_image)
                                    <div class="carousel-item">
                                        <img 
                                            src="{{ asset($product->first_image) }}" 
                                            class="card-img-top d-block w-100 rounded" 
                                            alt="{{ $product->name }}">
                                    </div>
                                @endif
                                @if ($product->second_image)
                                    <div class="carousel-item">
                                        <img 
                                            src="{{ asset($product->second_image) }}" 
                                            class="card-img-top d-block w-100 rounded" 
                                            alt="{{ $product->name }}">
                                    </div>
                                @endif
                                @if ($product->third_image)
                                    <div class="carousel-item">
                                        <img 
                                            src="{{ asset($product->third_image) }}" 
                                            class="card-img-top d-block w-100 rounded" 
                                            alt="{{ $product->name }}">
                                    </div>
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#productsCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productsCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="row thumbnails-row mt-3">
                            <div class="col-md-3">
                                <div class="thumbnail-row active" data-bs-target="#productsCarousel" data-bs-slide="0">
                                    <img 
                                        src="{{ asset($product->thumbnail) }}" 
                                        alt="{{ $product->name }}">
                                </div>
                            </div>
                            @if ($product->first_image)
                                <div class="col-md-3">
                                    <div class="thumbnail-row" data-bs-target="#productsCarousel" data-bs-slide="1">
                                        <img 
                                            src="{{ asset($product->first_image) }}" 
                                            alt="{{ $product->name }}">
                                    </div>
                                </div>
                            @endif
                            @if ($product->second_image)
                                <div class="col-md-3">
                                    <div class="thumbnail-row" data-bs-target="#productsCarousel" data-bs-slide="2">
                                        <img 
                                            src="{{ asset($product->second_image) }}" 
                                            alt="{{ $product->name }}">
                                    </div>
                                </div>
                            @endif
                            @if ($product->third_image)
                                <div class="col-md-3">
                                    <div class="thumbnail-row" data-bs-target="#productsCarousel" data-bs-slide="3">
                                        <img 
                                            src="{{ asset($product->third_image) }}" 
                                            alt="{{ $product->name }}">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h1>{{ $product->name }}</h1>
                        {{-- here the reviews avg --}}
                        @if($product->reviews->count())
                            <div class="d-flex gap-2 align-items-center">
                                <span>
                                    @for ($i = 1; $i <= 5; $i++ )
                                        <i class="fas fa-star {{ $i <= $product->avgRating() ? 'text-warning' : '' }}"></i>
                                    @endfor
                                </span>
                                <h4 class="text-muted mt-1">
                                    ({{ $product->reviews->count() }}
                                    {{ $product->reviews->count() > 1 ? 'Reviews' : 'Review'}})
                                </h4>
                            </div>
                        @endif
                        <p class="d-flex my-4">
                            @if ($product->old_price)
                                <span class="text-decoration-line-through fs-4 text-danger">
                                    ${{ $product->old_price }}
                                </span>
                            @endif
                            <span class="fw-bold text-dark fs-4 mx-3">${{ $product->price }}</span>
                            @if ($product->discount)
                                <span class="badge bg-dark fs-4">-{{ $product->discount }}%</span>
                            @endif
                        </p>
                        <p class="d-flex gap-2">
                            <span class="text-secondary">
                                <i class="fas fa-tag"></i> {{ $product->category->name }}
                            </span>
                            <span class="text-success">
                                <i class="fas fa-layer-group"></i> {{ $product->subcategory->name }}
                            </span>
                            <span class="text-danger">
                                <i class="fas fa-table-list"></i> {{ $product->childcategory->name }}
                            </span>
                        </p>
                        <div class="d-flex justify-content-between align-items-center my-2">
                            @if ($product->status)
                                <span class="badge bg-success">In Stock</span>
                            @else  
                                <span class="badge bg-danger">Out Of Stock</span>
                            @endif
                        </div>
                        <p>
                            {!! $product->description !!}
                        </p>
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="mb-4">
                                <h4 class="mb-2">Choose a size</h4>
                                <div class="d-flex gap-2">
                                    @foreach ($product->sizes as $size)
                                        <input 
                                            type="radio" 
                                            name="size" 
                                            id="size-{{ $size->id }}"
                                            class="d-none"
                                            value="{{ $size->name }}"
                                        >
                                        <label 
                                            for="size-{{ $size->id }}" 
                                            class="btn btn-light size-btn d-flex justify-content-center align-items-center">
                                            {{ $size->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-4">
                                <h4 class="mb-2">Choose a color</h4>
                                <div class="d-flex gap-2">
                                    @foreach ($product->colors as $color)
                                        <input 
                                            type="radio" 
                                            name="color" 
                                            id="color-{{ $color->id }}"
                                            class="d-none"
                                            value="{{ $color->name }}"
                                        >
                                        <label 
                                            for="color-{{ $color->id }}" 
                                            class="color-option"
                                            style="background-color:{{ $color->name }};"  
                                            title="{{ ucfirst($color->name) }}"  
                                        >
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <input 
                                    type="number" 
                                    name="qty" 
                                    max="{{ $product->qty }}"
                                    min="1"
                                    value="1"
                                    class="form-control w-auto"
                                >
                                <button type="submit"
                                    class="btn btn-primary {{ !$product->status ? 'disabled' : '' }}"
                                >
                                   <i class="fas fa-shopping-cart"></i> Add to cart
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @include('reviews.reviews-list')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        //add active class to the active image 
        const thumbnails = document.querySelectorAll('.thumbnail-row');
        const carousel = document.querySelector('#productsCarousel');

        carousel.addEventListener('slide.bs.carousel', (e) => {
            thumbnails.forEach(el => el.classList.remove('active'));
            thumbnails[e.to].classList.add('active');
        });
        // add the active class to the chosen size
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            });
        });
        // add the active class to the chosen color
        document.querySelectorAll('.color-option').forEach(opt => {
            opt.addEventListener('click', () => {
                document.querySelectorAll('.color-option').forEach(o => o.classList.remove('active'));
                opt.classList.add('active');
            });
        });
        //add text warning to stars and get the rating
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating');
    
            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    const rating = star.getAttribute('data-value');
                    ratingInput.value = rating;
    
                    stars.forEach((s, i) => {
                        s.classList.toggle('text-warning', i < rating);
                    });
                });
            });
        });
    </script>
@endsection