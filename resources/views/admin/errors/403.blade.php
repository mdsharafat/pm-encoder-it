@extends('layouts.admin.master-layout')

@section('main-content')
    <div class="container-fluid">
        <div class="text-center">
            <div class="error mx-auto" data-text="403">403</div>
            <p class="lead text-gray-800 mb-5">Page Not Found</p>
            <p class="text-gray-500 mb-0">It looks like you don't have the right permission.</p>
            <a href="{{ url('/') }}">&larr; Back to Dashboard</a>
        </div>
    </div>
@endsection