<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::withCount('orders')->latest()->get();
        $adminCount = User::where('role', 'admin')->count();
        $customerCount = User::where('role', 'customer')->count();

        return view('admin.users.index', compact('users', 'adminCount', 'customerCount'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email',
            'phone' => 'nullable|string|max:50',
            'role' => 'required|in:admin,customer',
            'password' => 'required|string|min:6',
            'company' => 'nullable|string|max:150',
            'city' => 'nullable|string|max:100',
        ]);

        $fullName = trim($validated['first_name'] . ' ' . $validated['last_name']);

        User::create([
            'name' => $fullName,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
            'company' => $validated['company'] ?? null,
            'city' => $validated['city'] ?? null,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User account created successfully!');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => "required|email|max:150|unique:users,email,{$user->id}",
            'phone' => 'nullable|string|max:50',
            'role' => 'required|in:admin,customer',
            'password' => 'nullable|string|min:6',
            'company' => 'nullable|string|max:150',
            'city' => 'nullable|string|max:100',
        ]);

        if ($user->id === auth()->id() && $request->role !== 'admin') {
            return back()->with('error', 'You cannot revoke your own admin privileges.');
        }

        $fullName = trim($validated['first_name'] . ' ' . $validated['last_name']);

        $updateData = [
            'name' => $fullName,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'company' => $validated['company'] ?? null,
            'city' => $validated['city'] ?? null,
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'User details updated successfully!');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,customer',
        ]);

        if ($user->id === auth()->id() && $request->role !== 'admin') {
            return back()->with('error', 'You cannot remove your own admin privileges.');
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', "User {$user->name} role updated to {$user->role}.");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "User {$userName} has been removed successfully.");
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => "required|email|max:150|unique:users,email,{$user->id}",
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:150',
            'city' => 'nullable|string|max:100',
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if (!empty($validated['password'])) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Current password entered does not match your existing password.');
            }
            $user->password = Hash::make($validated['password']);
        }

        $fullName = trim($validated['first_name'] . ' ' . $validated['last_name']);
        $user->name = $fullName;
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->company = $validated['company'] ?? null;
        $user->city = $validated['city'] ?? null;
        $user->save();

        return back()->with('success', 'Admin profile details updated successfully!');
    }
}

