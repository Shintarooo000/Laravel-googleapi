<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Analytics\AnalyticsClientFactory;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

class NewsController extends Controller
{
      public function add()
  {
      return view('admin.news.samary');
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
        // 期間中のユニークユーザー数とPV
        $gaData = $ga->fetchTotalVisitorsAndPageViews(Period::days(7));
        $analytics = $ga->performQuery (
        Period::years( 1),'ga:sessions', 'ga:yearMonth', ['metrics' => 'ga:sessions', 'dimensions' => 'ga:yearMonth']);
        return view('admin.news.samary')->with('analytics', $analytics);
    }
}