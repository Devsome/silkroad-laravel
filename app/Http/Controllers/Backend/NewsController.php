<?php

namespace App\Http\Controllers\Backend;

use App\Image;
use App\News;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws \Exception
     */
    public function index()
    {
        $news = News::orderByDesc('id')->get();
        return view('theme::backend.news.index', [
            'news' => $news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $newsImages = Image::where('model', News::class)->orderByDesc('id')->get();
        return view('theme::backend.news.create', [
            'images' => $newsImages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2|max:100',
            'slug' => 'required|unique:news,slug|max:150',
            'body' => 'required|min:10',
            'image_id' => 'required',
            'published_at' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $news = new News();
        $news->title = $request->title;
        $news->slug = $request->slug;
        $news->body = $request->body;
        $news->image_id = $request->image_id === 'null' ? null : $request->image_id;
        $news->published_at = Carbon::create($request->published_at);

        $news->save();

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $newsImages = Image::where('model', News::class)->orderByDesc('id')->get();
        return view('theme::backend.news.edit', [
            'news' => $news,
            'images' => $newsImages
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => [
                'required',
                Rule::unique('news', 'slug')->ignore($id)
            ],
            'body' => 'required|min:10',
            'published_at' => 'nullable|date',
            'image_id' => 'required'
        ]);

        $news = News::findOrFail($id);

        $news->title = $request->title;
        $news->slug = $request->slug;
        $news->body = $request->body;
        $news->image_id = $request->image_id === 'null' ? null : $request->image_id;
        $news->published_at = Carbon::create($request->published_at);
        $news->save();

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }
}
