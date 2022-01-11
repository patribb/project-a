<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoStoreRequest;
use App\Http\Requests\PhotoUpdateRequest;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $photos = Photo::all();

        return view('photo.index', compact('photos'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('photo.create');
    }

    /**
     * @param \App\Http\Requests\PhotoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoStoreRequest $request)
    {
        $photo = Photo::create($request->validated());

        $request->session()->flash('photo.id', $photo->id);

        return redirect()->route('photo.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Photo $photo)
    {
        return view('photo.show', compact('photo'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Photo $photo)
    {
        return view('photo.edit', compact('photo'));
    }

    /**
     * @param \App\Http\Requests\PhotoUpdateRequest $request
     * @param \App\Models\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoUpdateRequest $request, Photo $photo)
    {
        $photo->update($request->validated());

        $request->session()->flash('photo.id', $photo->id);

        return redirect()->route('photo.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Photo $photo)
    {
        $photo->delete();

        return redirect()->route('photo.index');
    }
}
