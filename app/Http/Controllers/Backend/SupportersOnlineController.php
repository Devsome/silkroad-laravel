<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\SRO\Shard\Char;
use App\SupportersOnline;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Validator;

class SupportersOnlineController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $supporterPlayers = SupportersOnline::all();
        return view('theme::backend.supportersonline.index', [
            'chars' => $supporterPlayers
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'charname' => 'required|max:100',
        ]);

        $getCharId = Char::where('CharName16', '=', $request->get('charname'))->first();

        if (!$getCharId) {
            return back()->with('error', trans('backend/notification.form-submit.supporter-exist'));
        }

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        SupportersOnline::create([
            'charname' => $request->get('charname'),
            'CharID' => $getCharId->CharID
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
        SupportersOnline::findOrFail($id)->delete();

        return back()->with('success', __('backend/notification.form-submit.success'));
    }
}
