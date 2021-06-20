@extends('backend.layouts.app')
@section('title', 'Ads')
@section('backend-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Ads') }}</h3>
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
                    @if (isset($ad))
                        <form action="{{ route('admin.ads.update', $ad->id) }}" method="post" id="postForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Position') }}</label>
                                            <select name="position" class="form-control" required="" style="width: 100%" id="position">
                                                <option value="Header" @if ($ad->position == 'Header') {{ 'selected' }} @endif>Header</option>
                                                <option value="Sidebar" @if ($ad->position == 'Sidebar') {{ 'selected' }} @endif>Sidebar</option>

                                                <option value="Middle Of News" @if ($ad->position == 'Middle Of News') {{ 'selected' }} @endif>Middle Of News</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Link') }}</label>
                                            <input type="text" name="link" class="form-control"
                                                placeholder="{{ __('Link') }}" autocomplete="off"
                                                value="{{ $ad->link }}" id="link"/>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-3">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle"
                                                    src="{{ asset($ad->photo) }}" alt="User profile picture"
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
                        <form action="{{ route('admin.ads.store') }}" method="post" id="postForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Position') }}</label>
                                            <select name="position" class="form-control" required="" style="width: 100%">

                                                <option value="Header" @if (old('position') == 'Header') {{ 'selected' }} @endif>Header</option>
                                                <option value="Sidebar" @if (old('position') == 'Sidebar') {{ 'selected' }} @endif>Sidebar</option>

                                                <option value="Middle Of News" @if (old('position') == 'Middle Of News') {{ 'selected' }} @endif>Middle Of News</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Link') }}</label>
                                            <input type="text" name="link" class="form-control"
                                                placeholder="{{ __('Link') }}" autocomplete="off"
                                                value="{{ old('link') }}" id="link" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-3">
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
                                        <th style="width: 5%">{{ __('Sl') }}</th>
                                        <th style="width: 15%">{{ __('Position') }}</th>
                                        <th style="width: 60%">{{ __('Link') }}</th>
                                        <th style="width: 10%">{{ __('Photo') }}</th>
                                        <th style="width: 10%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ads as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->position }}</td>
                                            <td>{{ $item->link }}</td>
                                            <td>
                                                <img src="{{ asset($item->photo) }}" alt=""
                                                    style="width: 50px; height:50px;">
                                            </td>
                                            <td>
                                                <a class="btn btn-sm bg-teal"
                                                    href="{{ route('admin.ads.edit', [$item->id]) }}"><span
                                                        class="fas fa-edit"></span></a>
                                                <form action="{{ route('admin.ads.destroy', [$item->id]) }}"
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
                                                                            }"><span class="fas fa-trash"></span></a>
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

    </script>

@endsection
