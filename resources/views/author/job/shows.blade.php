@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Job Application
        </div>
        <div class="account-bdy p-3">
            <p class="alert alert-primary">
                User named <span class="text-capitalize"> ({{ optional($applicant)->name }})</span> applied for your listing
                on {{ $application->created_at }}
            </p>

            <div class="row">
                <div class="col-sm-12 col-md-12 mb-5">
                    <div class="card">
                        <div class="card-header">
                            User Profile (Applicant)
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('images/user-profile.png') }}" class="img-fluid rounded-circle"
                                        alt="">
                                </div>
                                <div class="col-9">
                                    <h6 class="text-info text-capitalize">{{ optional($applicant)->name }}</h6>
                                    <p class="my-2"><i class="fas fa-envelope"></i> Email:
                                        {{ optional($applicant)->email }}</p>
                                    <a href="mailto:{{ optional($applicant)->email }}" class="btn primary-btn"
                                        title="click to send email">Send user an email</a>
                                    <a href="{{ asset('storage/' . optional($applicant)->cv) }}" class="btn btn-success"
                                        title="click to view CV">View CV</a>

                                    <!-- Status Dropdown -->
                                    <form action="{{ route('author.jobApplication.saveStatus') }}" method="POST">
                                        @csrf
                                        @foreach ($applications as $application)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ optional($application->user)->name }}</td>
                                                <td>
                                                    <select name="statuses[{{ $application->id }}]" class="form-select">
                                                        <option value="pending"
                                                            {{ $application->status == 'pending' ? 'selected' : '' }}>
                                                            Pending</option>
                                                        <option value="shortlisted"
                                                            {{ $application->status == 'shortlisted' ? 'selected' : '' }}>
                                                            Shortlisted</option>
                                                        <option value="rejected"
                                                            {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                                            Rejected</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <button type="submit" class="btn primary-outline-btn">Save</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        Key Job Requirements
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 d-flex align-items-center border p-3">
                                <img src="{{ asset(optional($company)->logo) }}" class="img-fluid" alt="">
                            </div>
                            <div class="col-9">
                                <p class="h4 text-info text-capitalize">
                                    {{ optional($post)->job_title }}
                                </p>
                                <h6 class="text-uppercase">
                                    <a href="{{ route('employer.show', ['employer' => optional($company)->id]) }}">
                                        {{ optional($company)->title }}
                                    </a>
                                </h6>
                                <p class="my-2"><i class="fas fa-map-marker-alt"></i> Location:
                                    {{ optional($post)->job_location }}</p>
                                @if ($post)
                                    <p class="text-danger small">
                                        {{ date('l, jS \of F Y', $post->deadlineTimestamp()) }},
                                        ({{ date('d', $post->remainingDays()) }} days from now)
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-end">
                            <div class="my-2">
                                <a href="{{ route('post.show', ['job' => optional($post)->id]) }}" class="secondary-link">
                                    <i class="fas fa-briefcase"></i> View Job
                                </a>
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-end">
                            <div class="small">
                                <a href="{{ route('author.jobApplication.index') }}" class="btn primary-outline-btn">Go
                                    back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection