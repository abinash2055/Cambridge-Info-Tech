<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AuthorJobApplicationController extends Controller
{
    public function index()
    {
        $applicationsWithPostAndUser = null;
        $company = auth()->user()->company;

        if ($company) {
            $ids =  $company->posts()->pluck('id');
            $applications = JobApplication::whereIn('post_id', $ids);
            $applicationsWithPostAndUser = $applications->with('user', 'post')->latest()->paginate(10);
        }

        return view('author.job.index')->with([
            'applications' => $applicationsWithPostAndUser,
        ]);
    }
    public function show($id)
    {
        $application = JobApplication::find($id);

        $post = $application->post()->first();
        $userId = $application->user_id;
        $applicant = User::find($userId);

        $company = $post->company()->first();
        return view('author.job.show')->with([
            'applicant' => $applicant,
            'post' => $post,
            'company' => $company,
            'application' => $application
        ]);
    }
    public function destroy(Request $request)
    {
        $application = JobApplication::find($request->application_id);
        $application->delete();
        Alert::toast('Company deleted', 'warning');
        return redirect()->route('author.jobApplication.index');
    }

    public function jobList()
    {
        $activeJobs = Post::with('company')->oldest()->paginate(10);
        $dashCount = $this->getDashCount();
        $jobCategories = CompanyCategory::all();

        return view('author.job.view-all-jobs')->with([
            'activeJobs' => $activeJobs,
            'dashCount' => $dashCount,
            'jobCategories' => $jobCategories,
        ]);
    }

    // For Complete Job Details
    protected function getDashCount()
    {
        return [
            'totalJobs' => Post::count(),
            'activeJobs' => Post::where('status', 'active')->count(),
            'inactiveJobs' => Post::where('status', 'inactive')->count(),
            'livePost' => Post::where('deadline', '>', Carbon::now())->count(),
            'authors' => User::role('author')->count(),
        ];
    }
}
