@extends('admin.base')

@section('title', 'Admin User Management')

@section('content')
    <section class="container max-w-screen-xl mx-auto py-6 px-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Admin User Management</h1>
                <p class="text-gray-600">Manage users, roles and permissions</p>
            </div>
            <button onclick="openUserModal()" 
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center space-x-2">
                <i class="fa-solid fa-plus text-lg"></i>
                <span class="font-medium">Add New User</span>
            </button>
        </div>


        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
                <i class="fa-solid fa-check-circle mr-3 text-green-500"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center">
                <i class="fa-solid fa-exclamation-circle mr-3 text-red-500"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $users->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fa-solid fa-user-shield text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Admins</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $users->where('role.name', 'Super Admin')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fa-solid fa-user-edit text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Editors</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $users->where('role.name', 'Editor')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                        <i class="fa-solid fa-user-pen text-xs"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Authors</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $users->where('role.name', 'Author')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900">User List</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($user->profile_image)
                                                <img src="{{ asset($user->profile_image) }}" 
                                                     alt="Profile" class="h-10 w-10 rounded-full object-cover border-2 border-gray-200">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                                    <i class="fa-solid fa-user text-white text-sm"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->role)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            @if($user->role->name === 'Super Admin') bg-red-100 text-red-800
                                            @elseif($user->role->name === 'Admin') bg-blue-100 text-blue-800
                                            @elseif($user->role->name === 'Editor') bg-green-100 text-green-800
                                            @elseif($user->role->name === 'Author') bg-purple-100 text-purple-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ $user->role->name }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            No Role
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fa-solid fa-circle text-xs mr-1"></i>
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Edit Button -->
                                        <button onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', {{ $user->role_id ?? 'null' }})" 
                                                class="text-blue-600 hover:text-blue-800 transition-colors p-2 rounded-lg hover:bg-blue-50" 
                                                title="Edit User">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        
                                        <!-- Role Assignment Button -->
                                        <button onclick="openRoleModal({{ $user->id }})" 
                                                class="text-green-600 hover:text-green-800 transition-colors p-2 rounded-lg hover:bg-green-50" 
                                                title="Assign Role">
                                            <i class="fa-solid fa-user-tag"></i>
                                        </button>
                                        
                                        <!-- Delete Button -->
                                        @if($user->id !== auth()->id())
                                            <button onclick="deleteUser({{ $user->id }})" 
                                                    class="text-red-600 hover:text-red-800 transition-colors p-2 rounded-lg hover:bg-red-50" 
                                                    title="Delete User">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @else
                                            <span class="text-gray-400 cursor-not-allowed p-2" title="Cannot delete yourself">
                                                <i class="fa-solid fa-trash"></i>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <i class="fa-solid fa-users text-4xl mb-4 text-gray-300"></i>
                                        <p class="text-lg font-medium">No users found</p>
                                        <p class="text-sm">Get started by adding your first user.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Include Modal Components -->
    @include('admin.partials.userModal')
    @include('admin.partials.roleModal')
@endsection

@section('scripts')
    @include('admin.partials.adminScripts')
@endsection
