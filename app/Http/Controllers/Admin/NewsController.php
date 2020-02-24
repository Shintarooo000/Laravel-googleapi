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
        $analytics = $ga->performQuery (
            Period::years(1),
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
}