<?php

namespace App\Providers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Contact;
use App\Models\News;
use App\Models\Page;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $categories = Category::orderBy('position', 'asc')->where('menu', 1)->select('name', 'slug')->get();
        $contact    = Contact ::first();
        $about      = Page::where('slug', 'about')->first();
        $latest     = News::latest()->take(2)->get();
        $headerAd   = Ad::where('position', 'Header')->first();
        $sidebarAd  = Ad::where('position', 'Sidebar')->first();
        $middleAd   = Ad::where('position', 'Middle Of News')->first();

        view()->share(['categories' => $categories, 'contact' => $contact, 'about' => $about, 'latest' => $latest,'headerAd' => $headerAd, 'sidebarAd' => $sidebarAd, 'middleAd' => $middleAd]);
    }
}
