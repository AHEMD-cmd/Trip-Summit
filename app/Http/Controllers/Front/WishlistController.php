<?php

namespace App\Http\Controllers\Front;

use App\Models\Package;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __invoke(Package $package)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', 'Please login first to add this item to your wishlist!');
        }
        
        $user_id = Auth::guard('web')->user()->id;

        $check = Wishlist::where('user_id', $user_id)->where('package_id', $package->id)->count();
        if ($check > 0) {
            return redirect()->back()->with('error', 'This item is already in your wishlist!');
        }

        $wishlist = new Wishlist();
        $wishlist->user_id = $user_id;
        $wishlist->package_id = $package->id;
        $wishlist->save();

        return redirect()->back()->with('success', 'Item is added to your wishlist!');
    }
}
