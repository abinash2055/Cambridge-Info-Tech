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

                    <div class="d-flex">

                        <button class="btn btn-primary me-3 filter-btn" data-filter="all">All Application</button>
                        <button class="btn btn-success me-3 filter-btn" data-filter="shortlisted">Shortlisted
                            Application</button>
                        <button class="btn btn-danger filter-btn" data-filter="rejected">Reject Application</button>
                    </div>

                    <div id="application-data">
                        <!-- All the Remaining data -->
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

                                                <td>{{ ucfirst($application->status) }}</td>


                                                <td>
                                                    <a href="{{ route('author.jobApplication.show', ['application' => $application->id]) }}"
                                                        class="btn primary-outline-btn">View Details</a>
                                                </td>

                                                <td>
                                                    <a href="#" class="btn btn-danger">Reject</a>
                                                    <form action="{{ route('author.jobApplication.destroy') }}"
                                                        method="POST" class="d-inline-block">
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
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.filter-btn');
        const dataContainer = document.getElementById('application-data');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.getAttribute('data-filter');
                filterData(filter);
            });
        });

        function filterData(filter) {

            // Filter the data based on the status
            let filteredData = data;
            if (filter !== 'all') {
                filteredData = data.filter(item => item.status === filter);
            }

            // Clear the current data container and display the filtered results
            dataContainer.innerHTML = '';
            filteredData.forEach(item => {
                const div = document.createElement('div');
                div.textContent = item.content;
                dataContainer.appendChild(div);
            });
        }
    });
</script>
