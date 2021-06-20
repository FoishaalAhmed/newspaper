<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    private $adObject;

    public function __construct()
    {
        $this->adObject = new Ad();
    }

    public function index()
    {
        $ads = Ad::all();
        return view('backend.admin.ad', compact('ads'));
    }

    public function store(AdRequest $request)
    {
        $this->adObject->storeAd($request);
        return back();
    }

    public function edit($id)
    {
        $ad = Ad::findOrFail($id);
        $ads = Ad::all();
        return view('backend.admin.ad', compact('ads', 'ad'));
    }

    public function update(Request $request, $id)
    {
        $this->adObject->updateAd($request, $id);
        return redirect()->route('admin.ads.index');
    }

    public function destroy($id)
    {
        $this->adObject->destroyAd($id);
        return back();
    }
}
