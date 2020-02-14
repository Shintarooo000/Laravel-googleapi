@extends('layouts.admin')

@section('title', 'SEO月間レポート')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>SEO月間レポート</h2>
            </div>
        </div>
         <div class="samary">
            <div class="col-md-8 mx-auto">
                <div class="month-table">
                  <table border="1">
                     <tr>
                        <th>月間</th><th>セッション</th><th>ユーザー</th><th>新規ユーザー</th><th>ページビュー数</th><th>ページ/セッション</th><th>平均セッション時間</th><th>CVR</th><th>CV</th>
                     </tr>
                    @foreach ($analytics as $value)
                    <table border="1">
                      <tr>
                        <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                      <tr>
                        <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                      <tr>
                       <td>{{ $value["ga:yearMonth"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                         <tr>
                       <td>{{ $value["201902"] }}</td><td>{{ $value["ga:sessions"] }}</td>
                      </tr>
                    　</table>
                    　@endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
