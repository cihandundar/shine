<!-- Role Assignment Modal -->
<div id="roleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Assign Role</h3>
                <button onclick="closeRoleModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
            </div>
            
            <form id="roleForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="roleSelect" class="block text-sm font-medium text-gray-700 mb-2">Select Role</label>
                    <select id="roleSelect" name="role_id" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeRoleModal()" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                        Assign Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
