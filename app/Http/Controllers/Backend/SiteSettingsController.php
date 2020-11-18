<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\SiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;

class SiteSettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('theme::backend.settings.index', [
            'settings' => SiteSettings::first()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '_token' => 'required',
            'sro_silk_name' => 'required|min:1|max:16',
            'sro_silk_gift_name' => 'required|min:1|max:16',
            'facebook_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'contact_email' => 'nullable|email',
            'discord_id' => 'nullable|numeric',
            'sro_content_id' => 'required|numeric',
            'sro_max_server' => 'required|numeric',
            'sro_cap' => 'required|numeric',
            'sro_exp' => 'required|numeric',
            'sro_exp_gold' => 'required|numeric',
            'sro_exp_drop' => 'required|numeric',
            'sro_exp_job' => 'required|numeric',
            'sro_exp_party' => 'required|numeric',
            'sro_ip_limit' => 'required|numeric',
            'sro_hwid_limit' => 'required|numeric',
            'image_id' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:700',
            'hide_gamemaster_char' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator);
        }

        $this->jsonSiteSettingsUpdate($request);

        \Cache::forget('siegeFortress');

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @param Request $request
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function jsonSiteSettingsUpdate($request): bool
    {
        $filename = null;
        if ($request->file('image_id')) {
            $requestImage = $request->file('image_id');
            $filename = 'signature.' . $requestImage->getClientOriginalExtension();

            if (Storage::disk('images')->exists($filename)) {
                Storage::disk('images')->delete($filename);
            }

            Storage::disk('images')->put($filename, File::get($requestImage));
        }

        $data = [
            'sro_silk_name' => $request->get('sro_silk_name') ?? 'Silk',
            'sro_silk_gift_name' => $request->get('sro_silk_gift_name') ?? 'Silk Gift',
            'discord_id' => $request->get('discord_id') ?? '',
            'facebook_url' => $request->get('facebook_url') ?? '',
            'youtube_url' => $request->get('youtube_url') ?? '',
            'contact_email' => $request->get('contact_email') ?? '',
            'registration_close' => $request->get('registration_close') ? true : false,
            'jangan_fortress' => $request->get('jangan_fortress') ? true : false,
            'bandit_fortress' => $request->get('bandit_fortress') ? true : false,
            'hotan_fortress' => $request->get('hotan_fortress') ? true : false,
            'constantinople_fortress' => $request->get('constantinople_fortress') ? true : false,
            'char_ranking' => $request->get('char_ranking') ? true : false,
            'guild_ranking' => $request->get('guild_ranking') ? true : false,
            'job_ranking' => $request->get('job_ranking') ? true : false,
            'trader_ranking' => $request->get('trader_ranking') ? true : false,
            'hunter_ranking' => $request->get('hunter_ranking') ? true : false,
            'thief_ranking' => $request->get('thief_ranking') ? true : false,
            'unique_ranking' => $request->get('unique_ranking') ? true : false,
            'free_pvp_ranking' => $request->get('free_pvp_ranking') ? true : false,
            'job_pvp_ranking' => $request->get('job_pvp_ranking') ? true : false,
            'sro_content_id' => $request->get('sro_content_id') ?? '22',
            'sro_max_server' => $request->get('sro_max_server') ?? '1000',
            'sro_cap' => $request->get('sro_cap') ?? '110',
            'sro_exp' => $request->get('sro_exp') ?? '1',
            'sro_exp_gold' => $request->get('sro_exp_gold') ?? '1',
            'sro_exp_drop' => $request->get('sro_exp_drop') ?? '1',
            'sro_exp_job' => $request->get('sro_exp_job') ?? '1',
            'sro_exp_party' => $request->get('sro_exp_party') ?? '1',
            'sro_ip_limit' => $request->get('sro_ip_limit') ?? '1',
            'sro_hwid_limit' => $request->get('sro_hwid_limit') ?? '1',
            'signature' => $filename ?: '',
            'hide_gamemaster_char' => $request->get('hide_gamemaster_char') ? true : false,
        ];

        $siteSettings = SiteSettings::first();
        if (empty($siteSettings)) {
            SiteSettings::create([
                'settings' => $data
            ]);
        } else {
            $siteSettings->update([
                'settings' => $data
            ]);
        }

        return true;
    }
}
