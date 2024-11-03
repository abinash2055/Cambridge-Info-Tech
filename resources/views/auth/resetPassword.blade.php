@extends('layouts.auth')

@section('content')
<div class="container">
    <h2>Reset Password</h2>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
@endsection

@component('mail::message')
# Hi {{ $userName }},

You requested a password reset. Click the button below to reset your password.

@component('mail::button', ['url' => $resetLink])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

