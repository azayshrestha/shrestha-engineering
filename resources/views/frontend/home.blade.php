@extends('frontend.includes.layout')

@section('title')
    Shrestha Engineering Inc.
@stop

@section('content')
    @if($sliders)
    <header id="myCarousel" class="carousel slide ">
        <div class="carousel-inner carousel-fade">
            @foreach($sliders as $key=>$slider)
            <div class="item @if($key == 0) active @endif">
                <div class="fill" style="background-image:url({{asset('images/sliderImage/'.$slider->image)}});">
                    <div class="header-content">
                        <h2 class="wow slideInDown" data-wow-duration="1s" data-wow-delay="1s">{{$slider->title}}</h2>
                        <div class="wow fadeIn" data-wow-duration="1.5s" data-wow-delay="1.5s">{{$slider->description}}</div>
                        @if($slider->url)
                            <div class="btns-box">
                                <a href="{{$slider->url}}" class="btn btn-primary btn-xl wow fadeIn" data-wow-duration="2s" data-wow-delay="2s">
                                    <span class="txt">Know more</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="icon-prev"></span> </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="icon-next"></span> </a>
    </header>
    @endif

    @if($about)
        <section class="about-section">
            <div class="container content-column">
                <div class="col-md-12">
                    <div class="section-title wow fadeInDown">
                        <h3>ABOUT US</h3>
                        <h4>WHO WE ARE</h4>
                    </div>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <a href="{{asset('images/serviceImage/'.$about->image)}}" data-lightbox="about">
                    <img class="img-fluid wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s" src="{{asset('images/serviceImage/'.$about->image)}}" alt="">
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="inner-column wow fadeInRight" data-wow-duration="1s" data-wow-delay="1s">
                        <div class="content-box">
                            <div class="text">
                                {{substr(strip_tags($about->content),0, 320)}}...
                            </div>
                            <div class="link-box"><a href="{{route('about')}}" class="btn btn-primary">About Us</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    @endif


    @if($services)
        <section class="what-we" id="about" style="background: #234070 !important;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow fadeInDown">
                        <div class="section-title">
                            <h3>SERVICES</h3>
                            <h4>WHAT WE DO OFFER</h4>
                        </div>
                    </div>
                    {{--<div class="col-md-6 text-right">--}}
                        {{--<a href="" class="btn btn-primary">View More</a>--}}
                    {{--</div>--}}
                </div>
                <div class="row">
                    <div class="container">
                        @foreach($services as $key=>$service)
                            @if($key == 3)
                                @break
                            @endif
                            @if($key < 3)
                                @if($key == 0 || $delay == 900)
                                    @php  $delay = 300 @endphp
                                @else
                                    @php  $delay = $delay + 300 @endphp
                                @endif
                                <div class="col-md-4 wow fadeInLeft" style="margin-top: 10px" ontouchstart="this.classList.toggle('hover');" data-wow-delay="{{$delay}}ms" data-wow-duration="1500ms">
                                    <div class="container-x">
                                        <div class="front" style="background-image: url({{asset('images/serviceImage/'.$service->image)}}">
                                            <div class="inner">
                                                <p style="color: white !important;">{{$service->title}}</p>
                                            </div>
                                        </div>
                                        <div class="back">
                                            <div class="inner">
                                                <p>{{substr(strip_tags($service->content),0, 140)}}...</p>
                                                <a class="tz-readmore" href="{{route('service', $service->slug)}}">READ MORE<i class="fa fa-caret-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($projects)
        <section id="blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3>Latest Projects</h3>
                            <h4>WHAT WE'VE DONE</h4>
                        </div>
                    </div>
                </div>
                <div class="blog-posts">
                    <div class="row">
                        @foreach($projects as $key=>$project)
                            @if($key == 0 || $delay == 900)
                                @php  $delay = 300 @endphp
                            @else
                                @php  $delay = $delay + 300 @endphp
                            @endif
                            <div class="col-md-4">
                                <div class="post-thumb wow fadeInDown" data-wow-delay="{{$delay}}ms" data-wow-duration="1500ms">
                                    <div id="post-carousel-{{$key}}" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($project->images as $x=>$img)
                                                <div class="item @if($x == 0) active @endif">
                                                    <a href="{{route('project', $project->slug)}}">
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
                                <div class="entry-header">
                                    <h3><a href="">{{$project->title}}</a></h3>
                                </div>
                                <div class="entry-content">
                                    <p><a href="{{route('project', $project->slug)}}" class="btn btn2 hvr-sweep-to-right">Know more</a></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{--<div class="col-md-6 text-right">--}}
                    {{--<a href="" class="btn btn-primary">View More</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </section>
    @endif
    @if(count($testimonials)>0)
    <section id="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3>TESTIMONIALS</h3>
                        <h4>WHAT CLIENTS ARE SAYING ABOUT US</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card border">
                        <div class="card-body">
                            <div id="testimonial" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner text-center">
                                    @foreach($testimonials as $key=>$testimonial)
                                    <div class="item @if($key==1) active @endif">
                                        <div class="testimonial">
                                            <div class="testimonial-body" style="height: 250px !important; overflow-y: auto">
                                                <p>{{$testimonial->description}}</p>
                                                <i class="fas fa-quote-right"></i>
                                            </div>
                                            <div class="testimonial-footer">
                                                <img src="{{asset('images/testimonialImage/'.$testimonial->image)}}" alt="user" />
                                                <h3>{{$testimonial->name}}</h3>
                                                <h4>{{$testimonial->organization}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <a class="blog-left-control" href="#testimonial" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="blog-right-control" href="#testimonial" role="button" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <section style="background-color: #f2f2f2; padding: 20px">
        <div class="section-title">
            <h3>Why not Say "Hi" to us!</h3>
            <div class="btns-box">
                <a href="{{route('contact')}}" class="btn btn-primary btn-xl">
                    <span class="txt"><i class="fa fa-paper-plane"></i> Contact Us</span>
                </a>
            </div>
        </div>
    </section>
@stop