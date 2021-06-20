<?php

namespace App\Http\Controllers\Admin;

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
        return view('backend.admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::orderBy('position', 'asc')->get();
        return view('backend.admin.news.create', compact('categories'));
    }

    public function store(NewsRequest $request)
    {
        $this->newsObject->storeNews($request);
        return back();
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::orderBy('position', 'asc')->get();
        return view('backend.admin.news.edit', compact('categories', 'news'));
    }

    public function update(NewsRequest $request, $id)
    {
        $this->newsObject->updateNews($request, $id);
        return redirect()->route('admin.news.index');
    }

    public function destroy($id)
    {
        $this->newsObject->destroyNews($id);
        return back();
    }
}
