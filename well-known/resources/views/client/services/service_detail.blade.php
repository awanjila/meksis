@extends('client.layout.app')
@section('title')
    Wabestudio Web Design | {{$service->name}}
@endsection
<!-- subheader -->
@section('content')
<section id="subheader" data-speed="8" data-type="background">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$service->name}}</h1>
                <ul class="crumb">
                    <li><a href="/">Home</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{route('service.index')}}">Services</a></li>
                    <li class="sep">/</li>
                    <li>{{$service->name}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- subheader close -->

<!-- content begin -->
<div id="content">
    <div class="container">
        <div class="row">
            <div id="sidebar" class="col-md-3 wow fadeInUp">
                <ul id="services-list">
                    @foreach($services as $shughuli)
                        <li class="@if ($loop->first) active @endif"><a href="{{ route('show.service',$shughuli->slug) }}">{{$shughuli->name}}</a></li>
                        @endforeach
                </ul>
            </div>



            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12 wow fadeInUp" data-wow-delay=".3s">
                        <p>{!! $service->description !!}.</p>
                    </div>
                    <div class="col-md-6 pic-services wow fadeInUp" data-wow-delay=".6s">
                        <img src="images/services/p3_a.jpg" class="img-responsive" alt="">
                        <img src="images/services/p3_b.jpg" class="img-responsive" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>



</div>

<section id="view-all-projects" class="call-to-action bg-color text-center" data-speed="5" data-type="background" aria-label="view-all-projects">
    <a href="contact.html" class="btn btn-line black btn-big">Get Quotation</a>
</section>
@endsection
