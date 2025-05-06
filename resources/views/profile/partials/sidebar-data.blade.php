<div class="col-md-5">
    <div class="card p-2">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset(auth()->user()->imagePath()) }}" 
                height="150"
                width="150"
                class="rounded-circle" 
                alt="{{ auth()->user()->name }}">
            <form 
                class="d-flex gap-2 my-2 align-items-center" 
                action="{{ route('profile.image') }}" 
                method="post"
                enctype="multipart/form-data"
                >
                @csrf
                @method("PUT")
                <div>
                    <input
                        type="file"
                        class="form-control @error('profile_image') is-invalid @enderror"
                        name="profile_image"
                        id="profile_image"
                    />
                    @error('profile_image')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <button class="btn btn-sm btn-dark" type="submit">
                        <i class="fas fa-upload"></i>
                    </button>
                </div>
            </form>
        </div>
        <ul class="list-group w-100 text-center mt-2">
            <li class="list-group-item">
                <i class="fas fa-user"></i> {{ auth()->user()->name }}
            </li>
            <li class="list-group-item">
                <i class="fas fa-envelope"></i> {{ auth()->user()->email }}
            </li>
            <li class="list-group-item">
                <a href="{{ route('user.orders') }}" class="text-decoration-none text-dark">
                    <i class="fas fa-shopping-cart"></i> orders
                </a>
            </li>
        </ul>
    </div>
</div>