@extends('frontend.includes.layout')

@section('title')
    Shrestha Engineering Inc.
@stop

@section('content')

    <section class="page-title" style="background-image:url({{asset('images/background/5.jpg')}})">
        <div class="container">
            <h2>{{$project->title}}</h2>
            <ul class="page-breadcrumb">
                <li><a href="{{route('home')}}">home</a></li>
                <li><a href="{{route('projects')}}">Projects</a></li>
                <li>{{$project->title}}</li>
            </ul>
        </div>
    </section>

    <div class="bg-white">
        <div class="container">
            <div class="row">
                <div class="section-title pb-0">
                    <h3>{{$project->title}}</h3>
                </div>
                <div class="text pb-4">
                    {!! $project->description !!}
                </div>
                @foreach($project->images as $x=>$img)
                <div class="col-md-4 pb-4">
                    <a href="{{asset('images/projectImage/'.$img->image)}}" data-lightbox="{{$project->title}}" data-title="{{$project->title}}">
                    <img class="project-image" src="{{asset('images/projectImage/'.$img->image)}}">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@stop