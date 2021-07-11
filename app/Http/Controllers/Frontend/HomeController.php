<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $newsObject;

    public function __construct()
    {
        $this->newsObject = new News();
    }

    public function index()
    {
        $leadNews        = $this->newsObject->getLeadNews();
        $latestNews      = $this->newsObject->getLatestNews();
        $bangladeshNews  = News::where('news.category_id', 2)->orderBy('news.created_at', 'desc')->take(6)->get();
        $sunamNews  = News::where('news.category_id', 3)->orderBy('news.created_at', 'desc')->take(2)->get();
        $randomEightNews = $this->newsObject->getRandomEightNews();
        $videos          = Gallery::where('type', 'Video')->latest()->take(4)->get();
        $trendingNews    = News::orderBy('view', 'desc')->latest()->take(10)->get()->toArray();
        $category        = Category::where('menu', 1)->select('id', 'name')->take(9)->get();

        foreach ($category as $key => $value) {

            $category[$key]->news = $this->newsObject->getTrendingNewsByCategory($value->id);
        }

        return view('frontend.index', compact('leadNews', 'latestNews', 'bangladeshNews', 'randomEightNews', 'category', 'trendingNews', 'videos', 'sunamNews'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $latest = News::latest()->take(3)->get();
        $popular = News::orderBy('view', 'desc')->take(3)->get();
        $sunamNews  = News::where('news.category_id', 3)->orderBy('news.created_at', 'desc')->take(6)->get()->toArray();
        return view('frontend.page', compact('page', 'latest', 'popular', 'sunamNews'));
    }
}
