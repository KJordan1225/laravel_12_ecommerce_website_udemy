@extends('layouts.app')


@section('title')
    Checkout
@endsection


@section('content')
    <div class="row my-2">
        @include('profile.partials.update-user-data')
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form 
                        class="d-flex mb-2" 
                        action="{{ route('apply.coupon') }}" 
                        method="post"
                    >
                        @csrf
                        <input
                            type="text"
                            class="form-control rounded-0 @error('name') is-invalid @enderror"
                            name="name"
                            id="name"
                            placeholder="Enter your coupon code"
                            value="{{ old('name') }}"
                        />
                        <button 
                            class="btn btn-sm btn-dark rounded-0 {{  !session()->has('cartItemsTotal') || session()->get('cartItemsTotal') == 0 ? 'disabled' : ''}}" 
                            type="submit">
                            Apply
                        </button>
                    </form>
                    <ul class="list-group">
                        @foreach ($cart as $item)
                            <li class="list-group-item d-flex">
                                <img 
                                    src="{{ asset($item['image']) }}" 
                                    class="img-fluid me-2 rounded" 
                                    width="60"
                                    height="60"
                                    alt="{{ $item['name']}}">
                                <div class="d-flex flex-column">
                                    <h5 class="my-1">
                                        <strong>
                                            {{ $item['name'] }}
                                        </strong>
                                    </h5>
                                    <span class="text-muted">
                                        <strong>
                                           Color: <span class="text-danger"> {{ $item['color'] }} </span>
                                        </strong>
                                    </span>
                                    <span class="text-muted">
                                        <strong>
                                           Size: <span class="text-danger"> {{ $item['size'] }} </span>
                                        </strong>
                                    </span>
                                </div>
                                <div class="d-flex flex-column ms-auto">
                                    <span class="text-muted">
                                        ${{ $item['price'] }} <i>x</i> {{ $item['qty'] }}
                                    </span>
                                    <span class="text-danger fw-bold">
                                        ${{ $item['price'] * $item['qty'] }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                        @if(session()->has('applied_coupon'))
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-bold">
                                    Discount {{ session()->get('applied_coupon')->discount  }} %
                                </span>
                                <span class="fw-normal">
                                    {{ session()->get('applied_coupon')->name }} 
                                    <a href="{{ route('remove.coupon') }}" class="text-decoration-none text-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </span>
                                <span class="fw-bold">
                                    -${{ session()->get('cartItemsTotal') * session()->get('applied_coupon')->discount / 100}}
                                </span>
                            </li>
                        @endif
                        @if (session()->has('cartItemsTotal') && session()->get('cartItemsTotal') > 0) 
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-bold">
                                    Total 
                                </span>
                                @if(session()->has('applied_coupon'))
                                    <span class="fw-bold text-danger">
                                        ${{ session()->get('cartItemsTotal') - session()->get('cartItemsTotal') * session()->get('applied_coupon')->discount / 100}}
                                    </span>
                                    @else 
                                    <span class="fw-bold text-danger">
                                        ${{ session()->get('cartItemsTotal') }}
                                    </span>
                                @endif
                            </li>
                        @endif
                    </ul>
                    <div class="my-3 text-center">
                        @if (session()->has('cartItemsTotal') && session()->get('cartItemsTotal') > 0) 
                            @if (auth()->user()->profile_completed)
                                <a href="{{ route('order.pay') }}" class="btn btn-primary w-100">
                                    Pay now
                                </a>
                            @else 
                                <div class="alert alert-warning">
                                    Please complete your profile before proceeding to payment
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection