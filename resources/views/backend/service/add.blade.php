@extends('backend.includes.layout')

@section('title')
    Services
@stop

@section('formHeader')
    @if(!$service) Add @else Update @endif Services
@stop

@section('formSubHeader')

@stop

@section('style')

@stop

@section('script')

@stop

@section('content')

    <div class="col-6 offset-3">
        <div class="card">
            <div class="card-body">
                @if(!$service)
                <form method="post" action="{{route('service.store')}}" enctype="multipart/form-data">
                @else
                <form method="post" action="{{route('service.update', $service->id)}}" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                @endif
                    {{@csrf_field()}}
                    <div class="form-group">
                        <label>Service Title <span class="text-red">*</span></label>
                        <input type="text" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                               value="@if(!$service) {{old('title')}} @else {{$service->title}} @endif" required>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                        @endif
                    </div>
                    @if($service)
                        @if($service->image)
                            <img class="rounded card elevation-3"  height="140px" src="{{asset('images/serviceImage/'.$service->image)}}">
                        @endif
                    @endif
                    <div class="form-group">
                        <label>Image <span class="text-red">*</span></label>
                        <input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{old('image')}}" @if(!$service) required @endif>
                        @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Service Content</label>
                        <textarea class="textarea" name="service_content">@if(!$service){{old('service_content')}}@else{!! $service->content !!}@endif</textarea>
                        @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Status <span class="red">*</span></label> <br>
                        <label><input type="radio" name="status" value="1" class="mr-2"
                         @if(!$service)
                            checked
                         @else
                            @if($service->status == 1) checked @endif
                          @endif required> Active</label>
                        <label class="ml-3"><input type="radio" name="status" value="0" class="mr-2"  @if($service && $service->status == 0) checked @endif required> In-Active</label>
                    </div>

                    <button type="submit" class="btn btn-outline-info">@if(!$service) Add @else Update @endif Service</button>

                </form>
            </form>
        </div>
    </div>
@stop