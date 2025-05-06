@extends('layouts.app')


@section('title')
    Home
@endsection


@section('content')
    <div class="row my-2">
        <div class="col-md-12">
            @if ($products->count())
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3 mb-2">
                            @include('products.partials.product-item',['product' => $product])
                        </div>
                    @endforeach
                </div>
                <div class="row my-2">
                    <div class="col-md-12">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            @else 
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="alert alert-info">
                            No products found for search term: {{ request('searchTerm') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection