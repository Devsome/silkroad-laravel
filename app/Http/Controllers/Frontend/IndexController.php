<?php

namespace App\Http\Controllers\Frontend;

use App\Download;
use App\Http\Controllers\Controller;
use App\Http\Model\SRO\Log\OnlineOfflineLog;
use App\News;
use App\Rules;
use App\ServerInformation;
use App\SiteSettings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Response;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function downloads()
    {
        $downloads = Download::orderBy('name', 'asc')->get();

        return view('theme::frontend.other.downloads', [
            'downloads' => $downloads
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rules()
    {
        $rules = Rules::all()->first();
        return view('theme::frontend.other.rules', [
            'rules' => $rules
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function serverInformation()
    {
        return view('theme::frontend.other.serverinformation', [
            'information' => ServerInformation::orderBy('order', 'ASC')->get()
        ]);
    }

    /**
     * @param null $ref
     * @return \Illuminate\Http\Response|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function worldmapIndex()
    {
        $onlineCharacters = OnlineOfflineLog::where('status', OnlineOfflineLog::STATUS_LOGGED_IN);

        return view('theme::frontend.other.worldmap', [
            'count' => $onlineCharacters->count()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lang($lang)
    {
        Session::put('locale', $lang);
        return back();
    }
}
