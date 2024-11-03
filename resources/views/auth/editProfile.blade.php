@extends('layouts.auth')

@section('content')
    <div class="container">
        <h2>Edit Profile</h2>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                    required>
            </div>

            {{-- 
            <!-- Email -->
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div> --}}

            <!-- Date of Birth -->
            <div class="form-group mb-3">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                    value="{{ old('date_of_birth', $user->date_of_birth) }}" required>
            </div>

            <!-- Location -->
            <div class="form-group mb-3">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location"
                    value="{{ old('location', $user->location) }}" required>
            </div>

            <!-- Education -->
            <div class="form-group mb-3">
                <label for="education">Education</label>
                <input type="text" class="form-control" id="education" name="education"
                    value="{{ old('education', $user->education) }}" required>
            </div>

            <!-- Current Job -->
            <div class="form-group mb-3">
                <label for="current_job">Current Job</label>
                <input type="text" class="form-control" id="current_job" name="current_job"
                    value="{{ old('current_job', $user->current_job) }}" required>
            </div>

            <!-- Phone -->
            <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="{{ old('phone', $user->phone) }}" required>
            </div>

            <!-- Password -->
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Confirm Password -->
            <div class="form-group mb-3">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
    <br>
@endsection
