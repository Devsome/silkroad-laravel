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
}
