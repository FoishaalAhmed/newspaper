@extends('layouts.app')

@section('title', "{ $news->title }")
@section('frontend-content')
    <section class="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h5 class="page-title">{{ $news->title }}</h5>
                        <ul class="page-list">
                            <li><a href="{{ URL::to('/') }}">হোম</a></li>
                            <li>{{ $news->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="blog-page-area pd-bottom-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 pd-top-50">
                    <div class="blog-details-page-inner">
                        <div class="single-blog-inner m-0">
                            <div class="single-post-wrap style-overlay">
                                <div class="thumb">
                                    <img src="{{ asset($news->photo) }}" alt="img">
                                </div>
                                <div class="details pb-4">
                                    <div class="post-meta-single mb-2">
                                        <ul>
                                            <li><a class="tag-base tag-blue" href="{{ route('category.news', $news->category_id) }}">{{ $news->category }}</a></li>
                                            <li>
                                                <p><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($news->date)) }}</p>
                                            </li>
                                            <li><i class="fa fa-user"></i>{{ $news->reporter }}</li>
                                        </ul>
                                    </div>
                                    <h5 class="title mt-0">{{ $news->title }}</h5>
                                </div>
                            </div>
                            <div class="single-blog-details">
                                {!! $news->content !!}
                            </div>
                             @if ($middleAd != null)
                            <div class="add-area">
                                <a href="{{ $middleAd->link }}"><img src="{{ asset($middleAd->photo) }}" alt="img"></a>
                            </div>
                            @endif

                            @if ($news->video != null)
                            
                            <div class="video-area">
                                <h5>{{ $news->title }}</h5>
                                <div class="single-blog-inner mb-4">
                                    <div class="thumb">
                                        <img src="https://img.youtube.com/vi/<?php echo $news->video ?>/hqdefault.jpg" alt="image">
                                        <a class="video-play-btn" href="https://www.youtube.com/embed/Wimkqo8gDZ0" data-effect="mfp-zoom-in"><i class="fa fa-play"></i></a>
                                    </div>
                                </div>
                            </div>

                            @endif
                            <div class="meta">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="tags">
                                            <span>Tags:</span>
                                            <a href="#">{{ $news->tags }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 text-md-right">
                                        <div class="blog-share">
                                            <span>Share:</span>
                                            <ul class="social-area social-area-2 d-inline">
                                                <li><a class="facebook-icon" href="#"><i class="fa fa-facebook"></i></a>
                                                </li>
                                                <li><a class="twitter-icon" href="#"><i class="fa fa-twitter"></i></a>
                                                </li>
                                                <li><a class="youtube-icon" href="#"><i
                                                            class="fa fa-youtube-play"></i></a></li>
                                                <li><a class="instagram-icon" href="#"><i
                                                            class="fa fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="related-post">
                            <div class="section-title mb-0">
                                <h5 class="mb-0">Related Post</h5>
                            </div>
                            <div class="row justify-content-center">
                                @foreach ($relatedNews as $item)   
                                
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-post-wrap">
                                        <div class="thumb">
                                            <img src="{{ asset($item->photo) }}" alt="img" style="width: 265px; height: 175px;">
                                        </div>
                                        <div class="details">
                                            <div class="post-meta-single">
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($item->date)) }}</li>
                                                    <li><i class="fa fa-user"></i>{{ $item->reporter }}</li>
                                                </ul>
                                            </div>
                                            <h6 class="title mt-2"><a href="{{ route('news.detail', $item->slug) }}">{{ $item->title }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 pd-top-50">
                    <div class="category-sitebar">
                        <div class="widget widget-category">
                            <h6 class="widget-title">Category</h6>
                            <div class="row custom-gutters-14">
                                @foreach ($categories as $item)  
                                
                                <div class="col-lg-6 col-sm-6">
                                    <div class="single-category-inner">
                                        <img src="{{ asset('public/frontend/img/category/9.png') }}" alt="img">
                                        <a class="tag-base tag-blue" href="{{ route('category.news', $item->slug) }}">{{ $item->name }}</a>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>

                        @if ($sidebarAd != null)
                        <div class="widget widget-add">
                            <div class="add">
                                <a href="{{ $sidebarAd->link }}"><img class="w-100" src="{{ asset($sidebarAd->photo) }}" alt="img"></a>
                            </div>
                        </div>
                        @endif

                        <div class="widget widget-social">
                            <h6 class="widget-title">Join to Us</h6>
                            <ul class="social-area social-area-2">
                                <li><a class="facebook-icon" href="https://{{ $contact->facebook }}"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter-icon" href="https://{{ $contact->twitter }}"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="youtube-icon" href="https://{{ $contact->pinterest }}"><i class="fa fa-youtube-play"></i></a></li>
                                <li><a class="instagram-icon" href="https://{{ $contact->instagram }}"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="widget">
                            <h6 class="widget-title">Category</h6>
                            <div class="post-slider owl-carousel">
                                <div class="item">
                                    <div class="trending-post">
                                        <div class="single-post-wrap style-overlay">
                                            <div class="thumb">
                                                <img src="assets/img/post/5.png" alt="img">
                                            </div>
                                            <div class="details">
                                                <div class="post-meta-single">
                                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                                </div>
                                                <h6 class="title"><a href="#">The FAA will test drone </a></h6>
                                            </div>
                                        </div>
                                        <div class="single-post-wrap style-overlay">
                                            <div class="thumb">
                                                <img src="assets/img/post/6.png" alt="img">
                                            </div>
                                            <div class="details">
                                                <div class="post-meta-single">
                                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                                </div>
                                                <h6 class="title"><a href="#">Flight schedule and quarantine</a></h6>
                                            </div>
                                        </div>
                                        <div class="single-post-wrap style-overlay mb-0">
                                            <div class="thumb">
                                                <img src="assets/img/post/7.png" alt="img">
                                            </div>
                                            <div class="details">
                                                <div class="post-meta-single">
                                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                                </div>
                                                <h6 class="title"><a href="#">Indore bags cleanest city</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="trending-post">
                                        <div class="single-post-wrap style-overlay">
                                            <div class="thumb">
                                                <img src="assets/img/post/5.png" alt="img">
                                            </div>
                                            <div class="details">
                                                <div class="post-meta-single">
                                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                                </div>
                                                <h6 class="title"><a href="#">The FAA will test drone </a></h6>
                                            </div>
                                        </div>
                                        <div class="single-post-wrap style-overlay">
                                            <div class="thumb">
                                                <img src="assets/img/post/6.png" alt="img">
                                            </div>
                                            <div class="details">
                                                <div class="post-meta-single">
                                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                                </div>
                                                <h6 class="title"><a href="#">Flight schedule and quarantine</a></h6>
                                            </div>
                                        </div>
                                        <div class="single-post-wrap style-overlay mb-0">
                                            <div class="thumb">
                                                <img src="assets/img/post/7.png" alt="img">
                                            </div>
                                            <div class="details">
                                                <div class="post-meta-single">
                                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                                </div>
                                                <h6 class="title"><a href="#">Indore bags cleanest city</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="nxp-tab-inner nxp-tab-post-two mb-4">
                                <ul class="nav nav-tabs" id="nx1" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="nx1-tab-1" data-toggle="pill" href="#nx1-tabs-1"
                                            role="tab" aria-selected="true">
                                            Recent
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="nx1-tab-2" data-toggle="pill" href="#nx1-tabs-2"
                                            role="tab" aria-selected="false">
                                            Populer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="nx1-content">

                                <div class="tab-pane fade show active" id="nx1-tabs-1" role="tabpanel">
                                    @foreach ($latest as $item)
                                        
                                    <div class="single-post-list-wrap">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{ asset($item->photo) }}" alt="img">
                                            </div>
                                            <div class="media-body">
                                                <div class="details">
                                                    <div class="post-meta-single">
                                                        <ul>
                                                            <li><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($item->date)) }} </li>
                                                        </ul>
                                                    </div>
                                                    <h6 class="title"><a href="{{  route('news.detail', $item->slug)  }}">{{ $item->title }} </a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="tab-pane fade" id="nx1-tabs-2" role="tabpanel">
                                    @foreach ($popular as $item)
                                        
                                    <div class="single-post-list-wrap">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{ asset($item->photo) }}" alt="img">
                                            </div>
                                            <div class="media-body">
                                                <div class="details">
                                                    <div class="post-meta-single">
                                                        <ul>
                                                            <li><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($item->date)) }} </li>
                                                        </ul>
                                                    </div>
                                                    <h6 class="title"><a href="{{  route('news.detail', $item->slug)  }}">{{ $item->title }} </a></h6>
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
    </div>
@endsection