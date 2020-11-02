@extends('backend.includes.layout')

@section('title')
    Manage Image Slider
@stop

@section('formHeader')
    Manage Image Slider
@stop

@section('formSubHeader')

@stop

@section('style')

@stop

@section('script')

@stop

@section('content')
        <a href="" class="btn btn-info" data-toggle="modal" data-target="#addSlider">Add Image Slider</a>
        <hr>
    <div class="card">
        <div class="card-body">
        <table class="table dtable" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Slider Image</th>
                <th>Title</th>
                <th>status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sliders as $key=>$slider)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="{{asset('images/sliderImage/'.$slider->image)}}" data-lightbox="{{$slider->slider_id}}">
                            <img src="{{asset('images/sliderImage/'.$slider->image)}}" style="height: 50px;">
                        </a>
                    </td>
                    <td>{{$slider->title}}</td>
                    <td>
                        @if($slider->status == 1)
                            <span class="badge badge-success">Active</span>
                        @elseif($slider->status ==0)
                            <span class="badge badge-danger">In-Active</span>
                        @endif
                    </td>
                    <td>
                        <a href="#editSlider" class="btn btn-primary" data-toggle="modal" title="Edit Slider" data-target="#editSlider{{$slider->id}}"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$slider->id}}" title="Delete Image"><i class="fa fa-trash"></i></a>
                    </td>

                    <!-- The Modal -->
                    <div class="modal" id="delete{{$slider->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form method="post" action="{{route('slider.destroy', $slider->id)}}">
                                @method('DELETE')
                                {{@csrf_field()}}
                                <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="fa fa-trash-o"></i> Delete Confirmation!</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        Are you sure to remove this record?
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="addSlider">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Images in Slider</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="{{route('slider.store')}}" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                        <label>Image Title</label>
                        <input type="text" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{old('title')}}">
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{old('description')}}">
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Image <span class="red">*</span></label>
                            <input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{old('image')}}" required>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>URL (Link)</label>
                            <input type="url" name="url" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" value="{{old('url')}}" placeholder="Example: https://www.example.com/">
                            @if ($errors->has('url'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Status <span class="red">*</span></label> <br>
                            <label><input type="radio" name="status" value="1" class="mr-2" checked required> Active</label>
                            <label class="ml-3"><input type="radio" name="status" value="0" class="mr-2" required> In-Active</label>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-info">Upload</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($sliders as $slider)
        <div class="modal" id="editSlider{{$slider->id}}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Images in Slider</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="post" action="{{route('slider.update', $slider->id)}}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                    {{@csrf_field()}}
                    <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Image Title</label>
                                <input type="text" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{$slider->title}}">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{$slider->description}}">
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="container">
                                <a href="{{asset('images/sliderImage/'.$slider->image)}}" data-lightbox="image">
                                    <img src="{{asset('images/sliderImage/'.$slider->image)}}" height="120px" style="width: 100%; object-fit: scale-down">
                                </a>
                            </div>
                            <div class="form-group">
                                <label>New Image</label>
                                <input type="hidden" name="old_image" value="{{$slider->image}}">
                                <input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>URL (Link)</label>
                                <input type="url" name="url" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" value="{{$slider->url}}" placeholder="Example: https://www.example.com/">
                                @if ($errors->has('url'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Status <span class="red">*</span></label> <br>
                                <label><input type="radio" name="status" value="1" @if($slider->status == 1)checked @endif required> Active</label>
                                <label style="margin-left: 20px;"><input type="radio" name="status" value="0" @if($slider->status == 0)checked @endif required> In-Active</label>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-info">Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@stop