@extends('admin.layouts.app')

@section('title')
    Edit Subcategory
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">
                Edit Subcategory
            </h3>
            <hr>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <form action="{{ route('admin.subcategories.update', $subcategory->slug) }}" method="post">
                                        @csrf
                                        @method("PUT")
                                        <div class="form-floating mb-3">
                                            <input type="text" 
                                                class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="floatingName" 
                                                value="{{ old('name',$subcategory->name) }}"
                                                placeholder="Name*">
                                            <label for="floatingName">Name*</label>
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Category*</label>
                                            <select
                                                class="form-select @error('category_id') is-invalid @enderror"
                                                name="category_id"
                                                id="category_id"
                                            >
                                                <option value="" selected disabled>Choose a category</option>
                                                @foreach ($categories as $category)
                                                    <option 
                                                        value="{{ $category->id }}"
                                                        @if (old('category_id',$subcategory->category_id) == $category->id)
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