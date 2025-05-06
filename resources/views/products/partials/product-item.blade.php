<a href="{{ route('products.show',$product->slug) }}" class="text-decoration-none text-dark">
    <div class="card position-relative h-100">
        <div class="carousel slide" id="productsCarousel-{{ $product->id }}">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset($product->thumbnail) }}" 
                        height="200"
                        class="card-img-top d-block w-100" 
                        alt="{{ $product->name }}">
                    @if ($product->discount)
                        <span class="discount-badge">-{{ $product->discount }}%</span>
                    @endif
                </div>
                @if ($product->first_image)
                    <div class="carousel-item">
                        <img src="{{ asset($product->first_image) }}" 
                            height="200"
                            class="card-img-top d-block w-100" 
                            alt="{{ $product->name }}">
                        @if ($product->discount)
                            <span class="discount-badge">-{{ $product->discount }}%</span>
                        @endif
                    </div>
                @endif
                @if ($product->second_image)
                    <div class="carousel-item">
                        <img src="{{ asset($product->second_image) }}" 
                            height="200"
                            class="card-img-top d-block w-100" 
                            alt="{{ $product->name }}">
                        @if ($product->discount)
                            <span class="discount-badge">-{{ $product->discount }}%</span>
                        @endif
                    </div>
                @endif
                @if ($product->third_image)
                    <div class="carousel-item">
                        <img src="{{ asset($product->third_image) }}" 
                            height="200"
                            class="card-img-top d-block w-100" 
                            alt="{{ $product->name }}">
                        @if ($product->discount)
                            <span class="discount-badge">-{{ $product->discount }}%</span>
                        @endif
                    </div>
                @endif
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productsCarousel-{{ $product->id }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productsCarousel-{{ $product->id }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ $product->name }}</h5>
                @if ($product->status)
                    <span class="badge bg-success">In Stock</span>
                @else  
                    <span class="badge bg-danger">Out Of Stock</span>
                @endif
            </div>
            @if($product->reviews->count())
                <div class="d-flex gap-2 align-items-center">
                    <span>
                        @for ($i = 1; $i <= 5; $i++ )
                            <i class="fas fa-star {{ $i <= $product->avgRating() ? 'text-warning' : '' }}"></i>
                        @endfor
                    </span>
                </div>
            @endif
            <p class="card-text d-flex justify-content-between align-items-center my-2">
                @if ($product->old_price)
                    <span class="text-decoration-line-through text-danger">
                        ${{ $product->old_price }}
                    </span>
                @endif
                <span class="fw-bold text-dark">${{ $product->price }}</span>
            </p>
            <div class="d-flex flex-wrap gap-1 justify-content-start align-items-center">
                @foreach ($product->colors as $color)
                    <div class="me-1 border border-light-subtle border-2" 
                        style="background-color:{{ $color->name }}; width:30px; height:30px;"></div>
                @endforeach
            </div>
            <div class="d-flex flex-wrap gap-2 mt-3">
                @foreach ($product->sizes as $size)
                    <span class="bg-light text-dark p-1 fw-bold border border-light-subtle border-2">
                        {{ $size->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</a>