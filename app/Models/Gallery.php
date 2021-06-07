<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'photo', 'video',
    ];

    public static $validateRule = [
        'type' => ['required', 'string', 'max:5'],
        'photo' => ['required_if:type,Photo', 'mimes:jpeg,jpg,png,gif,webp', 'max:10000'],
        'video' => ['required_if:type,Video', 'nullable', 'max:255'],
    ];

    public function storeGallery(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/galleries/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->type  = $request->type;
        $this->video = $request->video;
        $storeGallery = $this->save();

        $storeGallery
            ? session()->flash('message', 'New Gallery Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateGallery(Object $request, Int $id)
    {
        $gallery = $this::findOrFail($id);

        $image = $request->file('photo');

        if ($image) {

            if (file_exists($gallery->photo)) unlink($gallery->photo);

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/galleries/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $gallery->photo  = $image_url;
        }

        $gallery->type  = $request->type;

        if ($request->type == 'Photo') {

            $gallery->video  = NULL;
        } else {

            if (file_exists($gallery->photo)) unlink($gallery->photo);
            $gallery->video  = $request->video;
            $gallery->photo  = NULL;
        }


        $storeGallery = $gallery->save();

        $storeGallery
            ? session()->flash('message', 'Gallery Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyGallery(Int $id)
    {
        $gallery = $this::findOrFail($id);
        if (file_exists($gallery->photo)) unlink($gallery->photo);
        $destroyGallery = $gallery->delete();

        $destroyGallery
            ? session()->flash('message', 'Gallery Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
