@extends('admin.master')
@section('title', 'Dashboard')

@section('content')
    <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6">@yield('title')</h2>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-5 hover:shadow-md transition">
            <h3 class="text-lg font-medium text-gray-700 mb-2">Total
                Categories</h3>
            <p class="text-3xl font-bold text-indigo-600">24</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5 hover:shadow-md transition">
            <h3 class="text-lg font-medium text-gray-700 mb-2">Total
                Products</h3>
            <p class="text-3xl font-bold text-indigo-600">128</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5 hover:shadow-md transition">
            <h3 class="text-lg font-medium text-gray-700 mb-2">New
                Orders</h3>
            <p class="text-3xl font-bold text-indigo-600">15</p>
        </div>
    </div>
@endsection
