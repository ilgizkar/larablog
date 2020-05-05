@extends('layouts/admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        Все пользователи
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Пользователь</th>
                                    <th>Email</th>
                                    <th>Посты</th>
                                    <th>Комменты</th>
                                    <th>Начало</th>
                                    <th>Изменен</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\User::all() as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->posts->count() }}</td>
                                        <td>{{ $user->comments->count() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</td>
                                        <td>
                                            <a title="Редактировать пользователя" href="{{ route('adminShowUpdateUser', $user->id) }}" class="btn btn-sm btn-success">Редактировать</a>
                                            <button title="Удалить пользователя" class="btn btn-sm btn-danger" type="submit" data-toggle="modal" data-target="#deletePostModal_{{ $user->id }}">Удалить</button>
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
    @foreach(\App\User::all() as $user)
        <div class="modal fade" id="deletePostModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Подтвердите запрос</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Вы действительно хотите удалить этого пользователя?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                        <form id="deleteUser_{{ $user->id }}" action="{{ route('adminDeleteUser', $user->id) }}" method="POST" style="display: contents">
                            @csrf
                            <button title="Удалить пользователя" class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
