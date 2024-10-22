@extends('layouts.post')

@section('content')
    <div class="container">
        <div class="account-layout border">
            <div class="account-hdr bg-primary text-white border">
                Create FAQ
            </div>

            <div class="account-bdy p-3">
                <form action="{{ route('faqs.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="category_id">FAQ Category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" name="question" id="question" class="form-control" placeholder="Enter FAQ question" required>
                    </div>

                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea name="answer" id="answer" class="form-control" placeholder="Enter FAQ answer" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create FAQ</button>
                </form>
            </div>
        </div>
    </div>
@endsection
