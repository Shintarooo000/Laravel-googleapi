@extends('layouts.admin')
@section('title', '今月の振り返り')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>今月の振り返り</h2>
                <br>
                <form action="{{ action('Admin\NewsController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">担当者名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">対象年月</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="month" value="{{ old('month') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">所感</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-primary" value="更新">
                        <a href="{{ action('Admin\NewsController@impression') }}" role="button" class="btn btn-primary">所感一覧へ</a>
                        <a href="{{ action('Admin\NewsController@index') }}" role="button" class="btn btn-primary">全体サマリーへ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection