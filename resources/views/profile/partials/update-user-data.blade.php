<div class="col-md-7">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="text-center my-2">
                {{ request()->routeIs('user.profile') ? "User Details" : "Billing Details" }}
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('user.data') }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="address" class="form-label">Address*</label>
                    <input
                        type="text"
                        class="form-control @error('address') is-invalid @enderror"
                        name="address"
                        id="address"
                        placeholder="Address*"
                        value="{{ old('address', auth()->user()->address) }}"
                    />
                    @error('address')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number*</label>
                    <input
                        type="text"
                        class="form-control @error('phone_number') is-invalid @enderror"
                        name="phone_number"
                        id="phone_number"
                        placeholder="Phone Number*"
                         value="{{ old('phone_number', auth()->user()->phone_number) }}"
                    />
                    @error('phone_number')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="zip_code" class="form-label">Zip Code*</label>
                    <input
                        type="text"
                        class="form-control  @error('zip_code') is-invalid @enderror"
                        name="zip_code"
                        id="zip_code"
                        placeholder="Zip Code*"
                        value="{{ old('zip_code', auth()->user()->zip_code) }}"
                    />
                    @error('zip_code')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City*</label>
                    <input
                        type="text"
                        class="form-control  @error('city') is-invalid @enderror"
                        name="city"
                        id="city"
                        placeholder="City*"
                        value="{{ old('city', auth()->user()->city) }}"
                    />
                    @error('city')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">Country*</label>
                    <input
                        type="text"
                        class="form-control  @error('country') is-invalid @enderror"
                        name="country"
                        id="country"
                        placeholder="Country*"
                        value="{{ old('country', auth()->user()->country) }}"
                    />
                    @error('country')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="btn btn-dark" type="submit">
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>