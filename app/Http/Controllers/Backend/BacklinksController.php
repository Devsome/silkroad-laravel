<?php

namespace App\Http\Controllers\Backend;

use App\Backlinks;
use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BacklinksController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.backlinks.index', [
            'backlinks' => Backlinks::paginate(15)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:150|min:2',
            'url' => 'required|url|max:250|min:10',
            'image_id' => 'nullable',
        ]);

        Backlinks::create($data);

        return redirect()->back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('backend.backlinks.create', [
            'images' => Image::where('model', Backlinks::class)->orderByDesc('id')->get(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('backend.backlinks.edit', [
            'backlink' => Backlinks::findOrFail($id),
            'images' => Image::where('model', Backlinks::class)->get(),
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
            'name' => 'required|max:150|min:2',
            'url' => 'required|url|max:250|min:10',
            'image_id' => 'nullable',
        ]);

        $backlink = Backlinks::findOrFail($id);
        $backlink->update($data);

        return redirect()->back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $backlink = Backlinks::findOrFail($id);
        $backlink->delete();
        return back()->with('success', __('backend/notification.form-submit.success'));
    }
}
