<?php

Route::get('/','PublicController@index')->name('index');
Route::get('/post/{post}','PublicController@singlePost')->name('singlePost');
Route::get('/about','PublicController@about')->name('about');
Route::get('/contact','PublicController@contact')->name('contact');
Route::post('/contact','PublicController@contactPost')->name('contactPost');

Route::get('/dashboard','PublicController@dashboard')->name('dashboard');

Auth::routes();

Route::prefix('/user')->group(function () {
    Route::get('/dashboard', 'UserController@dashboard')->name('userDashboard');
    Route::post('/new-comment/{post_id}', 'UserController@newComment')->name('newComment');
    Route::get('/comments', 'UserController@comments')->name('userComments');
    Route::post('/comment/{id}/delete', 'UserController@deleteComment')->name('deleteComment');
    Route::get('/profile', 'UserController@profile')->name('userProfile');
    Route::post('/profile', 'UserController@profilePost')->name('userProfilePost');
});

Route::prefix('/author')->group(function () {
    Route::get('/dashboard', 'AuthorController@dashboard')->name('authorDashboard');
    Route::get('/comments', 'AuthorController@comments')->name('authorComments');
    Route::get('/posts', 'AuthorController@posts')->name('authorPosts');
    Route::post('/posts/{id}/delete', 'AuthorController@deletePost')->name('deletePost');
    Route::get('/posts/{id}/update', 'AuthorController@showUpdatePost')->name('showUpdatePost');
    Route::post('/posts/{id}/update', 'AuthorController@updatePost')->name('updatePost');
    Route::get('/posts/new', 'AuthorController@newPost')->name('newPost');
    Route::post('/posts/new', 'AuthorController@createPost')->name('createPost');
});

Route::prefix('/admin')->group(function (){
    Route::get('/dashboard', 'AdminController@dashboard')->name('adminDashboard');
    Route::get('/comments', 'AdminController@comments')->name('adminComments');
    Route::get('/posts', 'AdminController@posts')->name('adminPosts');
    Route::get('/users', 'AdminController@users')->name('adminUsers');
    Route::post('/posts/{id}/delete', 'AdminController@deletePost')->name('adminDeletePost');
    Route::get('/posts/{id}/update', 'AdminController@showUpdatePost')->name('adminShowUpdatePost');
    Route::post('/posts/{id}/update', 'AdminController@updatePost')->name('adminUpdatePost');
    Route::post('/comment/{id}/delete', 'AdminController@deleteComment')->name('adminDeleteComment');
    Route::post('/users/{id}/delete', 'AdminController@deleteUser')->name('adminDeleteUser');
    Route::get('/users/{id}/update', 'AdminController@showUpdateUser')->name('adminShowUpdateUser');
    Route::post('/users/{id}/update', 'AdminController@updateUser')->name('adminUpdateUser');

    Route::get('/products', 'AdminController@products')->name('adminProducts');
    Route::get('/products/{id}/edit', 'AdminController@editProducts')->name('adminEditProducts');
    Route::get('/products/new', 'AdminController@newProducts')->name('adminNewProducts');
    Route::post('/products/new', 'AdminController@postNewProducts')->name('adminPostNewProducts');
    Route::post('/products/{id}/edit', 'AdminController@postEditProducts')->name('adminPostEditProducts');
    Route::post('/products/{id}/delete', 'AdminController@deleteProducts')->name('adminDeleteProducts');
});

Route::prefix('/shop')->group(function (){
    Route::get('/', 'ShopController@index')->name('shop.index');
    Route::get('/product/{id}', 'ShopController@singleProduct')->name('shop.singleProduct');
    Route::get('/product/{id}/order', 'ShopController@orderProduct')->name('shop.orderProduct');
});
