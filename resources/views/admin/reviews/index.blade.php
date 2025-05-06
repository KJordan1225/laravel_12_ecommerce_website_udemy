@extends('admin.layouts.app')

@section('title')
    Reviews
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">
                Reviews ({{ $reviews->count() }})
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
                                            <th scope="col">Title</th>
                                            <th scope="col">Review</th>
                                            <th scope="col">Rating</th>
                                            <th scope="col">Approved</th>
                                            <th scope="col">By</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Added</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $key => $review)
                                            <tr>
                                                <td>
                                                    {{ $key += 1 }}
                                                </td>
                                                <td>
                                                    {{ $review->title }}
                                                </td>
                                                <td>
                                                    {{ $review->body }}
                                                </td>
                                                <td>
                                                    @for ($i = 1; $i <= 5; $i++ )
                                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : '' }}"></i>
                                                    @endfor
                                                </td>
                                                <td>
                                                    @if($review->approved )
                                                        <span class="badge bg-success">
                                                            Approved
                                                        </span>
                                                    @else 
                                                        <span class="badge bg-info">
                                                            Pending...
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span>
                                                        {{ $review->user->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <img 
                                                        src="{{ asset($review->product->thumbnail) }}" 
                                                        alt="{{ $review->product->name }}"
                                                        class="rounded"
                                                        width="60"
                                                        height="60"    
                                                    >
                                                </td>
                                                <td>
                                                    {{ $review->created_at }}
                                                </td>
                                                <td>
                                                    @if($review->approved )
                                                        <a href="{{ route('admin.reviews.update',['review' => $review->id, 'status' => 0]) }}" 
                                                            class="btn btn-sm btn-warning mb-1">
                                                            <i class="fas fa-eye-slash"></i>
                                                        </a>
                                                    @else 
                                                        <a href="{{ route('admin.reviews.update',['review' => $review->id, 'status' => 1]) }}" 
                                                            class="btn btn-sm btn-success mb-1">
                                                            <i class="fas fa-check-double"></i>
                                                        </a>
                                                    @endif
                                                    <a href="#" 
                                                        onclick="deleteItem({{ $review->id }})"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="{{ $review->id }}" action="{{ route('admin.reviews.destroy', $review->id) }}" method="post">
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