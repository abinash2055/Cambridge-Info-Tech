@extends('layouts.post')

@section('content')
    <div class="container">
        <h1>Edit FAQ Category</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{ dd($faqCategory)}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('faqs-categories.update', $faqCategory) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name" id="name"
                    value="{{ old('name', $faqCategory->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status">
                    <option value="1" {{ old('status', $faqCategory->status) == '1' ? 'selected' : '' }}>Active
                    </option>
                    <option value="0" {{ old('status', $faqCategory->status) == '0' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="{{ route('faqs-categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>

    </div>
@endsection
