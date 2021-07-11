@extends('layouts.app')

@section('title', 'Home')
@section('frontend-content')
    <div class="cat-page-area pd-bottom-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pd-top-50">
                    <div class="row">
                        @foreach ($teams as $item)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-post-wrap style-box">
                                    <div class="thumb">
                                        <img src="{{ asset($item->photo) }}" alt="img"
                                            style="width: 100%; height: 175px;">
                                    </div>
                                    <div class="details">
                                        <div class="post-meta-single mb-4 pt-1">
                                            <ul>
                                                <li><i class="fa fa-user"></i>{{ $item->name }}</li>
                                            </ul>
                                        </div>
                                        <h6 class="title"><a href="#">{{ $item->position }}</a></h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <nav class="mt-4 text-center">
                        {{ $teams->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
