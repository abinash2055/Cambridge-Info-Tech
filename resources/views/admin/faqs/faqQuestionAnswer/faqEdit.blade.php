@extends('layouts.post')

@section('content')
    <div class="container">
        <div class="account-layout border">
            <div class="account-hdr bg-primary text-white border">
                Edit FAQ
            </div>

            <div class="account-bdy p-3">
                <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="category_id">FAQ Category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $faq->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" name="question" id="question" class="form-control" value="{{ $faq->question }}" required>
                    </div>

                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea name="answer" id="answer" class="form-control" rows="5" required>{{ $faq->answer }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ $faq->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $faq->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update FAQ</button>
                </form>
            </div>
        </div>
    </div>
@endsection
