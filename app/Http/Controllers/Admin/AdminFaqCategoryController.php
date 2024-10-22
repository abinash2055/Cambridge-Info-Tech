<?php

namespace App\Http\Controllers\Admin;

use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\CompanyCategory;

class AdminFaqCategoryController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $jobCount = Post::count();
        $authorCount = User::where('role', 'author')->count();
        $liveJobCount = Post::where('status', 'live')->count();
        $jobCategoriesCount = CompanyCategory::count();

        $categories = FaqCategory::all();
        return view('admin.faqs.faqCategoryIndex', compact('userCount', 'jobCount', 'authorCount', 'liveJobCount', 'categories', 'jobCategoriesCount'));
    }

    public function create()
    {
        return view('admin.faqs.faqCategoryCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);


        $name = $request->name;
        $status = $request->status;

        $faqCategory = new FaqCategory();
        $faqCategory->name = $name;
        $faqCategory->slug = $faqCategory->setSlugAttribute();
        $faqCategory->status = $status;
        $faqCategory->save();

        Alert::toast('FAQ Category created successfully!', 'success');
        return redirect()->route('faqs-categories.index');
    }

    public function edit($id)
    {
        $faqCategory = FaqCategory::findOrFail($id);
        return view('admin.faqs.faqCategoryEdit', compact('faqCategory'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        $faqCategory = FaqCategory::findOrFail($id); 

        // Update the FAQ category
        $faqCategory->name = $request->name;
        $faqCategory->status = $request->status;
        
        // if ($faqCategory->getOriginal('name') !== $request->name) {
        //     $faqCategory->slug = Str::slug($request->name, '-') . '-' . time();
        // }
        
        $faqCategory->save();

        Alert::toast('FAQ Category updated successfully!', 'success');
        return redirect()->route('faqs-categories.index');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        Alert::toast('FAQ Category deleted successfully!', 'success');
        return redirect()->route('faqs-categories.index');
    }
}
