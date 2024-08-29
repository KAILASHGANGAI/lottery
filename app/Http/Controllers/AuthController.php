<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function profile(Request $request)
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }
    public function updateProfile(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Validate the request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['required_with:password', 'string', 'min:8'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Verify the current password if a new password is provided
        if ($request->filled('password')) {
            if (!\Hash::check($request->current_password, $user->password)) {
                toast('Old password is incorrect.', 'error');
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }

            // Hash the new password
            $validatedData['password'] = \Hash::make($request->password);
        }

        // Update the user's profile
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'] ?? $user->password, // Only update password if new one is provided
        ]);

        // Flash success message and redirect
        toast('Profile updated successfully.', 'success');
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
