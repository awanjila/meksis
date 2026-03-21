@extends('client.layout.app')
@section('title')
    Wabestudio Web Design | Our Solutions
@endsection

@section('content')

     <!-- subheader -->
        <section id="subheader" data-speed="8" data-type="background">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Our Products</h1>
                        <ul class="crumb">
                            <li><a href="/">Home</a></li>
                            <li class="sep">/</li>
                            <li>Our Products</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- subheader close -->

        <!-- content begin -->
        <div id="content">
            <div class="container">

                <div class="spacer-single"></div>

                <!-- portfolio filter begin -->
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <ul id="filters" class="wow fadeInUp" data-wow-delay="0s">--}}
{{--                            <li><a href="#" data-filter=".residential">Residential</a></li>--}}
{{--                            <li><a href="#" data-filter=".hospitaly">Hospitaly</a></li>--}}
{{--                            <li><a href="#" data-filter=".office">Office</a></li>--}}
{{--                            <li><a href="#" data-filter=".commercial">Commercial</a></li>--}}
{{--                            <li class="pull-right"><a href="#" data-filter="*" class="selected">All Projects</a></li>--}}
{{--                        </ul>--}}

{{--                    </div>--}}
{{--                </div>--}}
                <!-- portfolio filter close -->

                <div id="gallery" class="row gallery full-gallery de-gallery pf_4_cols wow fadeInUp" data-wow-delay=".3s">
@foreach ($products as $product)
                    <!-- gallery item -->
                    <div class="col-md-4 col-sm-6 col-xs-12 item mb30 residential">
                        <div class="picframe">
                            <a class="simple-ajax-popup-align-top" href="{{ route('show.product',$product->slug) }}">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">{{$product->name}}</span>
                                    </span>
                                </span>
                            </a>
                            <img src="/product_image/{{$product->product_image}}" alt="{{$product->name}}" />
                        </div>
                    </div>
                    <!-- close gallery item -->
                    @endforeach


                </div>
            </div>
        </div>

@endsection
