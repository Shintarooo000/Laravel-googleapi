@extends('layouts.admin')

@section('title', '月間サマリーレポート')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto boxleft">
                <h2>月間サマリーレポート</h2>
             <div class="col-md-6 boxleft">
               <a href="{{ action('Admin\NewsController@impression') }}" role="button" class="btn btn-primary">所感一覧へ</a>
               <a href="{{ action('Admin\NewsController@add') }}" role="button" class="btn btn-primary">所感作成</a>
             </div>
            </div>
        </div>
         <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="month-table">
                  <table class="table table-hover table-bordered">
                     <tr class="table-primary">
                        <th class="table-primary">月間</th>
                        <th class="table-primary">セッション</th>
                        <th class="table-primary">ユーザー</th>
                        <th class="table-primary">新規ユーザー</th>
                        <th class="table-primary">ページビュー数</th>
                        <th class="table-primary">ページ/セッション</th>
                        <th class="table-primary">平均セッション時間(秒)</th>
                        <th class="table-primary">CVR</th>
                        <th >CV</th>
                     </tr>
                    @foreach ($rows as $value)
                      <tr>
                        <td>{{ $value[0] }}</td>
                        <td>{{ $value[1] }}</td>
                        <td>{{ $value[2] }}</td>
                        <td>{{ $value[3] }}</td>
                        <td>{{ $value[4] }}</td>
                        <td>{{ round($value[5], 1) }}</td>
                        <td>{{ round($value[6], 1) }}</td>
                        <td>{{ round($value[7], 2) }}%</td>
                        <td>{{ $value[8] }}</td>
                      </tr>
                    @endforeach
                  </table>
                    <h3>前月比較</h3>
                    <table class="table table-bordered" >
                     <tr>
                        <th class="table-primary">セッション</th>
                        <th class="table-primary">ユーザー</th>
                        <th class="table-primary">新規ユーザー</th>
                        <th class="table-primary">ページビュー数</th>
                        <th class="table-primary">ページ/セッション</th>
                        <th class="table-primary">平均セッション時間(秒)</th>
                        <th class="table-primary">CVR</th>
                        <th class="table-primary">CV</th>
                     </tr>
                     <tr>
                     @for ($i = 1; $i < count($lastMonth); $i++)
                         @if ($lastMonth[$i] == 0)
                         <td>データ無し</td>
                         @else 
                         <td>{{ round($thisMonth[$i] / $lastMonth[$i], 2) }}%</td>
                         @endif
                     @endfor
                     </tr>
                     </table>
                    <h3>前年比較</h3>
                    <table class="table table-bordered" >
                     <tr>
                        <th class="table-primary">セッション</th>
                        <th class="table-primary">ユーザー</th>
                        <th class="table-primary">新規ユーザー</th>
                        <th class="table-primary">ページビュー数</th>
                        <th class="table-primary">ページ/セッション</th>
                        <th class="table-primary">平均セッション時間(秒)</th>
                        <th class="table-primary">CVR</th>
                        <th class="table-primary">CV</th>
                     </tr>
                    <tr>
                     @for ($i = 1; $i < count($lastYear); $i++)
                         @if ($lastYear[$i] == 0)
                         <td>データ無し</td>
                         @else 
                         <td>{{ round($thisMonth[$i] / $lastYear[$i], 2) }}%</td>
                         @endif
                     @endfor
                     </tr>
                     </table>
                </div>
            </div>
        </div>
    </div>
@endsection