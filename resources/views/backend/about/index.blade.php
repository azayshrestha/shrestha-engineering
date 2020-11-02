@extends('backend.includes.layout')

@section('title')
    About Us
@stop

@section('formHeader')
    About Us
@stop

@section('formSubHeader')

@stop

@section('style')

@stop

@section('script')

@stop

@section('content')
    <a href="{{route('about.create')}}" class="btn btn-info">
        @if(!$about) Add @else Update @endif About Us
    </a>
    <hr>
    <div class="card">
        <div class="card-body">
            <div class="row">
                @if($about)
                <div class="col-md-8">
                    {!! $about->content !!}
                </div>
                <div class="col-md-4 text-center">
                    <img class="img-fluid rounded" src="{{asset('images/serviceImage/'.$about->image)}}" alt="" />
                </div>
                @endif
            </div>

        </div>
    </div>

@stop