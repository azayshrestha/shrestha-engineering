@extends('frontend.includes.layout')

@section('title')
    Shrestha Engineering Inc.
@stop

@section('content')

    <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('images/background/5.jpg')}})">
        <div class="container">
            <h2>Our Projects</h2>
            <ul class="page-breadcrumb">
                <li><a href="{{route('home')}}">home</a></li>
                <li>Projects</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <section class="p-30">
        <div class="container">
            <div class="row">
                @if($projects)
                    @foreach($projects as $key=>$project)
                        @if($key == 0 || $delay == 750)
                            @php  $delay = 250 @endphp
                        @else
                            @php  $delay = $delay + 250 @endphp
                        @endif
                        <div class="col-md-4 col-sm-12">
                            <div class="card wow fadeInUp animated" data-wow-delay="{{$delay}}ms" data-wow-duration="1500ms">
                                <div class="post-thumb">
                                    <div id="post-carousel-{{$key}}" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($project->images as $x=>$img)
                                                <div class="item @if($x == 0) active @endif">
                                                    <a href="">
                                                        <img class="img-responsive" src="{{asset('images/projectImage/'.$img->image)}}" style="width: 100%; height: 200px; object-fit: cover"/>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="post-meta">@if($project->service) {{$project->service['title']}} @endif</div>
                                        <a class="blog-left-control" href="#post-carousel-{{$key}}" role="button" data-slide="prev">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                        <a class="blog-right-control" href="#post-carousel-{{$key}}" role="button" data-slide="next">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body px-2 mb-2">
                                    <h3>{{$project->title}}</h3>
                                    <a href="{{route('project',$project->slug)}}" class="btn btn-primary">
                                        Read more <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="content-column col-lg-12 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <h3 align="center">Comming Soon</h3>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>
@stop

@section('script')
   <script>
       $(document).ready(function () {
           lightbox.option({
               'maxWidth': 500,
           })
       })
   </script>
@stop