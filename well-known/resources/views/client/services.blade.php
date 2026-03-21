@extends('client.layout.app')
@section('title')
    Wabestudio Web Services
@endsection

@section('content')
<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="page-header-bg-overly"></div>
    <div class="page-header-shape wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms"
         style="background-image: url(assets/images/shapes/page-header-shape.png)"></div>
    <div class="container">
        <div class="page-header__inner">
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="/">Home</a></li>
                <li><span>/</span></li>
                <li>Services</li>
            </ul>
            <h2>Wabestudio Services</h2>
        </div>
    </div>
</section>
<!--Page Header End-->


<!--Business Growth Start-->

<div class="container-fluid">
<section class="business-growth business-growth-two">
    <div class="business-growth__top">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="business-growth__left">
                        <div class="section-title text-left">

                            <h2 class="section-title__title">Business Growth in <br> IT Consulting Solutions
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="business-growth__right">
                        <p class="business-growth__right-text">"We are creative digital studio based in Nairobi Kenya, and we offer Web services that Include
                            Modern Web development & design, Custom Software that is tailored to your needs, and a
                            Creative Strategy for handling your online presence that will attract and maintain your clients. We are always happy to serve.
                            We are WABESTUDIO.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="business-growth__bottom">
            <div class="row">
                <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="100ms">
                    <!--Business Growth Single-->
                    <div class="business-growth__single">
                        <div class="business-growth__img">
                            <img src="assets/images/resources/business-growth-img-1.jpg" alt="">
                        </div>
                        <div class="business-growth__content">
                            <h4 class="business-growth__title">
                                <a href="{{route('web_design')}}">Modern Web Design & Development</a>
                            </h4>
                            <p class="business-growth__text">Great design helps you improve your sales numbers.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                    <!--Business Growth Single-->
                    <div class="business-growth__single">
                        <div class="business-growth__img">
                            <img src="assets/images/resources/business-growth-img-2.jpg" alt="">
                        </div>
                        <div class="business-growth__content">
                            <h4 class="business-growth__title">
                                <a href="/">Custom Software Solutions</a>
                            </h4>
                            <p class="business-growth__text">We help you meet unique and specific requirements at a cost competitive with purchasing.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 wow fadeInRight" data-wow-delay="300ms">
                    <!--Business Growth Single-->
                    <div class="business-growth__single">
                        <div class="business-growth__img">
                            <img src="assets/images/resources/business-growth-img-3.jpg" alt="">
                        </div>
                        <div class="business-growth__content">
                            <h4 class="business-growth__title">
                                <a href="/">Digital Marketing </a>
                            </h4>
                            <p class="business-growth__text">We employ several simple and yet effective strategies that make sure you cut through the noise and are seen and heard.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="100ms">
                    <!--Business Growth Single-->
                    <div class="business-growth__single">
                        <div class="business-growth__img">
                            <img src="assets/images/resources/business-growth-img-4.jpg" alt="">
                        </div>
                        <div class="business-growth__content">
                            <h4 class="business-growth__title">
                                <a href="{{route('e_commerce')}}">E-Commerce Development</a>
                            </h4>
                            <p class="business-growth__text">Traditional retail will be doomed to its inevitable extinction. It a matter of When..</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                    <!--Business Growth Single-->
                    <div class="business-growth__single">
                        <div class="business-growth__img">
                            <img src="assets/images/resources/business-growth-img-5.jpg" alt="">
                        </div>
                        <div class="business-growth__content">
                            <h4 class="business-growth__title">
                                <a href="{{route('contact')}}">School Management System</a>
                            </h4>
                            <p class="business-growth__text">.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 wow fadeInRight" data-wow-delay="300ms">
                    <!--Business Growth Single-->
                    <div class="business-growth__single">
                        <div class="business-growth__img">
                            <img src="assets/images/resources/business-growth-img-6.jpg" alt="">
                        </div>
                        <div class="business-growth__content">
                            <h4 class="business-growth__title">
                                <a href="{{route('time_attendance')}}">Time & Attendance Management Systems</a>
                            </h4>
                            <p class="business-growth__text">Our Time Attendance systems can be scaled by integrating with Biometric access Controls.</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="100ms">
                    <!--Business Growth Single-->
                    <div class="business-growth__single">
                        <div class="business-growth__img">
                            <img src="assets/images/resources/business-growth-img-8.jpg" alt="">
                        </div>
                        <div class="business-growth__content">
                            <h4 class="business-growth__title">
                                <a href="/">ISP Billing & Network Management Systems</a>

                            </h4>
                            <p class="business-growth__text">...</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                    <!--Business Growth Single-->
                    <div class="business-growth__single">
                        <div class="business-growth__img">
                            <img src="assets/images/resources/business-growth-img-7.jpg" alt="">
                        </div>
                        <div class="business-growth__content">
                            <h4 class="business-growth__title">
                                <a href="/">Branding</a>
                            </h4>
                            <p class="business-growth__text">....</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 wow fadeInRight" data-wow-delay="300ms">
                    <!--Business Growth Single-->
                    <div class="business-growth__single">
                        <div class="business-growth__img">
                            <img src="assets/images/resources/business-growth-img-9.jpg" alt="">
                        </div>
                        <div class="business-growth__content">
                            <h4 class="business-growth__title">
                                <a href="{{route('mpesa_integration')}}">Lipa Na Mpesa Intergration</a>
                            </h4>
                            <p class="business-growth__text">Let Your Customers Pay Directly to your Paybill from your Website..</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<!--Business Growth End-->

@endsection
