<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(2);
        return view('welcome', ['posts' => $posts]);
    }

    public function singlePost(Post $post)
    {
        return view('singlePost', ['post' => $post]);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactPost()
    {
        return view('contact');
    }

    public function dashboard()
    {
        if(Auth::user()->admin == true) {
            return redirect(route('adminDashboard'));
        } elseif(Auth::user()->author == true) {
            return redirect(route('authorDashboard'));
        } else {
            return redirect(route('userDashboard'));
        }
    }
}
