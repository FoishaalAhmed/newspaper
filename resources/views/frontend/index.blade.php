@extends('layouts.app')

@section('frontend-content')

<div class="banner-area banner-inner-1 bg-black">

        @php
            $mainLead = array_slice($leadNews, 0, 1);
            $restLead = array_slice($leadNews, 1);
        @endphp

        <div class="banner-inner pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="thumb after-left-top">
                            <img src="{{ asset($mainLead[0]['photo']) }}" alt="img">
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-center">
                        <div class="banner-details mt-4 mt-lg-0">
                            <div class="post-meta-single">
                                <ul>
                                    <li><a class="tag-base tag-blue" href="{{ route('category.news', $mainLead[0]['category_slug']) }}">{{ $mainLead[0]['category'] }}</a></li>
                                    <li class="date"><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($mainLead[0]['date'])) }}</li>
                                </ul>
                            </div>
                            <h2>{{ $mainLead[0]['title'] }}</h2>
                            <p>{!! Str::limit($mainLead[0]['content'], 250) !!} </p>
                            <a class="btn btn-blue" href="{{ route('news.detail', $mainLead[0]['slug']) }}">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach ($restLead as $lead)
                <div class="col-lg-3 col-sm-6">
                    <div class="single-post-wrap style-white">
                        <div class="thumb">
                            <img src="{{ asset($lead['photo']) }}" alt="img" style="width: 265px; height:175px;">
                            <a class="tag-base @if($loop->odd) {{ 'tag-blue' }} @else {{ 'tag-orange' }} @endif" href="{{ route('category.news', $lead['category_slug']) }}">{{ $lead['category'] }}</a>
                        </div>
                        <div class="details">
                            <h6 class="title"><a href="{{  route('news.detail', $lead['slug'])  }}">{{ $lead['title'] }}</a></h6>
                            <div class="post-meta-single mt-3">
                                <ul>
                                    <li><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($lead['date'])) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="post-area pd-top-75 pd-bottom-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="section-title">
                        <h6 class="title">Trending News</h6>
                    </div>
                    <div class="post-slider owl-carousel">
                        @php
                            $firstThreeLead = array_slice($trendingNews, 0, 3);
                            $restThreeLead = array_slice($trendingNews, 3, 3);
                        @endphp
                        <div class="item">
                            <div class="trending-post">
                                @foreach ($firstThreeLead as $item)
                                    
                                <div class="single-post-wrap style-overlay">
                                    <div class="thumb">
                                        <img src="{{ asset($item['photo']) }}" alt="img" style="width: 265px; height: 120px;">
                                    </div>
                                    <div class="details">
                                        <div class="post-meta-single">
                                            <p><i class="fa fa-clock-o"></i>{{ date('d M Y', strtotime($item['date'])) }}</p>
                                        </div>
                                        <h6 class="title"><a href="{{ route('news.detail', $item['slug']) }}">{{ $item['title'] }}</a></h6>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                        <div class="item">
                            <div class="trending-post">

                                @foreach ($restThreeLead as $item)
                                    
                                <div class="single-post-wrap style-overlay">
                                    <div class="thumb">
                                        <img src="{{ asset($item['photo']) }}" alt="img" style="width: 265px; height: 120px;">
                                    </div>
                                    <div class="details">
                                        <div class="post-meta-single">
                                            <p><i class="fa fa-clock-o"></i>{{ date('d M Y', strtotime($item['date'])) }}</p>
                                        </div>
                                        <h6 class="title"><a href="{{ route('news.detail', $item['slug']) }}">{{ $item['title'] }}</a></h6>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="section-title">
                        <h6 class="title">Latest News</h6>
                    </div>
                    <div class="post-slider owl-carousel">
                        @php
                            $firstFiveLatest = array_slice($latestNews, 0, 5);
                            $secondFiveLatest = array_slice($latestNews, 5);
                        @endphp
                        <div class="item">
                            @foreach ($firstFiveLatest as $item)
                                <div class="single-post-list-wrap">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="{{ asset($item['photo']) }}" alt="img">
                                        </div>
                                        <div class="media-body">
                                            <div class="details">
                                                <div class="post-meta-single">
                                                    <ul>
                                                        <li><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($item['date'])) }}</li>
                                                    </ul>
                                                </div>
                                                <h6 class="title"><a href="{{  route('news.detail', $item['slug'])  }}">{{ $item['title'] }}</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="item">
                            @foreach ($secondFiveLatest as $item)
                                <div class="single-post-list-wrap">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="{{ asset($item['photo']) }}" alt="img">
                                        </div>
                                        <div class="media-body">
                                            <div class="details">
                                                <div class="post-meta-single">
                                                    <ul>
                                                        <li><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($item['date'])) }}</li>
                                                    </ul>
                                                </div>
                                                <h6 class="title"><a href="{{  route('news.detail', $item['slug'])  }}">{{ $item['title'] }}</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="section-title">
                        <h6 class="title">What’s new</h6>
                    </div>
                    <div class="post-slider owl-carousel">
                        <div class="item">
                            <div class="single-post-wrap">
                                <div class="thumb">
                                    <img src="{{ asset('public/frontend/img/post/8.png') }}" alt="img">
                                </div>
                                <div class="details">
                                    <div class="post-meta-single mb-4 pt-1">
                                        <ul>
                                            <li><a class="tag-base tag-blue" href="cat-tech.html">Tech</a></li>
                                            <li><i class="fa fa-clock-o"></i>08.22.2020</li>
                                        </ul>
                                    </div>
                                    <h6 class="title"><a href="blog-details.html">Uttarakhand’s Hemkund Sahib yatra to
                                            start from September 4</a></h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-post-wrap">
                                <div class="thumb">
                                    <img src="{{ asset('public/frontend/img/post/8.png') }}" alt="img">
                                </div>
                                <div class="details">
                                    <div class="post-meta-single mb-4 pt-1">
                                        <ul>
                                            <li><a class="tag-base tag-blue" href="cat-tech.html">Tech</a></li>
                                            <li><i class="fa fa-clock-o"></i>08.22.2020</li>
                                        </ul>
                                    </div>
                                    <h6 class="title"><a href="blog-details.html">Uttarakhand’s Hemkund Sahib yatra to
                                            start from September 4</a></h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="section-title">
                        <h6 class="title">Join With Us</h6>
                    </div>
                    <div class="social-area-list mb-4">
                        <ul>
                            <li><a class="facebook" href="#"><i
                                        class="fa fa-facebook social-icon"></i><span>12,300</span><span>Like</span> <i
                                        class="fa fa-plus"></i></a></li>
                            <li><a class="twitter" href="#"><i
                                        class="fa fa-twitter social-icon"></i><span>12,600</span><span>Followers</span>
                                    <i class="fa fa-plus"></i></a></li>
                            <li><a class="youtube" href="#"><i
                                        class="fa fa-youtube-play social-icon"></i><span>1,300</span><span>Subscribers</span>
                                    <i class="fa fa-plus"></i></a></li>
                            <li><a class="instagram" href="#"><i
                                        class="fa fa-instagram social-icon"></i><span>52,400</span><span>Followers</span>
                                    <i class="fa fa-plus"></i></a></li>
                            <li><a class="google-plus" href="#"><i
                                        class="fa fa-google social-icon"></i><span>19,101</span><span>Subscribers</span>
                                    <i class="fa fa-plus"></i></a></li>
                        </ul>
                    </div>
                    @if ($sidebarAd != null)
                    <div class="add-area">
                        <a href="{{ $sidebarAd->link }}"><img class="w-100" src="{{ asset($sidebarAd->photo) }}" alt="img"></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="bg-sky pd-top-80 pd-bottom-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-sm-9">
                    <div class="row">
                        @foreach ($bangladeshNews as $bangladesh)
                        <div class="col-lg-4 col-sm-12">
                            <div class="single-post-wrap">
                                <div class="thumb">
                                    <img src="{{ asset($bangladesh->photo) }}" alt="img" style="width: 265px; height:175px;">
                                    <p class="btn-date"><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($bangladesh->date)) }}</p>
                                </div>
                                <div class="details">
                                    <h6 class="title"><a href="{{  route('news.detail', $bangladesh->slug)  }}">{{ $bangladesh->title }}</a></h6>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    
                </div>
                
                <div class="col-lg-3 col-sm-6">
                    <div class="trending-post style-box">
                        <div class="section-title">
                            <h6 class="title">Trending News</h6>
                        </div>
                        <div class="post-slider owl-carousel">
                            @php
                                $firstFiveTrending = array_slice($trendingNews, 0, 5);
                                $restFiveTrending = array_slice($trendingNews, 5);
                            @endphp
                            <div class="item">
                                @foreach ($firstFiveTrending as $item)
                                
                                <div class="single-post-list-wrap">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="{{ asset($item['photo']) }}" alt="img">
                                        </div>
                                        <div class="media-body">
                                            <div class="details">
                                                <div class="post-meta-single">
                                                    <ul>
                                                        <li><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($item['date'])) }}</li>
                                                    </ul>
                                                </div>
                                                <h6 class="title"><a href="{{  route('news.detail', $item['slug'])  }}">{{ $item['title'] }}</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                            <div class="item">
                                @foreach ($restFiveTrending as $item)
                                
                                <div class="single-post-list-wrap">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="{{ asset($item['photo']) }}" alt="img">
                                        </div>
                                        <div class="media-body">
                                            <div class="details">
                                                <div class="post-meta-single">
                                                    <ul>
                                                        <li><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($item['date'])) }}</li>
                                                    </ul>
                                                </div>
                                                <h6 class="title"><a href="{{  route('news.detail', $item['slug'])  }}">{{ $item['title'] }}</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pd-top-80 pd-bottom-50">
        <div class="container">
            <div class="row">
                @foreach ($randomEightNews as $item)
                
                <div class="col-lg-3 col-sm-6">
                    <div class="single-post-wrap style-overlay">
                        <div class="thumb">
                            <img src="{{ asset($item->photo) }}" alt="img" style="width: 265px; height:175px;">
                            <a class="tag-base @if($loop->odd) {{ 'tag-blue' }} @else {{ 'tag-purple' }} @endif" href="{{ route('category.news', $item->category_slug) }}">{{ $item->category }}</a>
                        </div>
                        <div class="details">
                            <div class="post-meta-single">
                                <p><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($item->date)) }}</p>
                            </div>
                            <h6 class="title"><a href="{{  route('news.detail', $item->slug)  }}">{{ $item->title }}</a></h6>
                        </div>
                    </div>
                </div>

                @endforeach
                
            </div>
        </div>
    </div>

    <div class="video-area bg-black pd-top-80 pd-bottom-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="tab-content" id="ex1-content">
                        @foreach ($videos as $key => $item)
                            <div class="tab-pane fade show @if($key == 0) {{ 'active' }} @endif" id="ex1-tabs-<?php echo $key; ?>" role="tabpanel">
                                <div class="single-post-wrap style-overlay">
                                    <div class="thumb">
                                        <img src="{{ asset($item->photo) }}" alt="img" style="width: 100%">
                                        <a href="https://www.youtube.com/watch?v=<?php echo $item->video ?>" class="play-btn-small play-btn-gray" target="_blank"><i class="fa fa-play"></i></a>
                                    </div>
                                    <div class="details">
                                        <div class="post-meta-single">
                                            <p><i class="fa fa-clock-o"></i>{{ date('d.m.y', strtotime($item->created_at)) }}</p>
                                        </div>
                                        <h6 class="title"><a href="https://www.youtube.com/watch?v=<?php echo $item->video ?>" target="_blank">{{ $item->title }}</a></h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nxp-tab-inner video-tab-inner text-center">
                        <ul class="nav nav-tabs" id="ex1" role="tablist">
                            @foreach ($videos as $key => $item)
                                
                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($key == 0) {{ 'active' }} @endif" id="ex1-tab-<?php echo $key; ?>" data-toggle="pill" href="#ex1-tabs-<?php echo $key; ?>"
                                    role="tab" aria-selected="true">
                                    <div class="single-post-list-wrap style-white text-left">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{ asset($item->photo) }}" alt="img">
                                                <div class="play-btn-small play-btn-gray"><i class="fa fa-play"></i>
                                                </div>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <div class="details">
                                                    <div class="post-meta-single">
                                                        <ul>
                                                            <li><i class="fa fa-clock-o"></i>{{ date('d.m.y', strtotime($item->created_at)) }}</li>
                                                        </ul>
                                                    </div>
                                                    <h6 class="title mt-2">{{ $item->title }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($middleAd != null)

    <div class="add-area bg-after-sky mg-top--100">
        <div class="container">
            <a href="{{ $middleAd->link }}"><img src="{{ asset($middleAd->photo) }}" alt="img"></a>
        </div>
    </div>
    @endif
    <div class="tranding-area pd-top-75 pd-bottom-50">
        <div class="container">
            <div class="section-title">
                <div class="row">
                    <div class="col-md-3 mb-2 mb-md-0">
                        <h6 class="title">Trending News</h6>
                    </div>
                    <div class="col-md-9">
                        <div class="nxp-tab-inner nxp-tab-post text-md-right">
                            <ul class="nav nav-tabs" id="enx1" role="tablist">
                                @foreach ($category as $catKey1 => $item)
                                    
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if($catKey1 == 0) {{ 'active' }} @endif" id="enx1-tab-<?php echo $catKey1; ?>" data-toggle="pill" href="#enx1-tabs-<?php echo $catKey1; ?>"
                                        role="tab" aria-selected="true">
                                        {{ $item->name }}
                                    </a>
                                </li>

                                 @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="enx1-content">
                @foreach ($category as $catKey2 => $item)
                    
                <div class="tab-pane fade show @if($catKey2 == 0) {{ 'active' }} @endif" id="enx1-tabs-<?php echo $catKey2; ?>" role="tabpanel">
                    <div class="row">

                        @foreach ($item->news as $newsKey => $newsItem)
                            
                        <div class="col-lg-3 col-sm-6">
                            <div class="single-post-wrap">
                                <div class="thumb">
                                    <img src="{{ asset($newsItem->photo) }}" alt="img" style="width: 265px; height:175px;">
                                    <a class="tag-base @if($loop->odd) {{ 'tag-light-green' }} @else {{ 'tag-orange' }} @endif  " href="{{ route('category.news', $newsItem->category_slug) }}">{{ $newsItem->category }}</a>
                                </div>
                                <div class="details">
                                    <div class="post-meta-single mb-3">
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>08.22.2020</li>
                                            <li><i class="fa fa-user"></i> {{ $newsItem->reporter }}</li>
                                        </ul>
                                    </div>
                                    <h6><a href="{{ route('news.detail', $newsItem->slug) }}">{{ $newsItem->title }}
                                        </a></h6>
                                    <p>{!! Str::limit($newsItem->category, 150) !!}</p>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
    
@endsection