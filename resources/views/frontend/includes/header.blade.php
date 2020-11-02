<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
    <link href="{{asset('css/all-css.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/lightbox.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body id="page-top">
<div id="preloader"></div>
<!--navbar-->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand page-scroll" href="#page-top">
                <h3 style="color: white; margin: 0px">Shrestha</h3>
                <h2 style="margin: 0px">
                    <small style="color: white">Engineering</small>
                </h2>
                {{--<img src="assets/img/logo.png" alt="logo" title="" />--}}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{route('home')}}">Home</a></li>
                <li class="{{ Request::is('about*') ? 'active' : '' }}"><a href="{{route('about')}}">About us</a></li>
                <li class="{{ Request::is('service*') ? 'active' : '' }}"><a href="{{route('services')}}">Services</a></li></li>
                <li class="{{ Request::is('project*') ? 'active' : '' }}"><a href="{{route('projects')}}">Projects</a></li></li>
                <li class="{{ Request::is('contact*') ? 'active' : '' }}"><a href="{{route('contact')}}">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<!--navbar-->