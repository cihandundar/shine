@extends('admin.base')

@section('title', 'Admin List')

@section('content')
    <section class="container max-w-screen-xl mx-auto py-[80px] px-[40px]">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Admin User Management</h1>
            <button onclick="openUserModal()" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                <i class="fa-solid fa-plus mr-2"></i>Add New User
            </button>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <!-- Users Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm text-white font-medium">ID</th>
                        <th class="px-6 py-3 text-left text-sm text-white font-medium">Profile Image</th>
                        <th class="px-6 py-3 text-left text-sm text-white font-medium">Name</th>
                        <th class="px-6 py-3 text-left text-sm text-white font-medium">Email</th>
                        <th class="px-6 py-3 text-left text-sm text-white font-medium">Role</th>
                        <th class="px-6 py-3 text-left text-sm text-white font-medium">Created Date</th>
                        <th class="px-6 py-3 text-center text-sm text-white font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->id }}</td>
                            <td class="px-6 py-4">
                                @if($user->profile_image)
                                    <img src="{{ asset('profile_images/' . $user->profile_image) }}" 
                                         alt="Profile" class="w-10 h-10 rounded-full border border-gray-300">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                                        <i class="fa-solid fa-user text-gray-600"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @if($user->role)
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                        {{ $user->role->name }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                        No Role
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Edit Button -->
                                    <button onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', {{ $user->role_id ?? 'null' }})" 
                                            class="text-blue-600 hover:text-blue-800 transition-colors" 
                                            title="Edit User">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    
                                    <!-- Role Assignment Button -->
                                    <button onclick="openRoleModal({{ $user->id }})" 
                                            class="text-green-600 hover:text-green-800 transition-colors" 
                                            title="Assign Role">
                                        <i class="fa-solid fa-user-tag"></i>
                                    </button>
                                    
                                    <!-- Delete Button -->
                                    @if($user->id !== auth()->id())
                                        <button onclick="deleteUser({{ $user->id }})" 
                                                class="text-red-600 hover:text-red-800 transition-colors" 
                                                title="Delete User">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @else
                                        <span class="text-gray-400 cursor-not-allowed" title="Cannot delete yourself">
                                            <i class="fa-solid fa-trash"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- Include Modal Components -->
    @include('admin.partials.userModal')
    @include('admin.partials.roleModal')
@endsection

@section('scripts')
    @include('admin.partials.adminScripts')
@endsection
