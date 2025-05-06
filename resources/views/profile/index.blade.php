@extends('layouts.app')


@section('title')
    Profile
@endsection


@section('content')
    <div class="row my-2">
        <div class="col-md-12">
            <div class="row">
                @include('profile.partials.sidebar-data')
                @include('profile.partials.update-user-data')
            </div>
        </div>
@endsection