@extends('client.layout.app')
@section('title')
    Wabestudio Web Design | {{$product->name}}
@endsection
<!-- subheader -->
@section('content')
<!-- content begin -->
        <div id="content" class="no-top no-bottom mt70 sm-mt0">

            <section class="no-top no-bottom">
                <div class="container-float">
                    <div class="row align-items-center g-0">
                        <div class="col-md-12">
                            <div id="gallery-carousel-2" class="owl-carousel owl-theme owl-slide">


                                <!-- gallery item -->
                                <div class="item">
                                    <div class="picframe">
                                        <a class="image-popup-no-margins" href="/product_image/{{$product->product_image}}">
                                            <span class="overlay-v">
                                                <span class="pf_text">
                                                    <span class="project-name">{{$product->name}}</span>
                                                </span>
                                            </span>
                                            <img src="/product_image/{{$product->product_image}}" alt="" width="200" height="200">
                                        </a>

                                    </div>

                                </div>
                                <!-- close gallery item -->

                                <!-- gallery item -->
                                <div class="item">
                                    <div class="picframe">
                                        <a class="image-popup-no-margins" href="{{asset('product_images/'.$more_images[0]->body_image)}}">
                                            <span class="overlay-v">
                                                <span class="pf_text">
                                                    <span class="project-name">{{$product->name}}</span>
                                                </span>
                                            </span>
                                            <img src="{{asset('product_images/'.$more_images[0]->body_image)}}" alt="" class="img-fluid" width="193" height="130">
                                        </a>


                                    </div>
                                </div>
                                <!-- close gallery item -->

                                <!-- gallery item -->
                                <div class="item">
                                    <div class="picframe">
                                        <a class="image-popup-no-margins" href="{{asset('product_images/'.$more_images[2]->body_image)}}">
                                            <span class="overlay-v">
                                                <span class="pf_text">
                                                    <span class="project-name">Details</span>
                                                </span>
                                            </span>
                                            <img src="{{asset('product_images/'.$more_images[2]->body_image)}}" alt="" class="img-fluid" width="200" height="200">
                                        </a>


                                    </div>
                                </div>
                                <!-- close gallery item -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-color text-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="mb0">{{$product->name}}</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="row">

                        <div class="col-md-6">
                            <h3>Product Brief</h3>
                            <p>
                                {{$product->description  }}
                            <img src="{{asset('product_images/'.$more_images[1]->body_image)}}" alt="" class="img-fluid" width="2000" height="200">
                        </div>


                        <div class="col-md-4">
                            <h3>Product Details</h3>
                                <div class="project-details">
                                    <div class="info-text">
                                        <span class="title">Date</span>
                                        <span class="val">March 2019</span>
                                    </div>

                                    <div class="info-text">
                                        <span class="title">Timeline</span>
                                        <span class="val">2 weeks</span>
                                    </div>

                                    <div class="info-text">
                                        <span class="title">Client</span>
                                        <span class="val">{!! $product->client !!}</span>
                                    </div>

                                    <div class="info-text">
                                        <span class="title">Category</span>
                                        <span class="val">Product Design</span>
                                    </div>

                                    <div class="info-text">
                                        <a href="#" class="btn-custom text-light">Demo</a>
{{--                                        <a href="{{$product->url}}" class="btn-custom text-light">Demo</a>--}}
                                    </div>
                            </div>
                        </div>
                </div>
            </section>
        </div>
@endsection
