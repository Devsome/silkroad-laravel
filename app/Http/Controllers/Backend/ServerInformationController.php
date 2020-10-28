<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\ServerInformation;
use Grpc\Server;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Validator;

class ServerInformationController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('theme::backend.serverinformation.index', [
            'information' => ServerInformation::orderBy('order', 'ASC')->get()
        ]);
    }

    /**
     * @return Factory|View
     */
    public function showAdd()
    {
        return view('theme::backend.serverinformation.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '_token' => 'required',
            'title' => 'required|min:2|max:100',
            'order' => 'nullable|numeric',
            'body' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        ServerInformation::create([
            'title' => $request->get('title'),
            'order' => (int)$request->get('order'),
            'body' => $request->get('body')
        ]);

        return back()->with('success', trans('backend/notification.form-submit.server-information-success'));
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function showEdit($id)
    {
        return view('theme::backend.serverinformation.edit', [
            'information' => ServerInformation::findOrFail($id)
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            '_token' => 'required',
            'title' => 'required|min:2|max:100',
            'order' => 'nullable|numeric',
            'body' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        ServerInformation::where('id', $id)
            ->update([
                'title' => $request->get('title'),
                'order' => $request->get('order'),
                'body' => $request->get('body'),
            ]);

        return back()->with('success', trans('backend/notification.form-submit.server-information-success'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $news = ServerInformation::findOrFail($id);
        $news->delete();
        return back()->with('success', trans('backend/notification.form-submit.server-information-delete'));
    }
}
