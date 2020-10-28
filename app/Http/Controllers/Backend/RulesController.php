<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Rules;
use Illuminate\View\View;

class RulesController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('theme::backend.rules.index', [
            'rules' => Rules::all()
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|\Illuminate\Contracts\View\View
     */
    public function add(Request $request)
    {
        $data = $request->validate([
            'body' => 'required|min:10',
        ]);

        Rules::create($data);

        return view('theme::backend.rules.index', [
            'rules' => Rules::all()
        ])->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @return Factory|View
     */
    public function showAdd()
    {
        return view('theme::backend.rules.create');
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function showEdit($id)
    {
        return view('theme::backend.rules.edit', [
            'rules' => Rules::findOrFail($id)
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'body' => 'required|min:10',
        ]);

        $rules = Rules::findOrFail($id);
        $rules->update($data);

        return view('theme::backend.rules.index', [
            'rules' => Rules::all()
        ])->with('success', __('backend/notification.form-submit.success'));
    }
}
