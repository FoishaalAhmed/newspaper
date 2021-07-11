<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Team;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news($slug, $category_id)
    {
        $category = Category::where('id', $category_id)->select('id', 'name')->firstOrFail();
        $news = News::where('category_id', $category->id)->paginate(18);
        $latest = News::latest()->take(3)->get();
        $popular = News::orderBy('view', 'desc')->take(3)->get();
        $sunamNews  = News::where('news.category_id', 3)->orderBy('news.created_at', 'desc')->take(6)->get()->toArray();
        return view('frontend.news', compact('news', 'category', 'latest', 'popular', 'sunamNews'));
    }

    public function detail($id, $slug)
    {
        $newsObject = new News();
        News::where('id', $id)->increment('view', 1);
        $news = $newsObject->getNewsBySlug($id);
        $relatedNews = news::where('category_id', $news->category_id)->where('id', '!=', $id)->take(3)->get();
        $latest = News::latest()->take(3)->get();
        $popular = News::orderBy('view', 'desc')->take(3)->get();
        $sunamNews  = News::where('news.category_id', 3)->orderBy('news.created_at', 'desc')->take(6)->get()->toArray();
        return view('frontend.detail', compact('news', 'relatedNews', 'latest', 'popular', 'sunamNews'));
    }

    public function search(Request $request)
    {
        $newsObject = new News();
        $category = '';
        $search = $request->search;
        $news = $newsObject->getSearchedNews($search);
        $latest = News::latest()->take(3)->get();
        $popular = News::orderBy('view', 'desc')->take(3)->get();
        $sunamNews  = News::where('news.category_id', 3)->orderBy('news.created_at', 'desc')->take(6)->get()->toArray();
        return view('frontend.news', compact('news', 'category', 'latest', 'popular', 'sunamNews'));
    }

    public function teams()
    {
        $teams = Team::orderBy('priority', 'desc')->paginate(20);
        return view('frontend.team', compact('teams'));
    }
}
