<?php

namespace App\Http\Controllers\Admin;

use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class AdminFaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::all();
        return view('admin.faqs.faqCategoryIndex', compact('categories'));
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

        $faqCategory = FaqCategory::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        // Set the slug after creating the FAQ category
        $faqCategory->slug = Str::slug($faqCategory->name . '-' . time(), '-');
        $faqCategory->save();

        Alert::toast('FAQ Category created successfully!', 'success');
        return redirect()->route('faqs.categories.index');
    }

    public function edit(FaqCategory $faqCategory)
    {
        return view('admin.faqs.faqCategoryEdit', compact('faqCategory'));
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $faqCategory->name = $request->name;
        $faqCategory->status = $request->status;

        // Update the slug only if the name has changed
        if ($faqCategory->name !== $request->name) {
            $faqCategory->slug = Str::slug($request->name . '-' . time(), '-');
        }

        $faqCategory->save();

        Alert::toast('FAQ Category updated successfully!', 'success');
        return redirect()->route('faqs.categories.index');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        Alert::toast('FAQ Category deleted successfully!', 'success');
        return redirect()->route('faqs.categories.index');
    }
}
