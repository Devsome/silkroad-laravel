<?php

namespace App\Http\Controllers\Frontend;

use App\Download;
use App\Http\Controllers\Controller;
use App\News;
use App\ServerInformation;
use Carbon\Carbon;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $news = News::where('published_at', '<=', Carbon::Now())
            ->orderBy('published_at', 'DESC')->with('image')->take(4)->get();
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function serverInformation()
    {
        return view('frontend.other.serverinformation', [
            'information' => ServerInformation::orderBy('order', 'ASC')->get()
        ]);
    }
}
