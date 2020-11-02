@extends('frontend.includes.layout')

@section('title')
    Shrestha Engineering Inc.
@stop

@section('content')

<!--Page Title-->
<section class="page-title" style="background-image:url({{asset('images/background/5.jpg')}})">
    <div class="container">
        <h2>About us</h2>
        <ul class="page-breadcrumb">
            <li><a href="{{route('home')}}">home</a></li>
            <li>About us</li>
        </ul>
    </div>
</section>
<!--End Page Title-->

<!-- Story Section -->
<section class="p-30">
    <div class="container py-3">
        <div class="row">
            @if($about)
            <!-- Content Column -->
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="wow fadeInLeft text" data-wow-delay='600ms'>
                    {!! $about->content !!}
                </div>
            </div>

            <div class=" col-lg-4 col-md-4 col-sm-12">
                <div class="card rounded wow fadeInRight" data-wow-delay='600ms'>
                    <a href="{{asset('images/serviceImage/'.$about->image)}}" data-lightbox="about">
                    <img class="img-fluid" src="{{asset('images/serviceImage/'.$about->image)}}" alt="" />
                    </a>
                </div>
            </div>
            @else
            <div class="col-lg-12 col-md-12 col-sm-12" style="min-height: 300px">
                <h3 align="center">Comming Soon</h3>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- End Story Section -->
@stop