@extends('frontend.includes.layout')

@section('title')
    Shrestha Engineering Inc.
@stop

@section('content')

    <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('images/background/5.jpg')}})">
        <div class="container">
            <h2>{{$service->title}}</h2>
            <ul class="page-breadcrumb">
                <li><a href="{{route('home')}}">home</a></li>
                <li><a href="{{route('services')}}">Services</a></li>
                <li>{{$service->title}}</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!--Sidebar Page Container-->
    <div class="bg-white">
        <div class="container">
            <div class="row">

                <!--Content Side / Services Detail -->
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <img src="{{asset('images/serviceImage/'.$service->image)}}" width="100%" class="pt-4">
                    <div class="text py-4">
                        {!! $service->content !!}
                    </div>
                    <br>
                    <div class="section-title">
                        <h3>Write Your review</h3>
                        <h4>Please let us know how we are doing and share your experience with others.</h4>
                    </div>
                    <div class="row">
                        <form action="{{route('service-review', $service->id)}}" method="post">
                            {{csrf_field()}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="review" placeholder="Review"></textarea>
                                <div class="row py-3">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                    <input type="number" id="rating" name="rating" hidden>
                                    Rate our Service
                                    <div class="star-rating">
                                        <div class="fa fa-star" id="star-1"></div>
                                        <div class="fa fa-star" id="star-2"></div>
                                        <div class="fa fa-star" id="star-3"></div>
                                        <div class="fa fa-star" id="star-4"></div>
                                        <div class="fa fa-star" id="star-5"></div>
                                    </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <button class="btn btn-primary btn-xl" style="float: right; clear: both">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="reviews">
                                @foreach($reviews as $review)
                                <div class="review">
                                    @if($review->name) {{$review->name}} @else Web Admin @endif
                                    <div class="star-rating" style="float: right">
                                        @for($i=1; $i<6; $i++)
                                            @if($i<=$review->rating)
                                                <div class="fa fa-star" style="color: #ffb500"></div>
                                            @else
                                                <div class="fa fa-star" style="color: lightgray"></div>
                                            @endif
                                        @endfor
                                    </div>
                                    <p>{{$review->review}}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <nav class="vertical py-4">
                        <ul class="nav nav-pills nav-stacked service-menu">
                        @foreach($services as $list)
                        <li class="@if($service->id == $list->id) active @endif">
                            <a href="{{route('service',$list->slug)}}">{{$list->title}}</a>
                        </li>
                        @endforeach
                        </ul>
                    </nav>
                    <div style="margin-top: 10px" ontouchstart="this.classList.toggle('hover');">
                        <div class="container-x">
                            <div class="front" style="background-image: url({{asset('images/background/7.jpg')}}">
                                <div class="inner">
                                    <p style="color: white !important;">Have Some Questions?</p>
                                </div>
                            </div>
                            <div class="back">
                                <div class="inner">
                                    <a class="tz-readmore" href="{{route('contact')}}">CONTACT US<i class="fa fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        $(document).ready(function (){
            @if(session('success'))
                $.alert({
                    title: 'Thank You!',
                    content: 'For Sharing Your Review!',
                });
            @endif
            for(let i=1; i<6; i++){
                $('#star-'+i).click( function () {
                    $('#rating').val(i);
                    for(let y=1; y<6; y++){
                        if(y<=i){
                            $('#star-'+y).css('color', '#ffb500');
                        }else{
                            $('#star-'+y).css('color', 'lightgray');
                        }
                    }
                })
                $('#star-'+i).mouseover(function () {
                    for(let y=1; y<6; y++){
                        if(y<=i){
                            $('#star-'+y).css('color', '#ffb500');
                        }else{
                            $('#star-'+y).css('color', 'lightgray');
                        }
                    }
                })
                $('#star-'+i).mouseleave(function () {
                    $rating = $('#rating').val();
                    for(let y=1; y<6; y++){
                        if(y<=$rating){
                            $('#star-'+y).css('color', '#ffb500');
                        }else{
                            $('#star-'+y).css('color', 'lightgray');
                        }
                    }
                })
            }
        })
    </script>
@stop
