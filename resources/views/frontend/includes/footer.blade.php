<footer>
    <!--footer-div-->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="py-3">
                        {{--@if($about)--}}
                        {{--<small>--}}
                            {{--{{substr(strip_tags($about->content),0, 320)}}...<br>--}}
                            {{--<button class="btn btn-primary btn-sm">Read More</button>--}}
                        {{--</small>--}}
                        {{--@endif--}}
                        <div class="section-title">
                            <h3>SHRESTHA ENGINEERING</h3>
                            <div class="social-icons">
                                @if($about)
                                    @if($about->facebook)
                                        <a href="{{$about->facebook}}" class="py-3"><span class="fab fa-facebook-square"></span></a>
                                    @endif
                                    @if($about->instagram)
                                        <a href="{{$about->instagram}}"><span class="fab fa-instagram"></span></a>
                                    @endif
                                    @if($about->linkedin)
                                        <a href="{{$about->linkedin}}"><span class="fab fa-linkedin-in"></span></a>
                                    @endif
                                    @if($about->twitter)
                                        <a href="{{$about->twitter}}"><span class="fab fa-twitter"></span></a>
                                    @endif
                                    @if($about->google)
                                        <a href="mailto:{{$about->google}}"><span class="fab fa-google"></span></a>
                                    @endif
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h4 style="margin-bottom: 0">Quick Links</h4>
                            <small>
                                <ul style="padding-left: 20px !important; ">
                                    <a href="{{route('home')}}"><li> Home</li></a>
                                    <a href="{{route('about')}}"><li> About Us</li></a>
                                    <a href="{{route('services')}}"><li> Our Services</li></a>
                                    <a href="{{route('projects')}}"><li> Our Project</li></a>
                                    <a href="{{route('contact')}}"><li> Contact Us</li></a>
                                </ul>
                            </small>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            @if($services)
                            <h4 style="margin-bottom: 0">Services</h4>
                            <small>
                                <ul style="padding-left: 20px !important; ">
                                    @foreach($services as $key=>$service)
                                        @if($key == 6)
                                            @break
                                        @endif
                                        <a href="{{route('service', $service->slug)}}"><li> {{$service->title}}</li></a>
                                    @endforeach
                                </ul>
                            </small>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <h4 style="margin-bottom: 0">Contact Info</h4>
                    @if($contact)
                        <small>
                            <ul style="padding-left: 20px !important; ">
                                <div class="h4" style="margin-bottom: 0">{{$contact->organization}}</div>
                                <li>
                                    <span class="fa fa-location-arrow"></span> &nbsp;{{$contact->address}}
                                </li>
                                <li>
                                    <span class="fa fa-phone"></span> &nbsp;{{$contact->contact}}
                                </li>
                                <li>
                                    <span class="fa fa-envelope"></span> &nbsp;{{$contact->email}}
                                </li>
                            </ul>
                        </small>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <!--footer-div-->
    {{--<img src="{{asset('images/up.png')}}" height="50px" width="50px" class="go-top">--}}
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v8.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat" attribution=setup_tool page_id="107572014467492" theme_color="#234070"></div>
</footer>
<!-- jQuery -->
<script  src="{{asset('js/jquery-2.2.4.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/creative.min.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/lightbox.min.js')}}"></script>
<script>
if($('.wow').length){
    var wow = new WOW(
        {
            boxClass:     'wow',      // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset:       0,          // distance to the element when triggering the animation (default is 0)
            mobile:       false,       // trigger animations on mobile devices (default is true)
            live:         true       // act on asynchronously loaded content (default is true)
        }
    );
    wow.init();
}

$(document).ready(function() {
    // Show or hide the sticky footer button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('.go-top').fadeIn(200);
        } else {
            $('.go-top').fadeOut(200);
        }
    });

    // Animate the scroll to top
    $('.go-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, 300);
    })

});
</script>
@yield('script')
<!-- jQuery -->
</body>


</html>