<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CompanyCategory;
use App\Models\Company;
use App\Events\PostViewEvent;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

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
        return view('web.contactUs'); // Adjust the path if necessary
    }

    // Handle the contact form submission
    public function contact(Request $request)
    {
        // Validate the form data
        $request->validate([
            'inquiry_type' => 'required|string',
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Prepare the data for the email
        $data = [
            'inquiry_type' => $request->input('inquiry_type'),
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        // Send the email
        // Mail::to('hisubedisushil@gmail.com') // Replace with the admin's email address
        Mail::to('pabinashnath@gmail.com') // Replace with the admin's email address
            ->send(new ContactMail($data));

        // Redirect back with a success message
        Alert::toast('Your message has been sent successfully!', 'success');
        return redirect()->route('contact');
    }


    // Show the FAQ page
    public function faq()
    {
        return view('web.faq'); 
    }
}
