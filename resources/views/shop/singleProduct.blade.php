@extends('layouts.master')

@section('content')
    <header class="masthead" style="background-image: url({{ asset('assets/img/home-bg.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>{{ $product->title }}</h1>
                        <span class="subheading">Какой то слоган к товару</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset($product->thumbnail) }}" width="500" alt="">
            </div>
            <div class="col-md-6 offset-1">
                <h2>{{ $product->title }}</h2>
                <hr>
                {{ $product->description }}
                <hr>
                <b>${{ $product->price }} USD</b>
                <br>
                <a href="" class="btn mt-5 btn-primary">Добавить в корзину</a>
            </div>
        </div>
    </div>
@endsection
