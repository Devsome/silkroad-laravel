<?php

namespace App\Http\Controllers;

use App\Download;
use App\News;

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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function downloads()
    {
        $downloads = Download::orderBy('name', 'asc')->get();

        return view('frontend.other.downloads', [
            'downloads' => $downloads
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rules()
    {
        return view('frontend.other.rules');
    }
}
