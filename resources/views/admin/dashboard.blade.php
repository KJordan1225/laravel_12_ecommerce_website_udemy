@extends('admin.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">Dashboard</h3>
            <hr />
            <div class="row mt-2">
                <div class="col-md-4">
                    <div class="card text-bg-light mb-3" style="max-width: 18rem">
                        <div class="card-header">
                            <h4 class="card-title mt-2">Customers</h4>
                        </div>
                        <div class="card-body">
                            <p
                                class="card-text d-flex justify-content-between align-items-center"
                            >
                                <span>
                                    <i class="fas fa-users h4"></i>
                                </span>
                                <span class="fw-bold"> {{ $userCount }} </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-bg-light mb-3" style="max-width: 18rem">
                        <div class="card-header">
                            <h4 class="card-title mt-2">Orders</h4>
                        </div>
                        <div class="card-body">
                            <p
                                class="card-text d-flex justify-content-between align-items-center"
                            >
                                <span>
                                    <i class="fa-solid fa-cart-shopping h4"></i>
                                </span>
                                <span class="fw-bold">  {{ $orderCount }} </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-bg-light mb-3" style="max-width: 18rem">
                        <div class="card-header">
                            <h4 class="card-title mt-2">Reviews</h4>
                        </div>
                        <div class="card-body">
                            <p
                                class="card-text d-flex justify-content-between align-items-center"
                            >
                                <span>
                                    <i class="fas fa-star h4"></i>
                                </span>
                                <span class="fw-bold">  {{ $reviewCount }} </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-12">
                    <!-- chart here -->
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endsection
