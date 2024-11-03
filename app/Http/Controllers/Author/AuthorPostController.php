<?php

namespace App\Http\Controllers\Author;


use App\Http\Controllers\Controller;
use App\Events\PostViewEvent;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Post;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AuthorPostController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        if (!auth()->user()->company) {
            Alert::toast('You must create a company first!', 'info');
            return redirect()->route('author.company.create');
        }
        return view('author.post.create');
    }

    public function store(Request $request)
    {
        $this->requestValidate($request);
        
        $data = $request->all();
        $data['skills'] = implode(',', $request->skills);
        $data['specifications'] = $request->specifications ?? '';

        $postData = array_merge(['company_id' => auth()->user()->company->id], $data);

        $post = Post::create($postData);
        if ($post) {
            Alert::toast('Post listed!', 'success');
            return redirect()->route('author.authorSection');
        }
        Alert::toast('Post failed to list!', 'warning');
        return redirect()->back();
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        event(new PostViewEvent($post));
        $company = $post->company()->first();

        $similarPosts = Post::whereHas('company', function ($query) use ($company) {
            return $query->where('company_category_id', $company->company_category_id);
        })->where('id', '<>', $post->id)->with('company')->take(5)->get();
        return view('account.post.show')->with([
            'post' => $post,
            'company' => $company,
            'similarJobs' => $similarPosts
        ]);
    }

    public function edit(Post $post)
    {
        $companies = Company::all();
        
        return view('author.post.edit', compact('post', 'companies'));
    }

    public function update(Request $request, Post $post)
    {
        // dd($request->all());
        $request->validate([
            'company_id' => 'required|integer',
            'job_title' => 'required|string|max:255',
            'job_level' => 'required|string|max:255',
            'vacancy_count' => 'required|integer',
            'employment_type' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'job_location' => 'required|string|max:255',
            'deadline' => 'required|date',
            'education_level' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'skills' => 'required|array', 
            'skills.*' => 'string|max:255',
            'specifications' => 'nullable|string|max:500', 
            'status' => 'required|string|max:255',
        ]);

        // Convert skills array to comma-separated string
        $data = $request->all();
        $data['skills'] = implode(',', $request->skills);
         $data['specifications'] = $request->specifications ?? '';

        // Update the post with all data except skills (handled above)

        // dd($data);
        $post->update($data);
        Alert::toast('Job post updated successfully!!', 'success');
        return redirect()->route('author.authorSection');
    }


    public function destroy(Post $post)
    {
        if ($post->delete()) {
            Alert::toast('Post successfully deleted!', 'success');
            
            return response()->json(['success' => 'Post deleted successfully.']);
        }
        // return redirect()->back();
        return response()->json(['error' => 'Failed to delete Post.'], 500);
    }

    protected function requestValidate($request)
    {
        return $request->validate([
            'job_title' => 'required|min:3',
            'job_level' => 'required',
            'vacancy_count' => 'required|int',
            'employment_type' => 'required',
            'job_location' => 'required',
            'salary' => 'required',
            'deadline' => 'required',
            'education_level' => 'required',
            'experience' => 'required',
            'skills' => 'required|array', 
            'skills.*' => 'string|max:255', 
            'specifications' => 'sometimes|min:5',
        ]);
    }

    public function viewAllJobs()
    {
        $activeJobs = Post::where('status', 'active')->paginate(10);  
        $dashCount = [
            'activeJobs' => Post::where('status', 'active')->count(),
            'totalJobs' => Post::count(),
            'livePost' => Post::where('status', 'live')->count(),
        ];
        $jobCategories = CompanyCategory::all();  
        return view('author.view-all-jobs', compact('activeJobs', 'dashCount', 'jobCategories'));
    }
}
