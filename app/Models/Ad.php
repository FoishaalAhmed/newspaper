<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'position', 'link', 'photo',
    ];

    public function storeAd(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/ads/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $this->photo     = $image_url;
        }

        $this->position = $request->position;
        $this->link     = $request->link;
        $storeAd        = $this->save();

        $storeAd
            ? session()->flash('message', 'Ad Published Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateAd(Object $request, Int $id)
    {
        $ad = $this::findOrFail($id);
        $image = $request->file('photo');

        if ($image) {
            if (file_exists($ad->photo)) unlink($ad->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/ads/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $ad->photo      = $image_url;
        }

        $ad->position = $request->position;
        $ad->link     = $request->link;
        $updateAd     = $ad->save();

        $updateAd
            ? session()->flash('message', 'Ad Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyAd(Int $id)
    {
        $ad = $this::findOrFail($id);
        if (file_exists($ad->photo)) unlink($ad->photo);
        $destroyAd = $ad->delete();

        $destroyAd
            ? session()->flash('message', 'Ad Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
