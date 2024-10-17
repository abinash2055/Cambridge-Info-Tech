<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CompanyCategory;
use App\Models\Company;
use App\Events\PostViewEvent;

class WebController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(20)->with('company')->get();
        $categories = CompanyCategory::take(5)->get();
        $topEmployers = Company::latest()->take(3)->get();
        return view('web.home')->with([
            'posts' => $posts,
            'categories' => $categories,
            'topEmployers' => $topEmployers
        ]);
    }

    public function jobs()
    {
        return view('web.job.index');
    }

    public function job($id)
    {
        $post = Post::findOrFail($id);

        event(new PostViewEvent($post));
        $company = $post->company()->first();

        $similarPosts = Post::whereHas('company', function ($query) use ($company) {
            return $query->where('company_category_id', $company->company_category_id);
        })->where('id', '<>', $post->id)->with('company')->take(5)->get();
        return view('web.post.show')->with([
            'post' => $post,
            'company' => $company,
            'similarJobs' => $similarPosts
        ]);
    }


    public function employer($employer)
    {
        $company = Company::find($employer)->with('posts')->first();
        return view('web.employer.show')->with([
            'company' => $company,
        ]);
    }

    public function contactForm()
    {
        // dd(123123);
        return view('web.contactUs'); 
    }

    // Handle the contact form submission
    public function contact(Request $request)
    {
        // Validate the request
        $request->validate([
            'inquiry_type' => 'required',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:15',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }

    // Show the FAQ page
    public function faq()
    {
        return view('web.faq'); 
    }
}
