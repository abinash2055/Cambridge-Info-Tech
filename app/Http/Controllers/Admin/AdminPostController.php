<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPostController extends Controller
{
    public function viewAllApplications()
    {
        $applications = Post::select('company_id', 'job_title')->oldest()->paginate(10);
        return view('admin.post.view-all-applications')->with([
            'applications' => $applications
        ]);
    }

    public function destroyApplication($id)
    {
        $application = Post::where('id', $id)->first();
        $application->delete();
        Alert::toast('Post deleted successfully!', 'success');

        return response()->json(['success' => 'Post deleted successfully.']);
    }
}
