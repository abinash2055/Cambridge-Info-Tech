@extends('layouts.app')

@section('content')
    <h1>FAQs</h1>
    <a href="{{ route('faqs.create') }}" class="btn btn-primary">Add FAQ</a>
    <ul>
        @foreach ($faqs as $faq)
            <li>
                <strong>{{ $faq->question }}</strong><br>
                {{ $faq->answer }}
            </li>
        @endforeach
    </ul>
@endsection
