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
        $applicationsWithPostAndUser = collect();
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
        // Try to find the application by ID
        $application = JobApplication::find($id);

        // If no application is found, redirect or return an error
        if (!$application) {
            return redirect()->back()->withErrors('Job application not found.');
        }

        // Get the related post, if exists
        $post = $application->post()->first();
        if (!$post) {
            return redirect()->back()->withErrors('Post related to this application not found.');
        }

        // Get the applicant (user) by user_id
        $applicant = User::find($application->user_id);
        if (!$applicant) {
            return redirect()->back()->withErrors('Applicant not found.');
        }

        // Get the company related to the post, if exists
        $company = optional($post)->company()->first(); // Use optional in case $post or company is null

        // Return the view with the data
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
        // return redirect()->route('author.jobApplication.index');
        return response()->json(['success' => 'User deleted successfully.']);
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
