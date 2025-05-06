@extends('admin.layouts.app')

@section('title')
    Add Product
@endsection

@section('styles')
    @error('description')
        <style>
            .note-editor {
                border: 1px solid red !important;
            }
        </style>
    @enderror
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">
                Add Product
            </h3>
            <hr>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="text" 
                                                class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="floatingName"
                                                value="{{ old('name') }}"
                                                placeholder="Name*">
                                            <label for="floatingName">Name*</label>
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea 
                                                cols="30" 
                                                rows="5" 
                                                class="form-control summernote @error('description') is-invalid @enderror"
                                                name="description" 
                                                id="floatingDescription"
                                                placeholder="Description*">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" 
                                                class="form-control @error('qty') is-invalid @enderror"
                                                name="qty" id="floatingName"
                                                value="{{ old('qty') }}"
                                                placeholder="Quantity*">
                                            <label for="floatingName">Quantity*</label>
                                            @error('qty')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" 
                                                class="form-control @error('price') is-invalid @enderror"
                                                name="price" id="floatingName"
                                                value="{{ old('price') }}"
                                                placeholder="Price*">
                                            <label for="floatingName">Price*</label>
                                            @error('price')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" 
                                                class="form-control @error('old_price') is-invalid @enderror"
                                                name="old_price" id="floatingName"
                                                value="{{ old('old_price') }}"
                                                placeholder="Old Price*">
                                            <label for="floatingName">Old Price*</label>
                                            @error('old_price')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Category*</label>
                                            <select
                                                class="form-select @error('category_id') is-invalid @enderror"
                                                name="category_id"
                                                id="category_id"
                                            >
                                                <option value="" selected disabled>Choose a category</option>
                                                @foreach ($categories as $category)
                                                    <option 
                                                        value="{{ $category->id }}"
                                                        @if (old('category_id') == $category->id)
                                                            selected
                                                        @endif    
                                                    >{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="subcategory_id" class="form-label">Subcategory*</label>
                                            <select
                                                class="form-select @error('subcategory_id') is-invalid @enderror"
                                                name="subcategory_id"
                                                id="subcategory_id"
                                            >
                                                <option value="" selected disabled>Choose a subcategory</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option 
                                                        value="{{ $subcategory->id }}"
                                                        @if (old('subcategory_id') == $subcategory->id)
                                                            selected
                                                        @endif    
                                                    >{{ $subcategory->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('subcategory_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="childcategory_id" class="form-label">Child category*</label>
                                            <select
                                                class="form-select @error('childcategory_id') is-invalid @enderror"
                                                name="childcategory_id"
                                                id="childcategory_id"
                                            >
                                                <option value="" selected disabled>Choose a childcategory</option>
                                                @foreach ($childcategories as $childcategory)
                                                    <option 
                                                        value="{{ $childcategory->id }}"
                                                        @if (old('childcategory_id') == $childcategory->id)
                                                            selected
                                                        @endif    
                                                    >{{ $childcategory->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('childcategory_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="brand_id" class="form-label">Brand*</label>
                                            <select
                                                class="form-select @error('brand_id') is-invalid @enderror"
                                                name="brand_id"
                                                id="brand_id"
                                            >
                                                <option value="" selected disabled>Choose a brand</option>
                                                @foreach ($brands as $brand)
                                                    <option 
                                                        value="{{ $brand->id }}"
                                                        @if (old('brand_id') == $brand->id)
                                                            selected
                                                        @endif    
                                                    >{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="color_id" class="form-label">Colors*</label>
                                            <select
                                                class="form-select @error('color_id') is-invalid @enderror"
                                                name="color_id[]"
                                                id="color_id"
                                                multiple
                                            >
                                                <option value="" selected disabled>Choose a color</option>
                                                @foreach ($colors as $color)
                                                    <option 
                                                        value="{{ $color->id }}"
                                                        @if (collect(old('color_id'))->contains($color->id))
                                                            selected
                                                        @endif    
                                                    >{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('color_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="size_id" class="form-label">Sizes*</label>
                                            <select
                                                class="form-select @error('size_id') is-invalid @enderror"
                                                name="size_id[]"
                                                id="size_id"
                                                multiple
                                            >
                                                <option value="" selected disabled>Choose a size</option>
                                                @foreach ($sizes as $size)
                                                    <option 
                                                        value="{{ $size->id }}"
                                                        @if (collect(old('size_id'))->contains($size->id))
                                                            selected
                                                        @endif      
                                                    >{{ $size->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('size_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Thumbnail*</label>
                                            <input
                                                type="file"
                                                class="form-control @error('thumbnail') is-invalid @enderror"
                                                name="thumbnail"
                                                id="thumbnail"
                                                onchange="previewImage(event,'image_preview_main')"
                                            />
                                            @error('thumbnail')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                            <img src="#" alt="thumbnail"
                                                id="image_preview_main"
                                                class="d-none img-fluid rounded mb-2"
                                                width="100"
                                                height="100"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <label for="first_image" class="form-label">First Image*</label>
                                            <input
                                                type="file"
                                                class="form-control @error('first_image') is-invalid @enderror"
                                                name="first_image"
                                                id="first_image"
                                                onchange="previewImage(event,'image_preview_first')"
                                            />
                                            @error('first_image')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                            <img src="#" alt="first_image"
                                                id="image_preview_first"
                                                class="d-none img-fluid rounded mb-2"
                                                width="100"
                                                height="100"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <label for="second_image" class="form-label">Second Image*</label>
                                            <input
                                                type="file"
                                                class="form-control @error('second_image') is-invalid @enderror"
                                                name="second_image"
                                                id="second_image"
                                                onchange="previewImage(event,'image_preview_second')"
                                            />
                                            @error('second_image')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                            <img src="#" alt="second_image"
                                                id="image_preview_second"
                                                class="d-none img-fluid rounded mb-2"
                                                width="100"
                                                height="100"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <label for="third_image" class="form-label">Third Image*</label>
                                            <input
                                                type="file"
                                                class="form-control @error('third_image') is-invalid @enderror"
                                                name="third_image"
                                                id="third_image"
                                                onchange="previewImage(event,'image_preview_third')"
                                            />
                                            @error('third_image')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                            <img src="#" alt="third_image"
                                                id="image_preview_third"
                                                class="d-none img-fluid rounded mb-2"
                                                width="100"
                                                height="100"
                                            >
                                        </div>
                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-sm btn-dark">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function previewImage(event, previewId) {
            const preview = document.getElementById(previewId);
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');  // Show the preview image
                }

                reader.readAsDataURL(file);  // Read the image as a data URL
            }
        }
    </script>
@endsection