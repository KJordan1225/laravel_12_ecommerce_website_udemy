@extends('admin.layouts.app')

@section('title')
    Child Categories
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">
                Child Categories ({{ $childcategories->count() }})
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
                                            <th scope="col">Subcategory</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($childcategories as $key => $childcategory)
                                            <tr>
                                                <td>
                                                    {{ $key += 1 }}
                                                </td>
                                                <td>{{ $childcategory->name }}</td>
                                                <td>{{ $childcategory->slug }}</td>
                                                <td>{{ $childcategory->subcategory->name }}</td>
                                                <td>
                                                    <a href="{{ route('admin.childcategories.edit', $childcategory->slug) }}" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" 
                                                        onclick="deleteItem({{ $childcategory->id }})"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="{{ $childcategory->id }}" action="{{ route('admin.childcategories.destroy', $childcategory->slug) }}" method="post">
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