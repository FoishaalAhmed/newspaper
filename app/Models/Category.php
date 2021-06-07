<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'position', 'menu',
    ];

    public static $validateRule = [

        'name'     => 'required|string|max : 255',
        'slug'     => 'required|string|max : 355',
        'position' => 'required|numeric',
        'menu'     => 'required|numeric|max: 1',
    ];

    public function storeCategory(Object $request)
    {
        $this->name      = $request->name;
        $this->slug      = $request->slug;
        $this->position  = $request->position;
        $this->menu      = $request->menu;
        $storeCategory   = $this->save();

        $storeCategory ?
            session()->flash('message', 'Category Created Successfully!') :
            session()->flash('message', 'Something Went Wrong!');
    }

    public function updateCategory(Object $request, Int $id)
    {
        $category = $this::findOrFail($id);
        $category->name      = $request->name;
        $category->slug      = $request->slug;
        $category->position  = $request->position;
        $category->menu      = $request->menu;
        $updateCategory      = $category->save();

        $updateCategory ?
            session()->flash('message', 'Category Updated Successfully!') :
            session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyCategory(Int $id)
    {
        $category = $this::findOrFail($id);
        $deleteCategory = $category->delete();

        $deleteCategory ?
            session()->flash('message', 'Category Deleted Successfully!') :
            session()->flash('message', 'Something Went Wrong!');
    }
}
