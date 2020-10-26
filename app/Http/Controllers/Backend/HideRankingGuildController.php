<?php

namespace App\Http\Controllers\Backend;

use App\HideRankingGuild;
use App\Http\Controllers\Controller;
use App\Model\SRO\Shard\Guild;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Validator;

class HideRankingGuildController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $hidePlayers = HideRankingGuild::all();
        return view('theme::backend.hideranking.guild', [
            'hidden' => $hidePlayers
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guild' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $guildId = Guild::select('ID')
            ->whereRaw('LOWER(Name) = ?', strtolower($request->get('guild')))
            ->firstOrFail();

        HideRankingGuild::create([
            'guild' => $request->get('guild'),
            'guild_id' => $guildId->ID
        ]);

        return back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        HideRankingGuild::findOrFail($id)->delete();

        return back()->with('success', __('backend/notification.form-submit.success'));
    }
}
