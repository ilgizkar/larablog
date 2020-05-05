@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Редактирование пользователя
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
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

                        <form action="{{ route('adminUpdateUser', $user->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col-md-3 mb-4">
                                        <div>Личная информация</div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="form-control-label">Имя</label>
                                                    <input name="name" class="form-control" value="{{ $user->name }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="form-control-label">Email</label>
                                                    <input name="email" class="form-control" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <label class="form-control-label">Роли</label>
                                                <div class="form-check">
                                                    <input name="author" type="checkbox" {{ $user->author == true ? 'checked' : '' }} class="form-check-input" value="1" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">Автор</label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="admin" type="checkbox" {{ $user->admin == true ? 'checked' : '' }} class="form-check-input" value="1" id="exampleCheck2">
                                                    <label class="form-check-label" for="exampleCheck2">Администратор</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer bg-light text-right">
                                <button type="submit" class="btn btn-success mr-3">Сохранить</button>
                                <a href="{{ route('adminUsers') }}" class="btn btn-primary">Назад</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
