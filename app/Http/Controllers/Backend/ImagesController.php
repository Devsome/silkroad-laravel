<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme::backend.image.index', [
            'images' => Image::paginate(25)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function create(Request $request)
    {
        $request->validate([
            'model' => 'required',
            'image_id' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $requestImage = $request->file('image_id');
        $filename = time() . '.' . $requestImage->getClientOriginalExtension();
        Storage::disk('images')->put($filename, File::get($requestImage));

        $image = new Image();
        $image->filename = $filename;
        $image->mime = $requestImage->getClientOriginalExtension();
        $image->model = $request->get('model');
        $image->original_filename = $requestImage->getClientOriginalName();
        $image->save();

        return redirect()->back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('theme::backend.image.create', [
            'models' => Image::$models
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $image = Image::findOrFail($id);
        $model = new $image->model;
        $existImage = $model->where('image_id', $image->id)->get();

        if ($existImage->count() === 0) {
            $image->delete();
            return back()->with('success', __('backend/notification.form-submit.success'));
        }
        return back()->with(
            'error',
            __('backend/notification.form-submit.error-image-references', ['model' => $image->model])
        );
    }
}
