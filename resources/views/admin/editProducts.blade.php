@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Редактироование товара
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
                            <form action="{{ route('adminPostEditProducts', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Заголовок</label>
                                            <input type="text" name="title" id="normal-input" class="form-control" value="{{ $product->title }}" placeholder="Введите заголовк товара">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="placeholder-input" class="form-control-label">Описание</label>
                                            <textarea name="description" id="placeholder-input" class="form-control" cols="30" rows="10" placeholder="Введите описание товара">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="price-input" class="form-control-label">Цена</label>
                                            <input type="number" name="price" id="price-input" value="{{ $product->price }}" class="form-control" placeholder="10.00">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Обложка</label>
                                            <input type="file" accept="image/*" name="thumbnail" id="normal-input" class="form-control">
                                            <img class="mt-3" src="{{ asset($product->thumbnail) }}" alt="" width="100">
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success mt-3" type="submit">Сохранить изменения</button>
                                <a class="btn btn-primary ml-2 mt-3" href="{{ route('adminProducts') }}" type="submit">Назад</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
