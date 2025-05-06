@extends('admin.layouts.app')

@section('title')
    Orders
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">
                Orders ({{ $orders->count() }})
            </h3>
            <hr>
            <div class="row my-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="table-responsive"
                            >
                                <table
                                    class="table"
                                >
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th> 
                                            <th scope="col">Product</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Coupon</th>
                                            <th scope="col">By</th>
                                            <th scope="col">Ordered</th>
                                            <th scope="col">Delivered</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <td>
                                                    {{ $key += 1 }}
                                                </td>
                                                <td>
                                                    @foreach ($order->products as $product)
                                                        <span class="my-1">
                                                            {{ $product->name }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="text-center bg-light text-dark p-1 fw-bold">
                                                        {{ $order->size }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div 
                                                        class="me-1 border border-light-subtle border-2" 
                                                        style="background-color:{{ $order->color }}; width:30px; height:30px;">
                                                    </div>
                                                </td>
                                                <td>
                                                    @foreach ($order->products as $product)
                                                        <span class="my-1">
                                                            ${{ $product->price }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span>
                                                        {{ $order->qty }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        ${{ $order->total }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($order->coupon()->exists() )
                                                        <span class="badge bg-success">
                                                            {{ $order->coupon->name }}
                                                        </span>
                                                    @else 
                                                        <span class="badge bg-danger">
                                                            N/A
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span>
                                                        {{ $order->user->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        {{ $order->created_at }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($order->delivered_at)
                                                        <span class="badge bg-success my-1 rounded-0">
                                                            {{ $order->delivered_at }}
                                                        </span>
                                                    @else 
                                                        <a href="{{ route('admin.orders.update',$order->id) }}">
                                                            <i class="fas fa-pencil"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" 
                                                        onclick="deleteItem({{ $order->id }})"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="{{ $order->id }}" action="{{ route('admin.orders.destroy', $order->id) }}" method="post">
                                                        @csrf
                                                        @method("DELETE")
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection