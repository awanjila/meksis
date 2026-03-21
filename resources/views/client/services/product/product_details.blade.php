@extends('client.layout.app')
@section('title')
    Drip  Experts | Find the best experts in Drip Irrigation | Sprinkler Irrigation | Green House  Construction In Kenya | {{$product->name}}
@endsection
<!-- subheader -->
@section('content')
<!-- content begin -->


<!--Page Header Start-->
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg);">
    </div>
    <div class="page-header__shape-1"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Project Details</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="/">Home</a></li>
                <li class="active">{{$product->name}}</li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--Project Details Start-->
<section class="project-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="project-details__banner">
                    <div class="project-details__banner-img">
                        <img src="/product_image/{{$product->product_image}}" alt="">
                    </div>
                    <ul class="project-details__points list-unstyled">
                        <li>
                            <div class="icon">
                                <span class="icon-user"></span>
                            </div>
                            <div class="text">
                                <h3 class="project-details__points-title">{{$product->client}}</h3>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="icon-folder"></span>
                            </div>
                            <div class="text">
                                <h3 class="project-details__points-title">Project</h3>
                                <p class="project-details__points-sub-title">{{$product->name}}</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="icon-calendar"></span>
                            </div>
                            <div class="text">
                                <h3 class="project-details__points-title">Date</h3>
                                <p class="project-details__points-sub-title">August 20, 2022</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="icon-link"></span>
                            </div>
                            <div class="text">
                                <h3 class="project-details__points-title">Link</h3>
                                <p class="project-details__points-sub-title"><a href="#">{{$product->url  }}</a>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="project-details__content-box">
                    <h3 class="project-details__title">Project Overview</h3>
                    <p class="project-details__text project-details__text-1">{{$product->description  }}</p>

                    <div class="project-details__img-box">
                        <div class="project-details__img-1">
                            <img src="{{asset('product_images/'.$more_images[1]->body_image)}}" alt="">
                        </div>
                        <div class="project-details__img-2">
                            <img src="{{asset('product_images/'.$more_images[0]->body_image)}}" alt="">
                        </div>
                    </div>
                    <div class="project-details__bottom">
                        <h3 class="project-details__bottom-title">Have any project in mind</h3>
                        <div class="project-details__bottom-btn-box">
                            <a href="https://wa.me/254781312070" class="project-details__bottom-btn thm-btn">Do you want to work with
                                us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Project Details End-->
@endsection
