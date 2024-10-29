<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\VerificationEmail;


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

        // Send verification email
        Mail::to($user->email)->send(new VerificationEmail($user));

        // User feedback
        // session()->flash('status',
        //     'Registration completed! Please check your email for verification.'
        // );
        Alert::Toast('Registration successful! Please check your email for verification.', 'success');
        return redirect()->route('login')->with('success', 'Registration successful! Please check your email for verification.');
    }

    public function verifyEmail($code)
    {
        $user = User::where('verification_code', $code)->first();
        if ($user) {
            $user->email_verified_at = now(); 
            $user->verification_code = null;
            $user->save();

            // session()->flash(
            //     'success',
            //     'Email has been verified successfully.'
            // );
            Alert::Toast('Email verified successfully!', 'success');
            return redirect()->route('login')->with('success', 'Email has been verified successfully.');
        }

        // session()->flash(
        //     'error',
        //     'Invalid verification Code'
        // );
        Alert::Toast('Invalid verification code.', 'error');
        return redirect()->route('login')->with('error', 'Invalid verification Code');
    }

    protected function sendVerificationEmail($user)
    {
        $verificationCode = mt_rand(100000, 999999); 
        $user->verification_code = $verificationCode; 
        $user->save();

        Mail::to($user->email)->send(new VerificationEmail($user));
    }

}
