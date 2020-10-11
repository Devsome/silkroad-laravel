<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules;

class RulesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.rules.index', [
            'rules' => Rules::all()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function add(Request $request)
    {
        $data = $request->validate([
            'body' => 'required|min:10',
        ]);

        Rules::create($data);

        return view('backend.rules.index', [
            'rules' => Rules::all()
        ])->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdd()
    {
        return view('backend.rules.create');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEdit($id)
    {
        return view('backend.rules.edit', [
            'rules' => Rules::findOrFail($id)
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'body' => 'required|min:10',
        ]);

        $rules = Rules::findOrFail($id);
        $rules->update($data);

        return view('backend.rules.index', [
            'rules' => Rules::all()
        ])->with('success', __('backend/notification.form-submit.success'));
    }
}
