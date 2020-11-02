@extends('backend.includes.layout')

@section('title')
    About
@stop

@section('formHeader')
    @if(!$about) Add @else Update @endif Services
@stop

@section('formSubHeader')

@stop

@section('style')

@stop

@section('script')

@stop

@section('content')

    <div class="card">
        <div class="card-body">
            @if($about)
                <form method="post" action="{{route('about.update', $about->id)}}" enctype="multipart/form-data">
                 <input type="hidden" name="_method" value="PUT">
            @else
                <form method="post" action="{{route('about.store')}}" enctype="multipart/form-data">
            @endif

                    {{@csrf_field()}}

                        <div class="row">
                            <div class="col-md-6">


                                <label>Content</label>
                                @if($about)
                                    <textarea class="textarea w-100" name="about_content">{{$about->content}}</textarea>
                                @else
                                    <textarea class="textarea w-100" name="about_content">{{old('about_content')}}</textarea>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                    @if($about)
                                        @if($about->image)
                                            <img id="target" class="mx-auto rounded card elevation-3"  height="140px" src="{{asset('images/serviceImage/'.$about->image)}}">
                                        @endif
                                    @endif
                                    </div>
                                    <div class="col-6 form-group">
                                        <label>Image <span class="text-red">*</span></label>
                                        <input type="file" name="image" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{old('image')}}" @if(!$about) required @endif>
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-6 form-group">
                                        <label>Facebook Account <small>(optional)</small></label>
                                        <input type="url" class="form-control" name="facebook">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label>Instagram Account <small>(optional)</small></label>
                                        <input type="url" class="form-control" name="instagram">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label>LinkedIn Account <small>(optional)</small></label>
                                        <input type="url" class="form-control" name="linkedin">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label>Twitter Account <small>(optional)</small></label>
                                        <input type="url" class="form-control" name="twitter">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label>Google Account <small>(optional)</small></label>
                                        <input type="text" class="form-control" name="google">
                                    </div>
                                </div>

                            </div>
                        </div>

                    <button type="submit" class="btn btn-outline-info">
                        @if(!$about) Submit @else Update @endif
                    </button>
                </form>
        </div>
    </div>
@stop

@section('script')

@stop