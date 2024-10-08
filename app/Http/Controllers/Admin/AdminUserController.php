<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        $users = User::paginate(10); // Adjust the pagination as needed
        return view('users.index', compact('users')); // Adjust the view path as needed
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('users.create'); // Adjust the view path as needed
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|min:7|max:10|unique',  // friday work
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        Alert::toast('User created successfully!', 'success');
        return redirect()->route('users.index');
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        return view('users.edit', compact('user')); // Adjust the view path as needed
    }

    // Update the specified user in storage
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|min:10|unique',
            // Validate password only if provided
            'password' => 'sometimes|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        Alert::toast('User updated successfully!', 'success');
        return redirect()->route('users.index');
    }

    // Remove the specified user from storage
    public function destroyUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        Alert::toast('User deleted successfully!', 'success');
        // return redirect()->route('users.index');
        return response()->json(['success' => 'User deleted successfully.']);
    }
}
