<?php

namespace App\Http\Controllers\Front;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function __invoke()
    {
        $faqs = Faq::all();
        return view('front.faq', compact('faqs'));
    }
}
