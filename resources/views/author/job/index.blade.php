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
                    <div class="table-responsive pt-3">
                        <table class="table table-hover table-striped small">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Applicant Name</th>
                                    <th>Email</th>
                                    <th>Job Title</th>
                                    <th>Applied on</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($applications && $applications->count())
                                    @foreach ($applications as $application)
                                        <tr>
                                            <td>1</td>
                                            <td>{{ optional($application->user)->name }}</td>
                                            <td><a
                                                    href="mailto:{{ optional($application->user)->email }}">{{ optional($application->user)->email }}</a>
                                            </td>
                                            <td><a
                                                    href="{{ route('post.show', ['job' => optional($application->post)->id]) }}">{{ substr(optional($application->post)->job_title, 0, 14) }}...</a>
                                            </td>
                                            <td>{{ $application->created_at }}</td>
                                            <td>
                                                <a href="{{ route('author.jobApplication.show', ['id' => $application]) }}"
                                                    class="btn primary-outline-btn">View</a>
                                                <form action="{{ route('author.jobApplication.destroy') }}" method="POST"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="application_id"
                                                        value="{{ $application->id }}">
                                                    <button type="submit" class="btn danger-btn">Delete</button>
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
                    <div class="d-flex justify-content-center mt-4 custom-pagination">
                        {{ $applications && $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal for Post -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete Author</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong id="authorName"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var deleteUrl, postTitle;

            // Trigger the modal on delete button click using event delegation
            $('.delete-btn').on('click', function() {
                deleteUrl = $(this).data('url'); // Get the route URL from data-url
                postTitle = $(this).data('postTitle'); // Get the author name
                
                // Optionally, display the author's name in the modal
                $('#postTitle').text(postTitle);

                $('#deleteModal').modal('show');
            });

            // Handle the delete action when confirm is clicked
            $('#confirmDeleteBtn').on('click', function() {
                $.ajax({
                    url: deleteUrl, // Use the dynamic URL from the button
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF protection for Laravel
                    },
                    success: function(result) {
                        $('#deleteModal').modal('hide');
                        location.reload(); // Reload page after deletion
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Something went wrong!');
                    }
                });
            });
        });
    </script>
@endpush