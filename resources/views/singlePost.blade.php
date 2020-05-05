@extends('layouts.master')

@section('content')
<header class="masthead" style="background-image: url({{ asset('/assets/img/post-bg.jpg') }})">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1>{{ $post->title }}</h1>
{{--                    <h2 class="subheading">Problems look mighty small from 150 miles up</h2>--}}
                    <span class="meta">Опубликовал
              <a href="#">{{ $post->user->name }}</a>
              oт {{ date_format($post->created_at, 'F d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
               {!! $post->content !!}
            </div>
        </div>
        <div class="comment">
            <hr>
            <h3>Комментарии</h3>
            <hr>
            @foreach($post->comments as $comment)
            <p>{{ $comment->content }}</p>
            <p><small>написал {{ $comment->user->name }}, oт {{ date_format($comment->created_at, 'F d, Y') }}</small></p>
            @endforeach

            @if(Auth::check())
                <form action="{{ route('newComment', $post->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" class="form-control" id="" cols="30" rows="10" placeholder="Введите текст комментария"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn-success btn" type="submit">Отправить</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</article>
@endsection
