@extends('layouts.account')

@section('content')
    <div class="account-layout  border">
        <div class="account-hdr bg-primary text-white border">
            Job Applications
        </div>
        <div class="account-bdy p-3">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <p class="mb-3 alert alert-primary">Listing all the Applicants who applied for your <strong>job
                            listings</strong>.</p>
                    {{-- Selecting all, shortlisted and rejected part --}}

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button">All Application</button>
                        <button class="btn btn-success" type="button">ShortListed Application</button>
                        <button class="btn btn-danger" type="button">Reject Application</button>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-hover table-striped small">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Applicant Name</th>
                                    <th>Email</th>
                                    <th>Job Title</th>
                                    <th>Applied on</th>
                                    <th>Status</th> <!-- Added Status column -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($applications && $applications->count())
                                    @foreach ($applications as $application)
                                        {{-- {{ dd($application->post->id) }} --}}
                                        <tr>
                                            <td>1</td>
                                            <td>{{ optional($application->user)->name }}</td>
                                            <td><a
                                                    href="mailto:{{ optional($application->user)->email }}">{{ optional($application->user)->email }}</a>
                                            </td>
                                            <td><a
                                                    href="{{ route('author.jobApplication.showJob', $application->post->id) }}">{{ substr(optional($application->post)->job_title, 0, 14) }}...</a>
                                            </td>
                                            <td>{{ $application->created_at }}</td>

                                            <td>
                                                <!-- Add status with a default value -->
                                                @if (session('applications'))
                                                    @php
                                                        $applications = session('applications');
                                                    @endphp
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('author.jobApplication.show', ['id' => $application]) }}"
                                                    class="btn primary-outline-btn">View Details</a>
                                            </td>

                                            <td>
                                                <a href="#" class="btn btn-danger">Reject</a>
                                                <form action="{{ route('author.jobApplication.destroy') }}" method="POST"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="application_id"
                                                        value="{{ $application->id }}">

                                                    {{-- <button type="submit" class="btn danger-btn">Delete</button> --}}
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>You haven't received any job applications.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>

                    {{-- Page Number Pagination --}}
                    {{-- <div class="d-flex justify-content-center mt-4 custom-pagination">
                        {{ $applications && $applications->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Reject Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Reject Application</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Reject the Application <strong></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Reject</button>
                </div>
            </div>
        </div>
    </div>
@endsection
