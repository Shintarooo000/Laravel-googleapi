@extends('layouts.admin')
@section('title', '登録済みの所感一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>所感一覧</h2>
            <br>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\NewsController@add') }}" role="button" class="btn btn-primary">新規作成</a>
                <a href="{{ action('Admin\NewsController@index') }}" role="button" class="btn btn-primary">全体サマリーへ</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\NewsController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">名前</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_name" value="{{ $cond_name }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">名前</th>
                                <th width="10%">対象月</th>
                                <th width="40%">所感</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $news)
                                <tr>
                                    <th>{{ $news->id }}</th>
                                    <td>{{ \Str::limit($news->name, 100) }}</td>
                                    <td>{{ \Str::limit($news->month, 100) }}</td>
                                    <td>{{ \Str::limit($news->body, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\NewsController@edit', ['id' => $news->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\NewsController@delete', ['id' => $news->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection