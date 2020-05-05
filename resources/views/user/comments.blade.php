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
                                    <th>Пост</th>
                                    <th>Коммент</th>
                                    <th>Дата</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Auth::user()->comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td class="text-nowrap"><a href="{{ route('singlePost', $comment->post->id) }}">{{ $comment->post->title }}</a></td>
                                    <td>{{ $comment->content }}</td>
                                    <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <button title="Удалить комментарий" class="btn btn-sm btn-danger" type="submit" data-toggle="modal" data-target="#deletePostModal_{{ $comment->id }}">Удалить</button>
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
    @foreach(Auth::user()->comments as $comment)
        <div class="modal fade" id="deletePostModal_{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Подтвердите запрос</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Вы действительно хотите удалить этот комментарий?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                        <form id="deleteComment_{{ $comment->id }}" action="{{ route('deleteComment', $comment->id) }}" method="POST" style="display: contents">
                            @csrf
                            <button title="Удалить пост" class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
