<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqStoreRequest;
use App\Http\Requests\Admin\FaqUpdateRequest;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::get();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(FaqStoreRequest $request)
    {
        $data = $request->validated();
        Faq::create($data);

        return redirect()->route('faqs.index')->with('success', 'FAQ Created Successfully');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(FaqUpdateRequest $request, Faq $faq)
    {
        $data = $request->validated();
        $faq->update($data);

        return redirect()->route('faqs.index')->with('success', 'FAQ Updated Successfully');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faqs.index')->with('success', 'FAQ Deleted Successfully');
    }

}
