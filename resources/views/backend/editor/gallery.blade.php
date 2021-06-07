@extends('backend.layouts.app')
@section('title', 'Galleries')
@section('backend-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Galleries') }}</h3>
                    <div class="card-tools">
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
                    @if (isset($gallery))
                        <form action="{{ route('editor.galleries.update', $gallery->id) }}" method="post" id="postForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Type') }}</label>
                                            <select name="type" class="form-control" required="" style="width: 100%"
                                                id="type" onchange="showHideVideoPhoto()">
                                                <option value="Video" @if ($gallery->type == 'Video') {{ 'selected' }} @endif>Video</option>
                                                <option value="Photo" @if ($gallery->type == 'Photo') {{ 'selected' }} @endif>Photo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group" id="video" style="display: @if($gallery->type != 'Video' ) {{ 'none' }} @endif">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Video') }}</label>
                                            <input type="text" name="link" class="form-control"
                                                placeholder="{{ __('Video') }}" autocomplete="off"
                                                value="{{ $gallery->link }}" id="link" onkeyup="youtube_parser(this.value);"/>

                                            <input type="hidden" name="video" class="form-control"
                                                placeholder="{{ __('Video') }}" autocomplete="off"
                                                value="{{ $gallery->video }}" id="video_link" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-3" id="photo" style="display: @if($gallery->type != 'Photo' ) {{ 'none' }} @endif">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle"
                                                    src="{{ asset($gallery->photo) }}" alt="User profile picture"
                                                    id="galleryPhoto">
                                            </div>
                                            <br>
                                            <input type="file" name="photo" onchange="readPicture(this)"
                                                style="width: 100%">
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                        <button type="submit" class="btn btn-sm bg-teal">{{ __('Update') }}</button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('editor.galleries.store') }}" method="post" id="postForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Type') }}</label>
                                            <select name="type" class="form-control" required="" style="width: 100%"
                                                id="type" onchange="showHideVideoPhoto()">
                                                <option value="Video" @if (old('type') == 'Video') {{ 'selected' }} @endif>Video</option>
                                                <option value="Photo" @if (old('type') == 'Photo') {{ 'selected' }} @endif>Photo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group" id="video">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Video') }}</label>
                                            <input type="text" name="link" class="form-control"
                                                placeholder="{{ __('Video') }}" autocomplete="off"
                                                value="{{ old('link') }}" id="link" onkeyup="youtube_parser(this.value);"/>

                                            <input type="hidden" name="video" class="form-control"
                                                placeholder="{{ __('Video') }}" autocomplete="off"
                                                value="{{ old('video') }}" id="video_link" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-3" id="photo" style="display: none;">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle"
                                                    src="//placehold.it/200x200" alt="User profile picture"
                                                    id="galleryPhoto">
                                            </div>
                                            <br>
                                            <input type="file" name="photo" onchange="readPicture(this)"
                                                style="width: 100%">
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                        <button type="submit" class="btn btn-sm bg-teal">{{ __('Save') }}</button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    @endif
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Sl') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Video') }}</th>
                                        <th>{{ __('Photo') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($galleries as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td>{{ $item->video }}</td>
                                            <td>
                                                <img src="{{ asset($item->photo) }}" alt=""
                                                    style="width: 50px; height:50px;">
                                            </td>
                                            <td>
                                                <a class="btn btn-sm bg-teal"
                                                    href="{{ route('editor.galleries.edit', [$item->id]) }}"><span
                                                        class="fas fa-edit"></span></a>
                                                {{-- <form action="{{ route('editor.galleries.destroy', [$item->id]) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ $item->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                                            event.preventDefault();
                                                                            getElementById('delete-form-{{ $item->id }}').submit();
                                                                            }else{
                                                                            event.preventDefault();
                                                                            }"><span class="fas fa-trash"></span></a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

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
        function showHideVideoPhoto() {

            let type = $('#type').val();

            if (type == 'Photo') {
                $('#photo').show();
                $('#video').hide();
            } else {
                $('#photo').hide();
                $('#video').show();
            }
        }

        function readPicture(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#galleryPhoto')
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

    </script>

@endsection
