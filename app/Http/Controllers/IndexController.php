<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $news = News::orderBy('published_at', 'DESC')->with('image')->take(4)->get();
        return view('index', [
            'news' => $news
        ]);
    }
}
