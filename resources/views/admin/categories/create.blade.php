@extends('admin.layouts.app')

@section('title')
    Add Category
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">
                Add Category
            </h3>
            <hr>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <form action="{{ route('admin.categories.store') }}" method="post">
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