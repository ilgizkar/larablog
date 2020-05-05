<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Comment;
use App\Http\Requests\CreatePost;
use App\Http\Requests\UserUpdate;
use App\Post;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole:admin');
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $chart = new DashboardChart();
        $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());
        $users = [];

        foreach ($days as $day) {
            $users[] = User::whereDate('created_at', $day)->count();
        }
        $chart->dataset('Пользователи', 'line', $users);
        $chart->labels($days);

        return view('admin.dashboard', ['chart' => $chart]);
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
        return view('admin.comments');
    }

    public function posts()
    {
        return view('admin.posts');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function deletePost($id)
    {
        $post = Post::where('id', $id)->first();
        if($post) {
            $post->delete();
        }
        return back();
    }

    public function showUpdatePost($id)
    {
        $post = Post::find($id);
        return view('admin.updatePost', ['post' => $post]);
    }

    public function updatePost(CreatePost $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();

        return back()->with('success', 'Ваш пост успешно изменен!');
    }

    public function deleteComment($id)
    {
        $comment = Comment::where('id', $id)->first();
        if($comment) {
            $comment->delete();
        }
        return back();
    }

    public function deleteUser($id)
    {
        $comment = User::where('id', $id)->first();
        if($comment) {
            $comment->delete();
        }
        return back();
    }

    public function showUpdateUser($id)
    {
        $user = User::find($id);
        return view('admin.updateUser', ['user' => $user]);
    }

    public function updateUser(UserUpdate $request, $id)
    {
        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        if($request['author'] == 1) {
            $user->author = true;
        }
        if($request['admin'] == 1) {
            $user->admin = true;
        }
        $user->save();

        return back()->with('success', 'Пользователь успешно изменен!');
    }

    public function products()
    {
        $products = Product::all();
        return view('admin.products', ['products' => $products]);
    }

    public function editProducts($id)
    {
        $product = Product::find($id);
        return view('admin.editProducts', ['product' => $product]);
    }

    public function newProducts()
    {
        return view('admin.newProducts');
    }

    public function postNewProducts(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'thumbnail' => 'required|file',
            'description' => 'required',
            'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ]);
        $product = new Product();

        $product->title = $request['title'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $thumbnail = $request->file('thumbnail');
        $fileName = $thumbnail->getClientOriginalName();
        $fileExtension = $thumbnail->getClientOriginalExtension();
        $thumbnail->move('product-images', $fileName);
        $product->thumbnail = 'product-images/' . $fileName;
        $product->save();

        return back();
    }

    public function postEditProducts(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'thumbnail' => 'file',
            'description' => 'required',
            'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ]);
        $product = Product::find($id);

        $product->title = $request['title'];
        $product->description = $request['description'];
        $product->price = $request['price'];

        if($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $fileName = $thumbnail->getClientOriginalName();
            $fileExtension = $thumbnail->getClientOriginalExtension();
            $thumbnail->move('product-images', $fileName);
            $product->thumbnail = 'product-images/' . $fileName;
        }

        $product->save();

        return back()->with('success', 'Товар успешно изменен!');
    }

    public function deleteProducts($id)
    {
        $product = Product::where('id', $id)->first();
        if($product) {
            $product->delete();
        }
        return back();
    }
}
