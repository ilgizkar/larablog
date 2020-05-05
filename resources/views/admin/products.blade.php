@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        Товары
                        <a href="{{ route('adminNewProducts') }}" class="btn float-right btn-primary">Добавить товар</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Обложка</th>
                                    <th>Заголовок</th>
                                    <th>Описание</th>
                                    <th>Цена</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><img src="{{ asset($product->thumbnail) }}" alt="" width="100"></td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->price }} USD</td>
                                        <td>
                                            <a title="Редактировать товар" href="{{ route('adminEditProducts', $product->id) }}" class="btn btn-sm btn-success">Редактировать</a>
                                            <button title="Удалить товар" class="btn btn-sm btn-danger" type="submit" data-toggle="modal" data-target="#deletePostModal_{{ $product->id }}">Удалить</button>
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
    @foreach($products as $product)
        <div class="modal fade" id="deletePostModal_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Подтвердите запрос</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Вы действительно хотите удалить этот товар?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                        <form id="deleteProduct_{{ $product->id }}" action="{{ route('adminDeleteProducts', $product->id) }}" method="POST" style="display: contents">
                            @csrf
                            <button title="Удалить пост" class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
