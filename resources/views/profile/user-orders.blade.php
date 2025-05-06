@extends('layouts.app')


@section('title')
    User Orders
@endsection


@section('content')
    <div class="row my-2">
        <div class="col-md-12">
            <div class="row">
                @include('profile.partials.sidebar-data')
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            @if($orders->count())
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
                                                <th scope="col">Price</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Ordered</th>
                                                <th scope="col">Delivered</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
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
                                                        <span>
                                                            {{ $order->created_at }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($order->delivered_at)
                                                            <span class="badge bg-success my-1 rounded-0">
                                                               {{  $order->delivered_at }}
                                                            </span>
                                                        @else 
                                                            <i class="text-">
                                                                Pending....
                                                            </i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="my-3 d-flex justify-content-center">
                                        {{ $orders->links() }}
                                    </div>
                                </div>
                                
                            @else 
                                <div class="row">
                                    <div class="col-md-8 mx-auto">
                                        <div class="alert alert-info mt-3">
                                            No orders yet!
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection