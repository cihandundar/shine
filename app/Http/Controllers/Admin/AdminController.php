<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\admin\roles;
use App\Models\admin\permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = roles::all();
        return view('admin.pages.adminList', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        return redirect()->route('admin.adminList')->with('success', 'User created successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role_id' => 'required|string|exists:roles,id'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.adminList')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Admin kendisini silemesin
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.adminList')->with('error', 'You cannot delete yourself');
        }

        $user->delete();
        return redirect()->route('admin.adminList')->with('success', 'User deleted successfully');
    }

    public function assignRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = User::findOrFail($id);
        $user->update(['role_id' => $request->role_id]);

        return redirect()->route('admin.adminList')->with('success', 'Role assigned successfully');
    }

    public function checkPermission($permission)
    {
        $user = Auth::user();
        if (!$user || !$user->role) {
            return false;
        }

        return $user->role->permission()->where('name', $permission)->exists();
    }
}
