@extends('admin.layouts.app')

@section('title')
    Subcategories
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">
                Subcategories ({{ $subcategories->count() }})
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
                                            <th scope="col">Slug</th>
                                            <th scope="col">Category</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subcategories as $key => $subcategory)
                                            <tr>
                                                <td>
                                                    {{ $key += 1 }}
                                                </td>
                                                <td>{{ $subcategory->name }}</td>
                                                <td>{{ $subcategory->slug }}</td>
                                                <td>{{ $subcategory->category->name }}</td>
                                                <td>
                                                    <a href="{{ route('admin.subcategories.edit', $subcategory->slug) }}" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" 
                                                        onclick="deleteItem({{ $subcategory->id }})"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="{{ $subcategory->id }}" action="{{ route('admin.subcategories.destroy', $subcategory->slug) }}" method="post">
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