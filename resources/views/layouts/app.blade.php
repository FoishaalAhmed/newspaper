<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    @section('header')
    @show
    
    <title>@yield('title')</title>

    <link rel=icon href="{{ asset('public/frontend/img/favicon.png') }}') }}" sizes="20x20" type="image/png">

    <link rel="stylesheet" href="{{ asset('public/frontend/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/responsive.css') }}">
</head>

<body>

    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>

    <div class="td-search-popup" id="td-search-popup">
        <form action="{{ route('news.search') }}" method="GET" class="search-form" id="search-form">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Search.....">
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <div class="body-overlay" id="body-overlay"></div>

    <div class="navbar-area">

        <div class="topbar-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-7 align-self-center">
                        <div class="topbar-menu text-md-left text-center">
                            <ul class="align-self-center">
                                <li><a href="{{ route('pages', 'advertisement') }}">বিজ্ঞাপন</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 mt-2 mt-md-0 text-md-right text-center">
                        <div class="topbar-social">
                            <div class="topbar-date d-none d-lg-inline-block"><i class="fa fa-calendar"></i> {{ date("l, F j") }} </div>
                            <ul class="social-area social-area-2">
                                <li><a class="facebook-icon" href="https://{{ $contact->facebook }}"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter-icon" href="https://{{ $contact->twitter }}"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="youtube-icon" href="https://{{ $contact->pinterest }}"><i class="fa fa-youtube-play"></i></a></li>
                                <li><a class="instagram-icon" href="https://{{ $contact->instagram }}"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="adbar-area bg-black d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-5 align-self-center">
                        <div class="logo text-md-left text-center">
                            <a class="main-logo" href="{{ URL::to('/') }}" style="color: white; font-size: 24px;">নিউজতাহিরপুর২৪</a>
                        </div>
                    </div>
                    @if ($headerAd != null)
                        
                    
                    <div class="col-xl-6 col-lg-7 text-md-right text-center">
                        <a href="{{ $headerAd->link }}" class="adbar-right">
                            <img src="{{ asset($headerAd->photo) }}" alt="img">
                        </a>
                    </div>

                    @endif
                </div>
            </div>
        </div>


        <nav class="navbar navbar-expand-lg">
            <div class="container nav-container">
                <div class="responsive-mobile-menu">
                    <div class="logo d-lg-none d-block">
                        <a class="main-logo" href="{{ URL::to('/') }}" style="color: white; font-size: 24px;">NewsTahirpur24</a>
                    </div>
                    <button class="menu toggle-btn d-block d-lg-none" data-target="#nextpage_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-left"></span>
                        <span class="icon-right"></span>
                    </button>
                </div>
                <div class="nav-right-part nav-right-part-mobile">
                    <a class="search header-search" href="#"><i class="fa fa-search"></i></a>
                </div>
                <div class="collapse navbar-collapse" id="nextpage_main_menu">
                    <ul class="navbar-nav menu-open">
                        {{-- <li class="current-menu-item">
                            <a href="#">Home</a>
                        </li> --}}
                        @foreach ($categories as $item)
                            <li class="current-menu-item">
                                <a href="{{ route('category.news', [$item->slug, $item->id]) }}">{{ $item->name }}</a>
                            </li>
                        @endforeach
                
                    </ul>
                </div>
                <div class="nav-right-part nav-right-part-desktop">
                    <div class="menu-search-inner">
                        <form action="{{ route('news.search') }}" method="GET" class="search-form">
                        @csrf

                        <input type="text" placeholder="Search For" name="search">
                        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>

                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </div>

	@section('frontend-content')
		
	@show

    <div class="footer-area bg-black pd-top-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    @if ($about != null)
                        
                    
                    <div class="widget">
                        <h5 class="widget-title">আমাদের সম্পর্কে</h5>
                        <div class="widget_about">
                            <p>{!! $about->text !!}</p>
                            <ul class="social-area social-area-2 mt-4">
                                <li><a class="facebook-icon" href="https://{{ $contact->facebook }}"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter-icon" href="https://{{ $contact->twitter }}"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="youtube-icon" href="https://{{ $contact->pinterest }}"><i class="fa fa-youtube-play"></i></a></li>
                                <li><a class="instagram-icon" href="https://{{ $contact->instagram }}"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget widget_tag_cloud">
                        <h5 class="widget-title">সংবাদ বিভাগ</h5>
                        <div class="tagcloud">
                            @foreach ($categories as $item)
                                <a href="{{ route('category.news', [$item->slug, $item->id]) }}">{{ $item->name }}</a>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h5 class="widget-title">যোগাযোগ</h5>
                        <ul class="contact_info_list">
                            <li><i class="fa fa-map-marker"></i> {{ $contact->address }}</li>
                            <li><i class="fa fa-phone"></i> {{ $contact->phone }}</li>
                            <li><i class="fa fa-envelope-o"></i> <a href="#" class="__cf_email__" >{{ $contact->email }}</a>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget widget_recent_post">
                        <h5 class="widget-title">জনপ্রিয় সংবাদ</h5>
                        @foreach ($latest as $item)
                        
                        <div class="single-post-list-wrap style-white">
                            <div class="media">
                                <div class="media-left">
                                    <img src="{{ asset($item->photo) }}" alt="img" style="width:100px;">
                                </div>
                                <div class="media-body">
                                    <div class="details">
                                        <div class="post-meta-single">
                                            <ul>
                                                <li><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($item->date)) }}</li>
                                            </ul>
                                        </div>
                                        <h6 class="title"><a href="{{ route('news.detail', [$item->id, $item->slug]) }}"> {{ $item->title }} </a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="footer-bottom text-center">
                <p>কপিরাইট ©২০২১নিউজতাহিরপুর২৪</p>
            </div>
        </div>
    </div>

    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>

    <script src="{{ asset('public/frontend/js/vendor.js') }}"></script>

    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60e16dcb496c49d5"></script>

</body>

</html>
