@extends('layouts.app')

@section('content')
    <h1>Add FAQ</h1>
    <form action="{{ route('faqs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" class="form-control" name="question" id="question" required>
        </div>
        <div class="form-group">
            <label for="answer">Answer</label>
            <textarea class="form-control" name="answer" id="answer" required></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category (optional)</label>
            <input type="text" class="form-control" name="category" id="category">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
