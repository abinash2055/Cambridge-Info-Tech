<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\ResetPasswordMail;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('auth.editProfile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
            'date_of_birth' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'current_job' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255|unique:users,phone,' . Auth::id(),
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->location = $request->location;
        $user->education = $request->education;
        $user->current_job = $request->current_job;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        Alert::toast('Profile updated successfully!', 'success');
        return redirect()->route('account.overview');
    }
}
