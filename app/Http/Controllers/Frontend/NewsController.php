<?php

namespace App\Http\Controllers\Frontend;

use App\News;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('frontend.news.index', [
            'news' => $news,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function archive()
    {
        $newsArchive = News::get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->published_at)->format('m');
            });
        $newsArchive = $newsArchive->reverse();
        return view('frontend.news.archive', [
            'archive' => $newsArchive
        ]);
    }
}
