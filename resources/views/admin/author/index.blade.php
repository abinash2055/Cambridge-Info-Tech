@extends('layouts.account')

@section('content')
<div class="account-layout border">
    <div class="account-hdr bg-primary text-white border">
        Author List
    </div>

    <div class="account-bdy p-3">
        <div class="row mb-3">
            <div class="col-xl-4 col-sm-6 py-2">
                <div class="card dashboard-card text-white h-100 shadow">
                    <div class="card-body primary-bg">
                        <div class="rotate">
                            <i class="fas fa-users fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Users</h6>
                        <h1 class="">{{ $userCount }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 py-2">
                <div class="card dashboard-card text-white h-100 shadow">
                    <div class="card-body bg-secondary">
                        <div class="rotate">
                            <i class="fas fa-building fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Total Jobs</h6>
                        <h1 class="">{{ $jobCount }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 py-2">
                <div class="card dashboard-card text-white h-100 shadow">
                    <div class="card-body bg-info">
                        <div class="rotate">
                            <i class="fas fa-user-tie fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Authors</h6>
                        <h1 class="">{{ $authorCount }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-sm-6 py-2">
                <div class="card dashboard-card text-white h-100 shadow">
                    <div class="card-body bg-danger">
                        <div class="rotate">
                            <i class="fas fa-star-of-life fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Live Jobs</h6>
                        <h1 class="">{{ $liveJobCount }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-sm-6 py-2">
                <div class="card dashboard-card text-white h-100 shadow">
                    <div class="card-body bg-warning">
                        <div class="rotate">
                            <i class="fas fa-industry fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Company Categories</h6>
                        <h1 class="">{{ $jobCategoriesCount }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flexbox container for Author List title and Add button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Author List</h1>
            <a href="{{ route('admin.author.create') }}" class="btn btn-primary">Add New Author</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($authors as $author)
                <tr>
                    <td>{{ $author['name'] }}</td>
                    <td>{{ $author['email'] }}</td>
                    <td>
                        <a href="{{ route('admin.author.edit', $author->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('admin.author.manageCompany', $author->id) }}" class="btn btn-info">Manage Company</a>
                        <form action="{{ route('admin.author.delete', $author->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
