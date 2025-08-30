@extends('admin.base')

@section('title', 'Access Denied')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 text-center">
        <div class="text-red-500 text-6xl mb-4">
            <i class="fa-solid fa-ban"></i>
        </div>
        
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Access Denied</h1>
        
        <p class="text-gray-600 mb-6">
            You don't have permission to access this page. 
            Please contact your administrator if you believe this is an error.
        </p>
        
        <div class="space-y-3">
            <a href="{{ route('admin.dashboard.index') }}" 
               class="block w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                <i class="fa-solid fa-home mr-2"></i>Go to Dashboard
            </a>
            
            <a href="{{ route('admin.profile') }}" 
               class="block w-full bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition-colors">
                <i class="fa-solid fa-user mr-2"></i>View Profile
            </a>
        </div>
    </div>
</div>
@endsection
