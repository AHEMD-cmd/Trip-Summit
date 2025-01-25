<?php

namespace App\Http\Controllers\User;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    
    public function index()
    {
        $wishlist = Auth::user()->wishlist()->with('package')->get();
        return view('user.wishlist', compact('wishlist'));
    }

    public function destroy($id)
    {
        $obj = Wishlist::where('id',$id)->first();
        $obj->delete();
        return redirect()->back()->with('success', 'Wishlist item is deleted successfully!');
    }
}
