

@extends('backend.layouts.app')
@section('title', 'News Update')
@section('backend-content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{__('News Update')}}</h3>
                <div class="card-tools">
					<a href="{{route('editor.news.index')}}" class="btn btn-sm bg-teal"><i class="fas fa-list-alt"></i> {{__('News')}}</a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
				@include('includes.error')
                <form action="{{route('editor.news.update', $news->id)}}" method="post" id="userForm" enctype="multipart/form-data">
					@csrf
					@method('PUT')
                    <div class="row">
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<div class="col-md-12">
											<label>{{__('Date')}}</label>
											<input type="text" name="date" class="form-control" placeholder="{{__('Date')}}" required="" autocomplete="off" value="{{$news->date}}" id="date"/>
										</div>
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.col -->
								<div class="col-md-4">
									<div class="form-group">
										<div class="col-md-12">
											<label>{{__('Title')}}</label>
											<input type="text" name="title" class="form-control" placeholder="{{__('Title')}}" required="" autocomplete="off" value="{{$news->title}}" id="title"/>
										</div>
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.col -->
								<div class="col-md-4">
									<div class="form-group">
										<div class="col-md-12">
											<label>{{__('Slug')}}</label>
											<input type="text" name="slug" class="form-control" placeholder="{{__('Slug')}}" required="" autocomplete="off" value="{{$news->slug}}" id="slug"/>
										</div>
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.col -->
								<div class="col-md-4">
									<div class="form-group">
										<label>{{__('Category')}}</label>
										<select class="form-control select2" style="width: 100%;" name="category_id" required="">
											
											@foreach ($categories as $item)
												<option value="{{$item->id}}">{{$item->name}}</option>
											@endforeach
										</select>
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.col -->
								<div class="col-md-4">
									<div class="form-group">
										<div class="col-md-12">
											<label>{{__('Reporter')}}</label>
											<input type="text" name="reporter" class="form-control" placeholder="{{__('Reporter')}}" autocomplete="off" value="{{$news->reporter}}" id="reporter"/>
										</div>
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.col -->
								<div class="col-md-4">
									<div class="form-group">
										<label>{{__('Position')}}</label>
										<select class="form-control select2" style="width: 100%;" name="position">
											
											<option value="0" 
												@if ($news->position == 0) 
													{{ 'selected' }} 
												@endif
											>None</option>
											<option value="1" 
												@if ($news->position == 1) 
													{{ 'selected' }} 
												@endif
											>First Position</option>
											<option value="2" 
												@if ($news->position == 2) 
													{{ 'selected' }} 
												@endif
											>Second Position</option>
											<option value="3" 
												@if ($news->position == 3) 
													{{ 'selected' }} 
												@endif
											>Third Position</option>
											<option value="4" 
												@if ($news->position == 4) 
													{{ 'selected' }} 
												@endif
											>Fourth Position</option>
											<option value="5" 
												@if ($news->position == 5) 
													{{ 'selected' }} 
												@endif
											>Fifth Position</option>
										</select>
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.col -->
								<div class="col-md-12">
									<div class="form-group">
										<div class="col-md-12">
											<label>{{__('Video')}}</label>
											<input type="text" name="video" class="form-control" placeholder="{{__('Video')}}" autocomplete="off" value="{{$news->video}}" onkeyup="youtube_parser(this.value);" />
											<input type="hidden" name="video" class="form-control"
                                                placeholder="{{ __('Video') }}" autocomplete="off"
                                                value="{{ $news->video }}" id="video_link" />
										</div>
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.col -->
								
								<div class="col-md-12">
									<div class="form-group">
										<div class="col-md-12">
											<label>{{__('Content')}}</label>
											<textarea id="summernote" name="content">
												{{$news->content}}
											</textarea>
										</div>
									</div>
									<!-- /.form-group -->
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<div class="col-md-12">
											<label>{{__('Short Content')}}</label>
											<textarea name="short_content" class="form-control" placeholder="{{__('Short Content')}}" required="" autocomplete="off" rows="3">{{ $news->short_content }}</textarea>
										</div>
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.col -->
								<div class="col-md-6">
									<div class="form-group">
										<div class="col-md-12">
											<label>{{__('Tags')}}</label>
											<textarea name="tags" class="form-control" placeholder="{{__('tags')}}" required="" autocomplete="off" rows="3">{{ $news->tags }}</textarea>
										</div>
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.col -->
							</div>
						</div>
						<div class="col-md-3">
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img class="profile-user-img img-fluid img-circle" src="{{ asset($news->photo) }}" alt="User profile picture" id="userPhoto">
										
									</div>
									<br>
									<input type="file" name="photo" onchange="readPicture(this)" style="width: 100%" >
								</div>
								<!-- /.card-body -->
							</div>
						</div>
                        <div class="col-md-12">
                            <center>
                                <button type="reset" class="btn btn-sm bg-red">{{__('Reset')}}</button>
                                <button type="submit" class="btn btn-sm bg-blue">{{__('Update')}}</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('footer')

<script>
  $(function () {
    // Summernote
    $('#summernote').summernote();
  })

  function readPicture(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
        
            reader.onload = function (e) {
                $('#userPhoto')
                .attr('src', e.target.result)
                .width(100)
                .height(100);
            };
        
            reader.readAsDataURL(input.files[0]);
        }
    }

	function youtube_parser(url) {

		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = url.match(regExp);

		if ((match && match[7].length == 11))
			$("#video_link").val(match[7]);
	}

	$(function () {

        $('#date').datepicker({
            autoclose:   true,
            changeYear:  true,
            changeMonth: true,
            dateFormat:  "dd-mm-yy",
            yearRange:   "-0:+0"
        });
    });

	$("#title").keyup(function() {

		var title = $("#title").val();
		var slug = (title.replace(/ /g, '-')).toLowerCase();
		$("#slug").val(slug);

	});

</script>
@endsection