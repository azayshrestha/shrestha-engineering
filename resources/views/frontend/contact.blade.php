@extends('frontend.includes.layout')

@section('title')
    Shrestha Engineering Inc.
@stop

@section('content')

    <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('images/background/5.jpg')}})">
        <div class="container">
            <h2>Contact Us</h2>
            <ul class="page-breadcrumb">
                <li><a href="{{route('home')}}">home</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
    <section>
        <div class="container">
            <div class="section-title">
                <h3>CONTACT US</h3>
                <h4>Have any Questions? We'd love to hear from you.</h4>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <form action="{{route('send-mail')}}" method="post">
                            {{@csrf_field()}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control input-border" placeholder="Name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control input-border" placeholder="Email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control input-border" placeholder="Subject" name="subject" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <textarea rows="5" class="form-control input-border" placeholder="Enter Your Message" name="message" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg mt-4">SEND NOW</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 text">
                    <div class="card pl-4">
                        <div class="card-body pt-0">
                            @if($contact)
                                <h3 style="margin-top: 0px">{{$contact->organization}}</h3>
                                <div class="">
                                    <ul class="contact-info-list">
                                        <li><strong>Address :</strong><br>{{$contact->address}}</li>
                                    </ul>
                                    <ul class="contact-info-lis">
                                        <li><strong>Phone : </strong><br>{{$contact->contact}}</li>
                                        <li><strong>Email : </strong><br>{{$contact->email}}</li>
                                    </ul>
                                    <ul class="contact-info-list">
                                        <li><strong>Opening Hours :</strong><br>8:00 AM – 10:00 PM <br> Monday – Sunday</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($contact && $contact->map_url)
        <iframe src="{{$contact->map_url}}" width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    @endif
@stop

@section('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        $(document).ready(function (){
            @if(session('success'))
            $.alert({
                title: 'Thank You!',
                content: 'For Contacting Us! We have received your message.',
            });
            @endif
        })
    </script>
@stop
