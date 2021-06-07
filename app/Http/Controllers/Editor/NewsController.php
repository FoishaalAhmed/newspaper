<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\News;

class NewsController extends Controller
{
    private $newsObject;

    public function __construct()
    {
        $this->newsObject = new News();
    }

    public function index()
    {
        $news = $this->newsObject->GetNewsWithCategory();
        return view('backend.editor.news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('backend.editor.news.create', compact('categories'));
    }

    public function store(NewsRequest $request)
    {
        $this->newsObject->storeNews($request);
        return back();
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::orderBy('name', 'asc')->get();
        return view('backend.editor.news.edit', compact('categories', 'news'));
    }

    public function update(NewsRequest $request, $id)
    {
        $this->newsObject->updateNews($request, $id);
        return redirect()->route('editor.news.index');
    }

    public function destroy($id)
    {
        $this->newsObject->destroyNews($id);
        return back();
    }
}
