@extends('layouts.account')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Edit Author</h1>

        <form action="{{ route('admin.author.update', $author->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="font-weight-bold">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $author->name) }}" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="font-weight-bold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $author->email) }}" required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- friday work --}}
            <div class="form-group">
                <label for="phone" class="font-weight-bold">Mobile/Phone Number</label>
                <input type="text" name="number" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $author->phone) }}" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Author</button>
        </form>
    </div>
@endsection
