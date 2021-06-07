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

    public function storeNews(Object $request)
    {
        $check_position = $this->where('position', $request->position)->count();

        if ($check_position > 0) {
            $this->where('position', $request->position)->count()->update('news', array('position' => NULL));
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
            $this->where('position', $request->position)->count()->update('news', array('position' => NULL));
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
