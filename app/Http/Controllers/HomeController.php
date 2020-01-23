<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use App\Post;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $profile = Auth::user()->profile;
       $post = DB::table('posts')->simplePaginate(2);
    //    $post = DB::table('posts')->paginate(2);
        return view('home' ,['posts' => $post],compact('profile'));
    }
}
