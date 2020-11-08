<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Pages;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        $pages = Pages::whereDeletedAt(null)
            ->orderBy('created_at', 'ASC')
            ->paginate(10);
        return view('theme::backend.pages.index', [
            'pages' => $pages
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('theme::backend.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => ['required', 'IN:styles,faq,event'],
            'body' => 'required'
        ]);
        $data = $request->only([
            'title',
            'type',
            'body',
        ]);
        DB::beginTransaction();
        try {
            Pages::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', trans('backend/notification.form-submit.error'));
        }
        DB::commit();
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        return view('theme::backend.pages.edit', [
            'page' => Pages::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request, $id)
    {
        $page = Pages::findOrFail($id);

        $this->validate($request, [
            'title' => 'required',
            'type' => ['required', 'IN:styles,faq,event'],
            'body' => 'required'
        ]);
        $data = $request->only([
            'title',
            'type',
            'body',
        ]);

        DB::beginTransaction();
        try {
            $page->update($data);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', trans('backend/notification.form-submit.error'));
        }
        DB::commit();
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $page = Pages::findOrFail($id);
        DB::beginTransaction();
        try {
            $page->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', trans('backend/notification.form-submit.error'));
        }
        DB::commit();
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }
}
