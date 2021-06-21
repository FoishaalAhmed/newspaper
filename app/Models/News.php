<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'date', 'title', 'slug', 'reporter', 'content', 'photo', 'tags', 'short_content', 'view', 'post_by', 'position', 'video',
    ];

    public function GetNewsWithCategory()
    {
        $news = $this->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.name as category')
            ->orderBy('news.created_at', 'desc')
            ->get();
        return $news;
    }

    public function getLeadNews()
    {
        $leadNews = $this->join('categories', 'news.category_id', '=', 'categories.id')
            ->where('news.position', '!=', NULL)
            ->select('news.*', 'categories.name as category', 'categories.slug as category_slug')
            ->orderBy('news.position', 'asc')
            ->orderBy('news.created_at', 'desc')
            ->take(5)
            ->get()
            ->toArray();
        return $leadNews;
    }

    public function getLatestNews()
    {
        $latestNews = $this->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.name as category', 'categories.slug as category_slug')
            ->orderBy('news.created_at', 'desc')
            ->take(10)
            ->get()
            ->toArray();
        return $latestNews;
    }

    public function getRandomEightNews()
    {
        $randomEightNews = $this->join('categories', 'news.category_id', '=', 'categories.id')
            ->inRandomOrder()
            ->orderBy('news.created_at', 'desc')
            ->select('news.*', 'categories.name as category', 'categories.slug as category_slug')
            ->take(8)
            ->get();
        return $randomEightNews;
    }

    public function getSearchedNews($search)
    {
        $searchedNews = $this->join('categories', 'news.category_id', '=', 'categories.id')
            ->where('news.title', 'like', '%' . $search . '%')
            ->orWhere('categories.name', 'like', '%' . $search . '%')
            ->orWhere('news.content', 'like', '%' . $search . '%')
            ->orderBy('news.created_at', 'desc')
            ->select('news.*', 'categories.name as category', 'categories.slug as category_slug')
            ->paginate(18);
        $searchedNews->appends(['search' => $search]);
        return $searchedNews;
    }

    public function getTrendingNewsByCategory(Int $category_id)
    {
        $trendingNews = $this->join('categories', 'news.category_id', '=', 'categories.id')
            ->where('news.category_id', $category_id)
            ->select('news.*', 'categories.name as category', 'categories.slug as category_slug')
            ->orderBy('news.view', 'desc')
            ->orderBy('news.created_at', 'desc')
            ->take(4)
            ->get();
        return $trendingNews;
    }

    public function getNewsBySlug($slug)
    {
        $news = $this->join('categories', 'news.category_id', '=', 'categories.id')
            ->where('news.slug', $slug)
            ->select('news.*', 'categories.name as category', 'categories.slug as category_slug')
            ->firstOrFail();
        return $news;
    }

    public function storeNews(Object $request)
    {
        $check_position = $this->where('position', $request->position)->count();

        if ($check_position > 0) {

            $news = $this->where('position', $request->position)->first();
            $news->position = NULL;
            $news->save();
        }

        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/news/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->position      = $request->position == 0 ? NULL : $request->position;
        $this->video         = $request->video;
        $this->category_id   = $request->category_id;
        $this->date          = date('Y-m-d', strtotime($request->date));
        $this->title         = $request->title;
        $this->slug          = $request->slug;
        $this->reporter      = $request->reporter;
        $this->content       = $request->content;
        $this->tags          = $request->tags;
        $this->short_content = $request->short_content;
        $this->post_by       = auth()->id();
        $storeNews           = $this->save();

        $storeNews
            ? session()->flash('message', 'News Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateNews(Object $request, Int $id)
    {
        $news = $this::findOrFail($id);

        $check_position = $this->where('position', $request->position)->count();

        if ($check_position > 0) {

            $news = $this->where('position', $request->position)->first();
            $news->position = NULL;
            $news->save();
        }

        $image = $request->file('photo');

        if ($image) {

            if (file_exists($news->photo)) unlink($news->photo);

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/news/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $news->photo     = $image_url;
        }

        $news->position      = $request->position == 0 ? NULL : $request->position;
        $news->video         = $request->video;
        $news->category_id   = $request->category_id;
        $news->date          = date('Y-m-d', strtotime($request->date));
        $news->title         = $request->title;
        $news->slug          = $request->slug;
        $news->reporter      = $request->reporter;
        $news->content       = $request->content;
        $news->tags          = $request->tags;
        $news->short_content = $request->short_content;
        $updateNews          = $news->save();

        $updateNews
            ? session()->flash('message', 'News Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyNews(Int $id)
    {
        $news  = $this::findOrFail($id);
        if (file_exists($news->photo)) unlink($news->photo);
        $destroyNews = $news->save();

        $destroyNews
            ? session()->flash('message', 'News Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
