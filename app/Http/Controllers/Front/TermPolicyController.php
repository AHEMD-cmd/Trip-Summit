<?php

namespace App\Http\Controllers\Front;

use App\Models\TermPrivacyItem;
use App\Http\Controllers\Controller;

class TermPolicyController extends Controller
{
    public function terms()
    {
        $termPrivacyItem = TermPrivacyItem::first();
        return view('front.terms', compact('termPrivacyItem'));
    }

    public function privacy()
    {
        $termPrivacyItem = TermPrivacyItem::first();
        return view('front.privacy', compact('termPrivacyItem'));
    }
}
