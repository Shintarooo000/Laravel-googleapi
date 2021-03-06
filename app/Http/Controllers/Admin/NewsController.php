<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Analytics\AnalyticsClientFactory;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;
use App\News;

class NewsController extends Controller
{
      public function add()
  {
      return view('admin.news.create');
  }
  public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = AnalyticsClientFactory::createForConfig(config('analytics'));
        $ga     = new Analytics($client, config('analytics.view_id'));
        $periodYear = Period::years(1);
        //開始と終了の日付をカスタマイズ
        $periodYear->startDate->modify("first day of -1 months");
        $periodYear->endDate->modify("last day of -1 months");
        
        $analytics = $ga->performQuery (
            $periodYear,
            'ga:sessions, ga:users, ga:newUsers, ga:pageviews, ga:pageviewsPerSession, ga:avgSessionDuration, ga:goalConversionRateAll, ga:goalCompletionsAll ga:yearMonth,', 
            [
                'metrics' => 'ga:sessions, ga:users, ga:newUsers, ga:pageviews, ga:pageviewsPerSession, ga:avgSessionDuration, ga:goalConversionRateAll, ga:goalCompletionsAll',
                'dimensions' => 'ga:yearMonth'
            ]
        );
        //前月比較、前年比較する際に要素数を用いています。
        //データが存在しないときのエラー処理も必要
        $rows = $analytics->rows;
        $rowCount = count($rows);
        $thisMonth = $rows[$rowCount - 1];
        $lastMonth = $rows[$rowCount - 2];
        $lastYear = $rows[$rowCount - 12];
        //compact()で   bladeファイルに変数を渡せる
        return view('admin.news.samary', compact('rows', 'thisMonth', 'lastMonth', 'lastYear'));
    }
    public function create(Request $request){
         $this->validate($request, News::$rules);
          $news = new News;
          $form = $request->all();
          unset($form['_token']);
          $news->fill($form);
          $news->save();
          return redirect('admin/news/create');
    }
    public function impression(Request $request)
  {
      $cond_name = $request->cond_name;
      if ($cond_name != '') {
          // 検索されたら検索結果を取得する
          $posts = News::where('name', $cond_name)->get();
      } else {
          $posts = News::all();
      }
      return view('admin.news.impression', ['posts' => $posts, 'cond_name' => $cond_name]);
  }
  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $news = News::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
      return view('admin.news.edit', ['news_form' => $news]);
  }


  public function update(Request $request)
  {
 // Validationをかける
      $this->validate($request, News::$rules);
      // News Modelからデータを取得する
      $news = News::find($request->id);
      // 送信されてきたフォームデータを格納する
      $news_form = $request->all();
      unset($news_form['_token']);
      // 該当するデータを上書きして保存する
      $news->fill($news_form)->save();

      return redirect('admin/news/impression');
  }
    public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $news = News::find($request->id);
      // 削除する
      $news->delete();
      return redirect('admin/news/impression');
  }  
}
