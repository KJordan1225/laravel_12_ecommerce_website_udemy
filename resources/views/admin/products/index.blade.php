@extends('admin.layouts.app')

@section('title')
    Products
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">
                Products ({{ $products->count() }})
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Slug</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Colors</th>
                                            <th scope="col">Sizes</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Images</th>
                                            <th scope="col">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td>
                                                    {{ $key += 1 }}
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->slug }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->brand->name }}</td>
                                                <td>
                                                    @foreach ($product->colors as $color)
                                                        <span class="badge bg-light text-dark">
                                                            {{ $color->name }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($product->sizes as $size)
                                                        <span class="badge bg-light text-dark">
                                                            {{ $size->name }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>{{ $product->qty }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->discount ? $product->discount : '0' }}%</td>
                                                <td>
                                                    <img src="{{ $product->thumbnail }}" 
                                                        class="img-fluid rounded mb-1"
                                                        width="30"
                                                        height="30"
                                                        alt="{{ $product->name }}">
                                                    @if ($product->first_image)
                                                        <img src="{{ $product->first_image }}" 
                                                            class="img-fluid rounded mb-1"
                                                            width="30"
                                                            height="30"
                                                            alt="{{ $product->name }}">
                                                    @endif
                                                    @if ($product->second_image)
                                                        <img src="{{ $product->second_image }}" 
                                                            class="img-fluid rounded mb-1"
                                                            width="30"
                                                            height="30"
                                                            alt="{{ $product->name }}">
                                                    @endif
                                                    @if ($product->third_image)
                                                        <img src="{{ $product->third_image }}" 
                                                            class="img-fluid rounded mb-1"
                                                            width="30"
                                                            height="30"
                                                            alt="{{ $product->name }}">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product->status)
                                                        <span class="badge bg-success">
                                                            In Stock
                                                        </span>
                                                    @else  
                                                        <span class="badge bg-danger">
                                                            Out Of Stock
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.products.edit', $product->slug) }}" class="btn btn-sm btn-warning mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" 
                                                        onclick="deleteItem({{ $product->id }})"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="{{ $product->id }}" action="{{ route('admin.products.destroy', $product->slug) }}" method="post">
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