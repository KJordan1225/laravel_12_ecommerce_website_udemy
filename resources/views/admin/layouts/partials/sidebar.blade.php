<div class="col-md-3 flex-shrink-0 p-3">
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="{{ request()->routeIs('admin.index') ? 'true' : 'false'}}">
                Dashboard
            </button>
            <div class="collapse {{ request()->routeIs('admin.index') ? 'show' : ''}}" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-dashboard me-1"></i> Overview
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#category-collapse" aria-expanded="{{ request()->routeIs('admin.categories.index') || request()->routeIs('admin.categories.create') || request()->routeIs('admin.categories.edit') ? 'true' : 'false'}}">
                Categories
            </button>
            <div class="collapse {{ request()->routeIs('admin.categories.index') || request()->routeIs('admin.categories.create') ||  request()->routeIs('admin.categories.edit') ? 'show' : ''}}" id="category-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-list me-1"></i> All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.create') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-plus me-1"></i> New Category
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#subcategory-collapse" aria-expanded="{{ request()->routeIs('admin.subcategories.index') || request()->routeIs('admin.subcategories.create') || request()->routeIs('admin.subcategories.edit') ? 'show' : ''}}">
                Subcategories
            </button>
            <div class="collapse {{ request()->routeIs('admin.subcategories.index') || request()->routeIs('admin.subcategories.create') || request()->routeIs('admin.subcategories.edit') ? 'show' : ''}}" id="subcategory-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.subcategories.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-layer-group me-1"></i> All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.subcategories.create') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-plus me-1"></i> New Subcategory
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#childcategory-collapse" aria-expanded="{{ request()->routeIs('admin.childcategories.index') || request()->routeIs('admin.childcategories.create') || request()->routeIs('admin.childcategories.edit') ? 'true' : 'false'}}">
                Child categories
            </button>
            <div class="collapse {{ request()->routeIs('admin.childcategories.index') || request()->routeIs('admin.childcategories.create') || request()->routeIs('admin.childcategories.edit') ? 'show' : ''}}" id="childcategory-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.childcategories.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-table me-1"></i> All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.childcategories.create') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-plus me-1"></i> New Child category
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#brand-collapse" aria-expanded="{{ request()->routeIs('admin.brands.index') || request()->routeIs('admin.brands.create') || request()->routeIs('admin.brands.edit') ? 'true' : 'false'}}">
                Brands
            </button>
            <div class="collapse {{ request()->routeIs('admin.brands.index') || request()->routeIs('admin.brands.create') || request()->routeIs('admin.brands.edit') ? 'show' : ''}}" id="brand-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.brands.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-copyright me-1"></i> All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.brands.create') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-plus me-1"></i> New Brand 
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#color-collapse" aria-expanded="{{ request()->routeIs('admin.colors.index') || request()->routeIs('admin.colors.create') || request()->routeIs('admin.colors.edit') ? 'true' : 'false'}}">
                Colors
            </button>
            <div class="collapse {{ request()->routeIs('admin.colors.index') || request()->routeIs('admin.colors.create') || request()->routeIs('admin.colors.edit') ? 'show' : ''}}" id="color-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.colors.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-palette me-1"></i> All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.colors.create') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-plus me-1"></i> New Color 
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#size-collapse" aria-expanded="{{ request()->routeIs('admin.sizes.index') || request()->routeIs('admin.sizes.create') || request()->routeIs('admin.sizes.edit') ? 'true' : 'false'}}">
                Sizes
            </button>
            <div class="collapse {{ request()->routeIs('admin.sizes.index') || request()->routeIs('admin.sizes.create') || request()->routeIs('admin.sizes.edit') ? 'show' : ''}}" id="size-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.sizes.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-expand me-1"></i> All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sizes.create') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-plus me-1"></i> New Size 
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#product-collapse" aria-expanded="{{ request()->routeIs('admin.products.index') || request()->routeIs('admin.products.create') || request()->routeIs('admin.products.edit') ? 'true' : 'false'}}">
                Products
            </button>
            <div class="collapse {{ request()->routeIs('admin.products.index') || request()->routeIs('admin.products.create') || request()->routeIs('admin.products.edit') ? 'show' : ''}}" id="product-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-tag me-1"></i> All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.create') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-plus me-1"></i> New Product 
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#coupon-collapse" aria-expanded="{{ request()->routeIs('admin.coupons.index') || request()->routeIs('admin.coupons.create') || request()->routeIs('admin.coupons.edit') ? 'true' : 'false'}}">
                Coupons
            </button>
            <div class="collapse {{ request()->routeIs('admin.coupons.index') || request()->routeIs('admin.coupons.create') || request()->routeIs('admin.coupons.edit') ? 'show' : ''}}" id="coupon-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.coupons.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-ticket me-1"></i> All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.coupons.create') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-plus me-1"></i> New Coupon 
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#order-collapse" aria-expanded="{{ request()->routeIs('admin.orders.index') ? 'true' : 'false'}}">
                Orders
            </button>
            <div class="collapse {{ request()->routeIs('admin.orders.index') ? 'show' : '' }}" id="order-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-cart-shopping me-1"></i> All
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#review-collapse" aria-expanded="{{ request()->routeIs('admin.reviews.index') ? 'true' : 'false' }}">
                Reviews
            </button>
            <div class="collapse {{ request()->routeIs('admin.reviews.index') ? 'show' : '' }}" id="review-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.reviews.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-star me-1"></i> All
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="{{ request()->routeIs('admin.users.index') ? 'true' : 'false' }}">
                Users
            </button>
            <div class="collapse {{ request()->routeIs('admin.users.index') ? 'show' : '' }}" id="user-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                           <i class="fas fa-users me-1"></i> All
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                Account
            </button>
            <div class="collapse" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="#" class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                            <i class="fas fa-user me-1"></i> admin
                        </a>
                    </li>
                    <li>
                        <a 
                            href="#" 
                            onclick="document.getElementById('adminLogoutForm').submit()"
                            class="link-body-emphasis d-inline-flex align-items-center text-decoration-none rounded">
                            <i class="fas fa-sign-out me-1"></i> Sign out
                        </a>
                        <form id="adminLogoutForm" action="{{ route('admin.logout') }}" method="post">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>