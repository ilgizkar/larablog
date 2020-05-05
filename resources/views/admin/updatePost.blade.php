@extends('layouts/admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Редактирование поста
                        </div>

                        @if(Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <form action="{{ route('adminUpdatePost', $post->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Заголовок</label>
                                            <input name="title" id="normal-input" class="form-control" placeholder="Введите заголовк поста" value="{{ $post->title }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="placeholder-input" class="form-control-label">Текст</label>
                                            <textarea name="content" id="placeholder-input" class="form-control" cols="30" rows="10" placeholder="Введите текст поста">{{ $post->content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success mt-3" type="submit">Сохранить</button>
                                <a class="btn btn-primary ml-2 mt-3" href="{{ route('adminPosts') }}">Назад</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
