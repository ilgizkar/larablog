@extends('layouts/admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        Комментарии
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Пользователь</th>
                                    <th>Пост</th>
                                    <th>Коммент</th>
                                    <th>Дата</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->user->name }}</td>
                                        <td class="text-nowrap"><a href="{{ route('singlePost', $comment->post->id) }}">{{ $comment->post->title }}</a></td>
                                        <td>{{ $comment->content }}</td>
                                        <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
