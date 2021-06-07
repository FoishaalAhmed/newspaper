@extends('backend.layouts.app')
@section('title', 'Categories')
@section('backend-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Categories') }}</h3>
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
                    @if (isset($category))
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="post" id="postForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Name') }}</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="{{ __('Name') }}" required="" autocomplete="off"
                                                value="{{ $category->name }}" id="name" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Slug') }}</label>
                                            <input type="text" name="slug" class="form-control"
                                                placeholder="{{ __('Slug') }}" required="" autocomplete="off"
                                                value="{{ $category->slug }}" id="slug" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Position') }}</label>
                                            <input type="text" name="position" class="form-control"
                                                placeholder="{{ __('Position') }}" required="" autocomplete="off"
                                                value="{{ $category->position }}" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Menu') }}</label>
                                            <select name="menu" class="form-control" required="" style="width: 100%" id="">
                                                <option value="1" 
                                                @if ($category->menu == '1')
                                                    {{ 'selected' }}
                                                @endif
                                                >Yes</option>
                                                <option value="0" 
                                                @if ($category->menu == '0')
                                                    {{ 'selected' }}
                                                @endif
                                                >No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                        <button type="submit" class="btn btn-sm bg-teal">{{ __('Save') }}</button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('admin.categories.store') }}" method="post" id="postForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Name') }}</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="{{ __('Name') }}" required="" autocomplete="off"
                                                value="{{ old('name') }}" id="name" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Slug') }}</label>
                                            <input type="text" name="slug" class="form-control"
                                                placeholder="{{ __('Slug') }}" required="" autocomplete="off"
                                                value="{{ old('slug') }}" id="slug" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Position') }}</label>
                                            <input type="text" name="position" class="form-control"
                                                placeholder="{{ __('Position') }}" required="" autocomplete="off"
                                                value="{{ old('position') }}" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">{{ __('Menu') }}</label>
                                            <select name="menu" class="form-control" required="" style="width: 100%" id="">
                                                <option value="1" 
                                                @if (old('menu') == '1')
                                                    {{ 'selected' }}
                                                @endif
                                                >Yes</option>
                                                <option value="0" 
                                                @if (old('menu') == '0')
                                                    {{ 'selected' }}
                                                @endif
                                                >No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
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
                                        <th style="width: 55%">{{ __('Name') }}</th>
                                        <th style="width: 15%">{{ __('Position') }}</th>
                                        <th style="width: 15%">{{ __('Menu') }}</th>
                                        <th style="width: 10%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->position }}</td>
                                            <td>
                                                @if ($category->menu == 0)
                                                    {{ 'No' }}
                                                @else
                                                    {{ 'Yes' }}
                                                @endif
                                                
                                            </td>
                                            <td>
                                                <a class="btn btn-sm bg-teal"
                                                    href="{{ route('admin.categories.edit', [$category->id]) }}"><span
                                                        class="fas fa-edit"></span></a>
                                                <form action="{{ route('admin.categories.destroy', [$category->id]) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ $category->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                    event.preventDefault();
                                                    getElementById('delete-form-{{ $category->id }}').submit();
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
        $("#name").keyup(function() {

            var name = $("#name").val();

            var slug = (name.replace(/ /g, '-')).toLowerCase();
            $("#slug").val(slug);

        });

    </script>

@endsection
