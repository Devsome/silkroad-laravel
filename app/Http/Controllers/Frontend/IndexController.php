<?php

namespace App\Http\Controllers\Frontend;

use App\Download;
use App\Http\Controllers\Controller;
use App\Http\Model\SRO\Log\OnlineOfflineLog;
use App\News;
use App\Pages;
use App\PagesContent;
use App\Rules;
use App\ServerInformation;
use App\SiteSettings;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Response;

class IndexController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $news = News::where('published_at', '<=', Carbon::Now())
            ->orderBy('published_at', 'DESC')->with('image')->take(4)->get();
        return view('theme::index', [
            'news' => $news
        ]);
    }

    /**
     * @return Factory|View
     */
    public function downloads()
    {
        $downloads = Download::orderBy('name', 'asc')->get();

        return view('theme::frontend.other.downloads', [
            'downloads' => $downloads
        ]);
    }

    /**
     * @return Factory|View
     */
    public function rules()
    {
        $rules = Rules::all()->first();
        return view('theme::frontend.other.rules', [
            'rules' => $rules
        ]);
    }

    /**
     * @return Factory|View
     */
    public function serverInformation()
    {
        return view('theme::frontend.other.serverinformation', [
            'information' => ServerInformation::orderBy('order', 'ASC')->get()
        ]);
    }

    /**
     * @param $slug
     * @return Factory|\Illuminate\Contracts\View\View
     */
    public function pagesContent($slug)
    {
        $page = Pages::where('slug', '=', $slug)
            ->where('state', '=', Pages::PAGE_ACTIVE)
            ->with('getContent')
            ->firstOrFail();

        return view('theme::frontend.other.pages', [
            'pageContent' => $page
        ]);
    }

    /**
     * @param null $ref
     * @return \Illuminate\Http\Response|null
     * @throws FileNotFoundException
     */
    public function signatureRef($ref = null): ?\Illuminate\Http\Response
    {
        $siteSettings = SiteSettings::first();

        if ($siteSettings && $siteSettings->settings['signature']) {
            $imageSignature = Storage::disk('images')->get(
                $siteSettings->settings['signature']
            );

            $mimeType = Storage::disk('images')->mimeType(
                $siteSettings->settings['signature']
            );

            $response = Response::make($imageSignature);
            $response->header('Content-Type', $mimeType);
            return $response;
        }

        return null;
    }

    /**
     * @return Factory|View
     */
    public function worldmapIndex()
    {
        $onlineCharacters = OnlineOfflineLog::where('status', OnlineOfflineLog::STATUS_LOGGED_IN);

        return view('theme::frontend.other.worldmap', [
            'count' => $onlineCharacters->count()
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function worldmapApi()
    {
        $onlineCharacters = OnlineOfflineLog::where('status', OnlineOfflineLog::STATUS_LOGGED_IN);
        $onlineCharactersNoJob = $onlineCharacters->with('getCharacter.getJobbingState')
            ->get()
            ->pluck('getCharacter');

        return response()->json(
            $onlineCharactersNoJob
        );
    }

    /**
     * @param $lang
     * @return RedirectResponse
     */
    public function lang($lang)
    {
        Session::put('locale', $lang);
        return back();
    }
}
