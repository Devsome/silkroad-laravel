<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Model\SRO\Account\Notice;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Validator;

/**
 * Class SilkroadNoticeController
 * @package App\Http\Controllers\Backend
 */
class SilkroadNoticeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function noticeIndex()
    {
        return view('theme::backend.silkroad.notice.index', [
            'notices' => Notice::all()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function noticeCreate()
    {
        return view('theme::backend.silkroad.notice.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function noticeSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2|max:80',
            'body' => 'required|min:10|max:1024'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $notice = new Notice();
        $notice->Subject = $request->get('title');
        $notice->ContentID = config('siteSettings.sro_content_id', 22);
        $notice->Article = $request->get('body');
        $notice->EditDate = Carbon::now()->format('Y-m-d H:i:s');

        $notice->save();

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function noticeEdit($id)
    {
        return view('theme::backend.silkroad.notice.edit', [
           'notice' => Notice::findOrFail($id)
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function noticeEditPatch(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2|max:80',
            'body' => 'required|min:10|max:1024'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $notice = Notice::findOrFail($id);
        $notice->Subject = $request->get('title');
        $notice->Article = $request->get('body');
        $notice->save();

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function noticeDestroy($id)
    {
        Notice::findOrFail($id)->delete();
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }
}
