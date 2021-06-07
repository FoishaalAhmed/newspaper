<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    private $galleryObject;

    public function __construct()
    {
        $this->galleryObject = new Gallery();
    }

    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('backend.editor.gallery', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate(Gallery::$validateRule);
        $this->galleryObject->storeGallery($request);
        return back();
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $galleries = Gallery::latest()->get();
        return view('backend.editor.gallery', compact('galleries', 'gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(Gallery::$validateRule);
        $this->galleryObject->updateGallery($request, $id);
        return redirect()->route('editor.galleries.index');
    }

    public function destroy($id)
    {
        $this->galleryObject->destroyGallery($id);
        return back();
    }
}
