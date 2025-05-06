<div class="row my-3 bg-light p-4">
    <div class="col-md-8">
        {{-- the reviews list here --}}
        <div class="card border-0">
            <div class="card-header bg-white">
                <h3 class="mt-2">
                   Ratings & Reviews ({{ $product->reviews->count() }})
                </h3>
            </div>
            <div class="card-body">
                @if($product->reviews->count())
                    <ul class="list-group my-4">
                        @foreach ($product->reviews as $review)    
                            <li class="list-group-item bg-light d-flex justify-content-between align-items-center">
                                <img 
                                    src="{{ asset($review->user->imagePath()) }}" 
                                    class="rounded-circle" 
                                    alt="{{ $review->user->name }}"
                                    width="50"
                                    height="50"    
                                >
                                <div class="ms-2 me-auto">
                                    <span class="fw-bold">
                                        {{ $review->title }}
                                    </span>
                                    <p class="m-0">
                                        {{ $review->body }}
                                    </p>
                                    <div class="text-body-secondary">
                                        By {{ $review->user->name }} - <span class="text-danger">
                                            {{ $review->created_at }}
                                        </span>
                                    </div>
                                    <div>
                                        @for ($i = 1; $i <= 5; $i++ )
                                            <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : '' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="row my-3">
                        <div class="col-md-6 mx-auto">
                            <div class="alert alert-info">
                                No reviews yet!
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @auth
        @if($product->isBoughtByUser($product->id))
            @include('reviews.add-review')
        @endif
    @endauth
</div>