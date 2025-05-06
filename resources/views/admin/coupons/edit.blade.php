@extends('admin.layouts.app')

@section('title')
    Edit Coupon
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">
                Edit Coupon
            </h3>
            <hr>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <form action="{{ route('admin.coupons.update',$coupon->id) }}" method="post">
                                        @csrf
                                        @method("PUT")
                                        <div class="form-floating mb-3">
                                            <input type="text" 
                                                class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="floatingName"
                                                value="{{ old('name',$coupon->name) }}"
                                                placeholder="Name*">
                                            <label for="floatingName">Name*</label>
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" 
                                                class="form-control @error('discount') is-invalid @enderror"
                                                name="discount" id="discount"
                                                value="{{ old('discount',$coupon->discount) }}"
                                                placeholder="Discount*">
                                            <label for="discount">Discount*</label>
                                            @error('discount')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="date" 
                                                class="form-control @error('expires_at') is-invalid @enderror"
                                                name="expires_at" id="expires_at"
                                                value="{{ old('expires_at',$coupon->expires_at) }}"
                                                placeholder="Expiry Date*">
                                            <label for="expires_at">Expiry Date*</label>
                                            @error('expires_at')
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