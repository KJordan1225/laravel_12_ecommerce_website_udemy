@extends('admin.layouts.app')

@section('title')
    Users
@endsection

@section('content')
    <div class="row">
        <!-- sidebar here -->
        @include('admin.layouts.partials.sidebar')
        <div class="col-md-9">
            <h3 class="my-3">
                Users ({{ $users->count() }})
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
                                            <th scope="col">Email</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Registered</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>
                                                    {{ $key += 1 }}
                                                </td>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                                <td>
                                                    <img 
                                                        src="{{ asset($user->imagePath()) }}" 
                                                        alt="{{ $user->name }}"
                                                        class="rounded"
                                                        width="60"
                                                        height="60"    
                                                    >
                                                </td>
                                                <td>
                                                    {{ $user->created_at->diffForHumans() }}
                                                </td>
                                                <td>
                                                    <a href="#" 
                                                        onclick="deleteItem({{ $user->id }})"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="post">
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