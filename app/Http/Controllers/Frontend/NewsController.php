<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news($slug)
    {
        $category = Category::where('slug', $slug)->select('id', 'name')->firstOrFail();
        $news = News::where('category_id', $category->id)->paginate(18);
        $latest = News::latest()->take(3)->get();
        $popular = News::orderBy('view', 'desc')->take(3)->get();
        return view('frontend.news', compact('news', 'category', 'latest', 'popular'));
    }

    public function detail($slug)
    {
        $newsObject = new News();
        News::where('slug', $slug)->increment('view', 1);
        $news = $newsObject->getNewsBySlug($slug);
        $relatedNews = news::where('category_id', $news->category_id)->where('id', '!=', $news->id)->take(3)->get();
        $latest = News::latest()->take(3)->get();
        $popular = News::orderBy('view', 'desc')->take(3)->get();
        return view('frontend.detail', compact('news', 'relatedNews', 'latest', 'popular'));
    }

    public function search(Request $request)
    {
        $newsObject = new News();
        $category = '';
        $search = $request->search;
        $news = $newsObject->getSearchedNews($search);
        $latest = News::latest()->take(3)->get();
        $popular = News::orderBy('view', 'desc')->take(3)->get();
        return view('frontend.news', compact('news', 'category', 'latest', 'popular'));
    }

    
}
