
@extends('layouts.account')

@section('content')
<div class="account-layout border">
    <div class="account-hdr bg-primary text-white border">
        My Applied Jobs
    </div>
    <div class="account-bdy p-3">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Job Position</th>
                        <th>Company</th>
                        <th>Applied On</th>
                        <th>Action of Post</th>
                    </tr>
                </thead>
                <tbody>
                    @if($applications->isEmpty())
                        <tr>
                            <td colspan="4">No applications found.</td>
                        </tr>
                    @else
                        @foreach ($applications as $application)
                            <tr>
                                <td>
                                    @if($application->post) <!-- Check if post exists -->
                                        <a href="{{ route('post.show', ['job' => $application->post]) }}">
                                            {{ $application->post->job_title }}
                                        </a>
                                    @else
                                        <span class="text-muted">Post not found</span> <!-- Handle case where post does not exist -->
                                    @endif
                                </td>
                                <td>
                                    @if($application->post && $application->post->company) <!-- Check if post and company exist -->
                                        {{ $application->post->company->title }}
                                    @else
                                        <span class="text-muted">Company not found</span> <!-- Handle case where company does not exist -->
                                    @endif
                                </td>
                                <td>{{ $application->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('post.show', ['job' => $application->post->id]) }}" method="GET">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn secondary-outline-btn">
                                                View Post Details
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

