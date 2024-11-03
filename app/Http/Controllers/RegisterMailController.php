<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\VerificationEmail;
use App\Mail\ResetPasswordMail;

class RegisterMailController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'date_of_birth' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'current_job' => 'nullable|string|max:255',
            'phone' => 'required|string|unique:users',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'location' => $request->location,
            'education' => $request->education,
            'current_job' => $request->current_job,
            'verification_code' => Str::random(40),
        ]);
        $user->assignRole('user');

        // Send verification email
        try {
            Mail::to($user->email)->send(new VerificationEmail($user));
        } catch (\Exception $e) {
            Alert::toast('Failed to send verification email. Please try again.', 'error');
            return redirect()->back();
        }

        Alert::toast('Registration successful! Please check your email for verification.', 'success');
        return redirect()->route('login')->with('success', 'Registration successful! Please check your email for verification.');
    }

    public function forgotPassword(Request $request)
    {
        // Validate the email input
        $request->validate(['email' => 'required|email']);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Generate a random token for password reset
            $token = Str::random(60);
            $user->reset_token = $token; // Store the token in the user model
            $user->reset_token_expiry = now()->addHour(); // Set the expiry time for the token
            $user->save(); // Save the user model

            // Send the password reset email with error handling
            try {
                Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
            } catch (\Exception $e) {
                Alert::toast('Failed to send password reset email. Please try again.', 'error');
                return redirect()->back();
            }

            Alert::toast('Password reset link sent to your email!', 'success');
            return redirect()->route('login');
        }

        // If email is not found, return an error
        Alert::toast('Email not found.', 'error');
        return back()->with('error', 'Email not found.');
    }

    public function forgotPasswordForm()
    {
        return view('auth.forgot-password'); // Adjust this to the actual view file path
    }
}
