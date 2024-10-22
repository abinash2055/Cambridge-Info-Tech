<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    // Display a list of FAQs for a specific category
    public function index($categoryId)
    {
        $faqs = Faq::where('category_id', $categoryId)->get();
        $category = FaqCategory::findOrFail($categoryId);

        return view('admin.faqs.faqQuestionAnswer.faqIndex', compact('faqs', 'category'));
    }

    // Show the form for creating a new FAQ
    public function create($categoryId)
    {
        $categories = FaqCategory::all();
        return view('faqCreate', compact('categories'));
    }

    // Store a newly created FAQ in the database
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Faq::create($request->all());

        return redirect()->route('faqs.index', $request->category_id)
            ->with('success', 'FAQ created successfully.');
    }

    // Show the form for editing the specified FAQ
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $categories = FaqCategory::all();

        return view('faqEdit', compact('faq', 'categories'));
    }

    // Update the specified FAQ in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($request->all());

        return redirect()->route('faqs.index', $faq->category_id)
            ->with('success', 'FAQ updated successfully.');
    }

    // Remove the specified FAQ from the database
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return response()->json(['success' => 'FAQ deleted successfully.']);
    }
}
