@extends('layouts.app')


@section('title')
    Your Cart
@endsection


@section('content')
    <div class="row my-3">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">
                        <i class="fas fa-cart-arrow-down"></i> Your Shopping Cart
                    </h2>
                    @if (empty($cart))
                        <div class="alert alert-info">
                            Your cart is empty.
                        </div>
                        <a href="{{ route('home') }}" class="btn btn-primary">Back to Shop</a>
                    @else 
                        <div
                            class="table-responsive"
                        >
                            <table
                                class="table"
                            >
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $key => $item)
                                        <tr>
                                            <td class="d-flex justify-content-start gap-3">
                                                <img 
                                                    src="{{ asset($item['image']) }}" 
                                                    class="rounded" 
                                                    width="60"
                                                    height="60"
                                                    alt="{{ $item['name']}}">
                                                    {{ $item['name'] }}
                                            </td>
                                            <td>
                                                <span class="bg-light text-dark p-1 fw-bold border border-light-subtle border-2">
                                                    {{ $item['size'] }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="me-1 border border-light-subtle border-2" 
                                                    style="background-color:{{ $item['color'] }}; width:30px; height:30px;"></div>
                                            </td>
                                            <td>
                                                <form action="{{ route('cart.update') }}" method="post" class="d-flex gap-2">
                                                    @csrf
                                                    <input 
                                                        type="hidden" 
                                                        name="product_id" 
                                                        value="{{ (int) explode('-', $key)[0] }}"
                                                    >
                                                    <input 
                                                        type="hidden" 
                                                        name="color" 
                                                        value="{{ (string) explode('-', $key)[1] }}"
                                                    >
                                                    <input 
                                                        type="hidden" 
                                                        name="size" 
                                                        value="{{ (string) explode('-', $key)[2] }}"
                                                    >
                                                    <input 
                                                        type="number" 
                                                        name="qty" 
                                                        min="1"
                                                        max="{{ $item['maxQty'] }}"
                                                        value="{{ $item['qty'] }}"
                                                        class="form-control w-auto"
                                                    >
                                                    <button type="submit" class="btn btn-sm btn-warning">
                                                        Update
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                ${{ $item['price'] }}
                                            </td>
                                            <td>
                                                ${{ $item['price'] *  $item['qty'] }}
                                            </td>
                                            <td>
                                                <form action="{{ route('cart.remove') }}" method="post">
                                                    @csrf
                                                    <input 
                                                        type="hidden" 
                                                        name="product_id" 
                                                        value="{{ (int) explode('-', $key)[0] }}"
                                                    >
                                                    <input 
                                                        type="hidden" 
                                                        name="color" 
                                                        value="{{ (string) explode('-', $key)[1] }}"
                                                    >
                                                    <input 
                                                        type="hidden" 
                                                        name="size" 
                                                        value="{{ (string) explode('-', $key)[2] }}"
                                                    >
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-xmark"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold">
                                        <td colspan="6"
                                            class="text-end fs-5"
                                        >
                                            Total
                                        </td>
                                        @if(session()->has('applied_coupon'))
                                            <td colspan="2"
                                                class="fs-5"
                                            >
                                                ${{ session()->get('cartItemsTotal') - session()->get('cartItemsTotal') * session()->get('applied_coupon')->discount / 100}}
                                            </td>
                                        @else
                                            <td colspan="2"
                                                class="fs-5"
                                            >
                                                ${{ session()->get('cartItemsTotal') }}
                                            </td>
                                        @endif
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <form action="{{ route('cart.clear') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-can"></i> Clear Cart
                                </button>
                            </form>
                            <a href="{{ route('checkout.index') }}" class="btn btn-success">Proceed to checkout</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection