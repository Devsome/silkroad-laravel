<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Voteforsilk;
use Illuminate\Http\Request;

class VoteforsilkController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = Voteforsilk::all();

        return view('backend.voteforsilk.index', [
            'data' => $data,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleVote($id): \Illuminate\Http\RedirectResponse
    {
        $vote = Voteforsilk::findOrFail($id);
        $vote->active = $vote->active === 1 ? 0 : 1;
        $vote->save();

        return back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editVote($id)
    {
        $data = Voteforsilk::with('getVoted')
            ->where('id', $id)
            ->firstOrFail();

        return view('backend.voteforsilk.edit', [
            'data' => $data
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editVoteSubmit(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:1|max:64',
            'reward' => 'required|integer',
            'waiting_hours' => 'required|integer',
            'pingback' => ['required', 'regex:/{JID}/']
        ]);

        Voteforsilk::where('id', '=', $id)
            ->update([
                'name' => $request->get('name'),
                'reward' => $request->get('reward'),
                'waiting_hours' => $request->get('waiting_hours'),
                'pingback' => $request->get('pingback')
            ]);

        return back()->with('success', __('backend/notification.form-submit.success'));
    }
}
