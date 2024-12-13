@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Viewing all posts <span class="badge badge-primary">All Posts</span>
        </div>
        <div class="account-bdy p-3">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="table-responsive pt-3">
                        <table class="table table-hover table-striped small">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Job Title </th>
                                    <th>Company Name</th>
                                    <th> Author Name </th>
                                    <th> Created On </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($posts->count())
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->job_title }}</td>

                                            {{-- Need relation from post to company->title --}}
                                            <td>{{ $post->company->title ?? 'N/A' }}</td>


                                            {{-- Need relation from post to company then company to user->name --}}
                                            <td> {{ $post->company->user->name ?? 'N/A' }}</td>

                                            <td>{{ $post->created_at }}</td>
                                            <td>
                                                <a href="{{ route('account.applyJob', ['post_id' => $post->id]) }}"
                                                    class="btn btn-info">
                                                    View
                                                </a>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn toggle-status-btn {{ $post->is_active ? 'btn-success' : 'btn-danger' }}"
                                                    data-id="{{ $post->id }}" data-title="{{ $post->title }}"
                                                    data-status="{{ $post->is_active ? 'active' : 'inactive' }}">
                                                    {{ $post->is_active ? 'Active' : 'Deactivate' }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No posts available.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4 custom-pagination">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.toggle-status-btn').on('click', function() {
                var button = $(this);
                var postId = button.data('id');
                var status = button.data('status');

                $.ajax({
                    url: "{{ route('admin.post.toggleStatus') }}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: postId
                    },
                    success: function(response) {
                        if (response.success) {
                            if (status === 'active') {
                                button.removeClass('btn-success').addClass('btn-danger');
                                button.text('Deactivate');
                                button.data('status', 'inactive');
                            } else {
                                button.removeClass('btn-danger').addClass('btn-success');
                                button.text('Active');
                                button.data('status', 'active');
                            }
                        } else {
                            alert('Could not update the status. Please try again.');
                        }
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
