<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('admin.pages.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'profileImage' => 'nullable|image|mimes:jpeg,png,jpg|max:3840'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Profil resmi güncelleme
        if ($request->hasFile('profileImage')) {
            // Eski resmi sil
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }
            
            $file = $request->file('profileImage');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile_images'), $fileName);
            $user->profile_image = 'profile_images/' . $fileName;
        }

        // Şifre güncelleme (hash edilerek)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }
}
