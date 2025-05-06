<div class="col-md-4">
    <div class="card bg-white rounded shadow-sm">
        <div class="card-header bg-white text-center">
            <h3 class="mt-2">
                Add your review
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('review.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title*</label>
                    <input
                        type="text"
                        class="form-control @error('title') is-invalid @enderror"
                        name="title"
                        id="title"
                        aria-describedby="helpId"
                        placeholder="Title*"
                        value="{{ old('title') }}"
                    />
                    @error('title')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating*</label>
                    <div>
                        @for ($i = 1; $i <= 5; $i++ )
                            <i class="fas fa-star fa-xl star" 
                                data-value="{{ $i }}"
                            ></i>
                        @endfor
                    </div>
                    <input
                        type="hidden"
                        class="form-control @error('rating') is-invalid @enderror"
                        name="rating"
                        id="rating"
                    />
                    <input
                        type="hidden"
                        name="product_id"
                        value="{{ $product->id }}"
                    />
                    @error('rating')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Review*</label>
                    <textarea
                        rows="5"
                        cols="30"
                        class="form-control  @error('body') is-invalid @enderror"
                        name="body"
                        id="body"
                        placeholder="Review*"
                    >{{ old('body') }}</textarea>
                    @error('body')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="btn btn-dark w-100" type="submit">
                    Write a Review
                </button>
            </form>
        </div>
    </div>
</div>