@extends('admin.layouts.app')

@section('title')
    Coupons
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">
                Coupons ({{ $coupons->count() }})
            </h3>
            <hr>
            <div class="row mt-2">
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
                                            <th scope="col">Discount</th>
                                            <th scope="col">Expiry Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $key => $coupon)
                                            <tr>
                                                <td>
                                                    {{ $key += 1 }}
                                                </td>
                                                <td>{{ $coupon->name }}</td>
                                                <td>{{ $coupon->discount }}%</td>
                                                <td>
                                                    @if (!$coupon->checkIfExpired())
                                                        <span class="bg-success border border-dark p-1 text-white">
                                                            Valid until {{ \Carbon\Carbon::parse($coupon->expires_at)->diffForHumans() }}
                                                        </span>
                                                    @else  
                                                        <span class="bg-danger border border-dark p-1 text-white">
                                                            Coupon Expired
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" 
                                                        onclick="deleteItem({{ $coupon->id }})"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="{{ $coupon->id }}" action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="post">
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