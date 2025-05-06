<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3 px-2 mt-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-start" href="{{ route('home') }}">
            Fashion Store 
        </a>
        <form action="{{ route('search.products') }}" class="d-flex mx-auto search-bar">
            <input 
                class="form-control rounded-0 @error('searchTerm') is-invalid @enderror"
                type="search" 
                value="{{ request('searchTerm') }}"
                name="searchTerm" placeholder="Search..." aria-label="Search">
            <button class="btn search-button rounded-0" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <div class="d-flex align-items-center">
            <!-- Authenticated User Menu Placeholder -->
            @auth     
                <div class="d-flex flex-column">
                    <a href="{{ route('user.profile') }}" class="text-decoration-none text-black">
                        <div class="d-flex flex-column">
                            <i class="fas fa-user fs-4 me-1"></i> 
                            <span class="fw-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </a>
                    <hr>
                    <a href="#" 
                        onclick="document.getElementById('userLogoutForm').submit()"
                        class="text-decoration-none text-black" title="Logout">
                        <div class="d-flex gap-1">
                            <i class="fas fa-sign-out fs-4"></i> 
                            <span class="fw-bold">Logout</span>
                        </div>
                        <form id="userLogoutForm" action="{{ route('user.logout') }}" method="post">
                            @csrf
                        </form>
                    </a>
                </div>
            @endauth
            <!-- Guest Menu Placeholder -->
            @guest
                <div class="d-flex gap-2">
                    <a href="{{ route('user.register') }}" class="text-decoration-none text-black" title="Register">
                        <i class="fas fa-user-plus fs-4"></i>
                    </a>
                    <a href="{{ route('login') }}" class="text-decoration-none text-black" title="Login">
                        <i class="fas fa-sign-in fs-4"></i>
                    </a>
                </div>
            @endguest
            <a href="{{ route('cart.index') }}" class="text-dark icon-with-badge" title="Cart">
                <i class="fas fa-shopping-cart fs-4"></i>
                <span class="icon-badge">
                    {{ count(session()->get('cart', [])) }}
                </span>
            </a>
            <div class="price mx-3 border border-danger border-2 p-1 rounded">
                @if(session()->has('applied_coupon'))
                    ${{ session()->get('cartItemsTotal') - session()->get('cartItemsTotal') * session()->get('applied_coupon')->discount / 100}}
                @elseif(session()->has('cartItemsTotal'))
                    ${{ session()->get('cartItemsTotal') }}
                @else
                    $0
                @endif
            </div>
        </div>
    </div>
</nav>

<div class="row">
    <div class="col-mad">
        <div class="bg-white shadow-sm">
            <div class="container py-2">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    @foreach ($categories as $category)
                        <!-- Example Category with Subcategories and Child Categories -->
                        <li class="nav-item dropdown position-static">
                            <a class="nav-link dropdown-toggle fw-bold" 
                                href="#" role="button" data-bs-toggle="dropdown">
                                {{ $category->name }}
                            </a>
                            <div class="dropdown-menu mt-0 mega-menu">
                                <div class="container py-4">
                                    <div class="row">
                                        @foreach ($category->subcategories as $subcategory)
                                            <div class="col-md-4 mb-2">
                                                <a href="{{ route('subcategory.products',$subcategory->slug) }}" class="text-decoration-none text-dark fw-bold sub-link">{{ $subcategory->name }} ({{  $subcategory->products->count() }})</a>
                                                @foreach ($subcategory->childcategories as $childcategory)
                                                    <a class="dropdown-item" href="{{ route('childcategory.products',$childcategory->slug) }}">{{ $childcategory->name }} ({{  $childcategory->products->count() }})</a>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    <!-- Brands -->
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                            Brands
                        </a>
                        <div class="dropdown-menu mt-0 mega-menu">
                            <div class="container py-4">
                                <div class="row">
                                    @foreach ($brands as $brand)
                                        <div class="col-md-4 mb-2">
                                            <a href="{{ route('brand.products',$brand->slug) }}" class="text-decoration-none text-dark fw-bold sub-link">
                                                {{ $brand->name }} ({{  $brand->products->count() }})
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Sizes -->
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                            Sizes
                        </a>
                        <div class="dropdown-menu mt-0 mega-menu">
                            <div class="container py-4">
                                <div class="row">
                                    @foreach ($sizes as $size)
                                        <div class="col-md-4 mb-2">
                                            <a href="{{ route('size.products',$size->slug) }}" class="text-decoration-none text-dark fw-bold sub-link">
                                                {{ $size->name }} ({{  $size->products->count() }})
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Colors -->
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                            Colors
                        </a>
                        <div class="dropdown-menu mt-0 mega-menu">
                            <div class="container py-4">
                                <div class="row">
                                    @foreach ($colors as $color)
                                        <div class="col-md-4 mb-2">
                                            <div class="me-1 border border-light-subtle border-2" 
                                                style="background-color:{{ $color->name }};width:30px;height:30px;"></div>
                                            <a href="{{ route('color.products',$color->slug) }}" 
                                                class="text-decoration-none text-dark fw-bold sub-link">
                                                {{ $color->name }} ({{  $color->products->count() }})
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Sort and Pagination Options (Visible on specific routes) -->
@if(request()->routeIs('home') || request()->routeIs('order.products'))
    <div class="row my-2">
        <div class="col-md-12">
            <div class="mb-2 bg-white p-4 shadow-sm">
                <div class="d-flex justify-content-between">
                    <form method="GET" action="{{ route('home') }}">
                        <div class="d-flex justify-content-start align-items-center">
                            <span class="fw-bold">Showing</span>
                            <div class="mx-2">
                                <select class="form-select form-select-sm" 
                                    name="per_page"
                                    onchange="this.form.submit()"
                                >
                                    <option value="4" class="fw-bold"
                                        {{ request('per_page') == 4 ? 'selected' : '' }}
                                    >4</option>
                                    <option value="8" class="fw-bold"
                                        {{ request('per_page') == 8 ? 'selected' : '' }}
                                    >8</option>
                                    <option value="12" class="fw-bold"
                                        {{ request('per_page') == 12 ? 'selected' : '' }}
                                    >12</option>
                                </select>
                            </div>
                            <span class="fw-bold">per page</span>
                        </div>
                    </form>
                    <form method="GET" action="{{ route('order.products') }}">
                        <label for="field" class="fw-bold">Sort by:</label>
                        <select name="field" id="field"
                            onchange="this.form.submit()"
                            >
                            <option value="" disabled class="d-none"
                                {{ request('field') == '' ? 'selected' : '' }}
                            ></option>
                            <option value="name" class="fw-bold"
                                {{ request('field') == 'name' ? 'selected' : '' }}
                            >Name</option>
                            <option value="price" class="fw-bold"
                                {{ request('field') == 'price' ? 'selected' : '' }}
                            >Price</option>
                            <option value="created_at" class="fw-bold"
                                {{ request('field') == 'date' ? 'selected' : '' }}
                            >Date</option>
                        </select>
                        <select name="direction" id="direction"
                            onchange="this.form.submit()"
                        >
                            <option value="" disabled class="d-none"
                                {{ request('direction') == '' ? 'selected' : '' }}
                            ></option>
                            <option value="asc" class="fw-bold"
                                {{ request('direction') == 'asc' ? 'selected' : '' }}
                            >Ascending</option>
                            <option value="desc" class="fw-bold"
                                {{ request('direction') == 'desc' ? 'selected' : '' }}
                            >Descending</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif