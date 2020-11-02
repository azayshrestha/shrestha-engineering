@extends('frontend.includes.layout')

@section('title')
    Shrestha Engineering Inc.
@stop

@section('content')

    <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('images/background/5.jpg')}})">
        <div class="container">
            <h2>Our Services</h2>
            <ul class="page-breadcrumb">
                <li><a href="{{route('home')}}">home</a></li>
                <li>Services</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <section class="p-30">
        <div class="container">
            <div class="row">
                @if($services)
                    @foreach($services as $key=>$service)
                        @if($key == 0 || $delay == 750)
                            @php  $delay = 250 @endphp
                        @else
                            @php  $delay = $delay + 250 @endphp
                        @endif
                        <div class="col-md-4 col-sm-12">
                            <div class="card wow fadeInUp animated" data-wow-delay="{{$delay}}ms" data-wow-duration="1500ms">
                                <img class="card-img-top service-card-image img-hover" src="{{asset('images/serviceImage/'.$service->image)}}">
                                <div class="card-body px-2 mb-2">
                                    <h3>{{$service->title}}</h3>
                                    <a href="{{route('service',$service->slug)}}" class="btn btn-primary">
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