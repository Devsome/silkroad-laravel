<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\ServerInformation;
use Grpc\Server;
use Illuminate\Http\Request;
use Validator;

class ServerInformationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.serverinformation.index', [
            'information' => ServerInformation::orderBy('order', 'ASC')->get()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdd()
    {
        return view('backend.serverinformation.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEdit($id)
    {
        return view('backend.serverinformation.edit', [
            'information' => ServerInformation::findOrFail($id)->first()
        ]);
    }

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $news = ServerInformation::findOrFail($id);
        $news->delete();
        return back()->with('success', trans('backend/notification.form-submit.server-information-delete'));
    }
}
