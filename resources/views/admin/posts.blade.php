@extends('layouts/admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        Посты
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Автор</th>
                                    <th>Заголовок</th>
                                    <th>Текст</th>
                                    <th>Дата</th>
                                    <th>Комментарии</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Post::all() as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td class="text-nowrap"><a href="{{ route('singlePost', $post->id) }}">{{ $post->title }}</a></td>
                                        <td>{{ $post->content }}</td>
                                        <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                                        <td>{{ $post->comments->count() }}</td>
                                        <td>
                                            <a title="Редактировать пост" href="{{ route('adminShowUpdatePost', $post->id) }}" class="btn btn-sm btn-success">Редактировать</a>
                                            <button title="Удалить пост" class="btn btn-sm btn-danger" type="submit" data-toggle="modal" data-target="#deletePostModal_{{ $post->id }}">Удалить</button>
                                        </td>
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
    @foreach(\App\Post::all() as $post)
        <div class="modal fade" id="deletePostModal_{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Подтвердите запрос</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Вы действительно хотите удалить этот пост?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                        <form id="deletePost_{{ $post->id }}" action="{{ route('adminDeletePost', $post->id) }}" method="POST" style="display: contents">
                            @csrf
                            <button title="Удалить пост" class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
