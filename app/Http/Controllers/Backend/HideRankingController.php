<?php

namespace App\Http\Controllers\Backend;

use App\HideRanking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class HideRankingController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $hidePlayers = HideRanking::all();
        return view('backend.hideranking.index', [
            'hidden' => $hidePlayers
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'charname' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        HideRanking::create($request->all());

        return back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        HideRanking::findOrFail($id)->delete();

        return back()->with('success', __('backend/notification.form-submit.success'));
    }
}
