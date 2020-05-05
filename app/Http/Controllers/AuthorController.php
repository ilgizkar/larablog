<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Comment;
use App\Http\Requests\CreatePost;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole:author');
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $chart = new DashboardChart();
        $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());
        $posts = [];

        foreach ($days as $day) {
            $posts[] = Post::whereDate('created_at', $day)->where('user_id', Auth::id())->count();
        }
        $chart->dataset('Посты', 'line', $posts);
        $chart->labels($days);

        $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();

        $allComments = Comment::whereIn('post_id', $posts)->get();
        $todayComments = Comment::where('created_at', '>=', Carbon::today())->get();

        return view('author.dashboard', ['allComments' => $allComments, 'todayComments' => $todayComments, 'chart' => $chart]);
    }

    public function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];

        for($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y.m.d');
        }

        return $dates;
    }

    public function comments()
    {
        $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();
        $comments = Comment::whereIn('post_id', $posts)->get();
        return view('author.comments', ['comments' => $comments]);
    }

    public function posts()
    {
        return view('author.posts');
    }

    public function newPost()
    {
        return view('author.newPost');
    }

    public function createPost(CreatePost $request)
    {
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();

        return back()->with('success', 'Ваш пост успешно создан!');
    }

    public function deletePost($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        if($post) {
            $post->delete();
        }
        return back();
    }

    public function showUpdatePost($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        return view('author.updatePost', ['post' => $post]);
    }

    public function updatePost(CreatePost $request, $id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();

        return back()->with('success', 'Ваш пост успешно изменен!');
    }
}
