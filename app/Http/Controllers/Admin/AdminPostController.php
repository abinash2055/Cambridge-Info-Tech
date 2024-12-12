<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.post.view-all-applications', compact('posts'));
    }

    public function toggleStatus(Request $request)
    {
        $post = Post::find($request->id);
        if ($post) {
            $post->is_active = !$post->is_active;
            $post->save();

            return response()->json(['success' => true, 'status' => $post->is_active ? 'active' : 'inactive']);
        }
        return response()->json(['success' => false], 400);
    }

    public function destroyPost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        Alert::toast('Post deleted successfully!', 'success');
        return response()->json(['success' => 'Post deleted successfully.']);
    }
}
