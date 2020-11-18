<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Pages;
use App\PagesContent;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        $pages = PagesContent::with('getPages')
            ->paginate(10);

        $types = Pages::all();

        return view('theme::backend.pages.index', [
            'pages' => $pages,
            'types' => $types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $pages = Pages::all();

        return view('theme::backend.pages.create', [
            'pages' => $pages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'pages_id' => ['required', 'integer', 'exists:pages,id'],
            'title' => 'required|max:24',
            'body' => 'required|min:5'
        ]);

        PagesContent::create($data);

        \Cache::forget('pagesCache');

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
     * @param Request $request
     * @return RedirectResponse
     */
    public function createType(Request $request): RedirectResponse
    {
        $request->validate([
            'new_type' => 'required|max:24',
            'slug' => 'required|max:24'
        ]);

        Pages::create([
            'title' => $request->get('new_type'),
            'slug' => $request->get('slug'),
            'state' => Pages::PAGE_DISABLED
        ]);

        \Cache::forget('pagesCache');

        return redirect()->back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function toggleType(Request $request): JsonResponse
    {
        $page = Pages::where('id', '=', $request->get('type_id'))
            ->firstOrFail();

        if ($request->get('status') === '1') {
            $state = Pages::PAGE_ACTIVE;
        } else {
            $state = Pages::PAGE_DISABLED;
        }

        $page->state = $state;
        $page->save();

        \Cache::forget('pagesCache');

        return response()->json([
            'message' => __('backend/notification.form-submit.success'),
            'state' => ucfirst($state)
        ]);
    }

    public function deleteType()
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
        $pages = Pages::all();
        $pagesContent = PagesContent::findOrFail($id);

        return view('theme::backend.pages.edit', [
            'pages' => $pages,
            'pagesContent' => $pagesContent
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
        $page = PagesContent::findOrFail($id);

        $request->validate([
            'type' => ['required', 'integer', 'exists:pages,id'],
            'title' => 'required|max:24',
            'body' => 'required|min:5'
        ]);

        \Cache::forget('pagesCache');

        $page->pages_id = $request->get('type');
        $page->title = $request->get('title');
        $page->body = $request->get('body');
        $page->save();

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
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
            return response()->json(['error' => trans('backend/notification.form-submit.error')]);
        }
        DB::commit();
        return response()->json(['success' => trans('backend/notification.form-submit.success')]);
    }
}
