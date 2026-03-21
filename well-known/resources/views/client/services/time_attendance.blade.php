

@extends('client.layout.app')
@section('title')
    Biometric Time and Attendance System
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
                <h2>Biometric Time and Attendance System</h2>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Service Details Start-->
    <section class="service-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="service-details__right">
                        <div class="service-details__img">
                            <iframe width="750" height="450" src="https://www.youtube.com/embed/jbP2qyRYBzs" title="Biometrics Attendance System In Kenya" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="service-details__content">
                            <div class="service-details__benefits">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="service-details__benefits-text">
                                            <h3 class="service-details__benefits-title">Our Time Attendance systems can be scaled by integrating with Biometric access Controls.</h3>
                                            <p class="service-details__benefits-text">Our time Time and attendance system.</p>
                                            <ul class="list-unstyled service-details__benefits-list">
                                                <li>
                                                    <div class="icon">
                                                        <span class="fa fa-check"></span>
                                                    </div>
                                                    <div class="text">
                                                        <p>Gives out output in excel</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <span class="fa fa-check"></span>
                                                    </div>
                                                    <div class="text">
                                                        <p>Gives out output in PDF</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <span class="fa fa-check"></span>
                                                    </div>
                                                    <div class="text">
                                                        <p>Can be integrated to any Payroll System</p>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="service-details__benefits-img">
                                            <img src="{{asset('assets/images/resources/service-details__benefits-img-3.jpg')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="service-details__text-2">Responsive web design is the practice of designing a page or site with a dynamically changing appearance or layout based on the screen size of the person’s device.
                            </p>

                            ZKTeco is a globally recognized leader in biometric verifications offering a wide range of products spanning three industries including Biometric Verification Core Technique Empowerment, Smart Entrance & Exit “Person + Car + Object” Software Platform Empowerment. All ZKTeco products that we retail are original and of the best quality and also readily available for integration with your existing Payroll and HR system..</p>
                        </div>


                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="service-details__sidebar">
                        <div class="service-details__sidebar-service">
                            <h4 class="service-details__sidebar-title">Our Services</h4>
                            <ul class="service-details__sidebar-service-list list-unstyled">
                                <li><a href="{{route('web_design')}}">Modern Web Design <span class="icon-right-arrow"></span></a>
                                </li>
                                <li><a href="{{route('e_commerce')}}">E-Commerce <span
                                            class="icon-right-arrow"></span></a></li>
                                <li><a href="{{route('mpesa_integration')}}">Lipa Na Mpesa Integration <span
                                            class="icon-right-arrow"></span></a></li>
{{--                                <li><a href="">School Management System <span class="icon-right-arrow"></span></a>--}}
{{--                                </li>--}}
                                <li><a href="{{route('time_attendance')}}">Time & Attendance System <span class="icon-right-arrow"></span></a>
                                </li>
                                <li><a href="#">ISP Management & Billing System <span
                                            class="icon-right-arrow"></span></a></li>
                                <li><a href="{{route('branding_digital')}}">Identity <span
                                            class="icon-right-arrow"></span></a></li>


                            </ul>
                        </div>
                        <div class="service-details__need-help">
                            <div class="service-details__need-help-bg"
                                 style="background-image: url(assets/images/backgrounds/service-details-need-help-bg.jpg)">
                            </div>
                            <div class="service-details__need-help-bg-overly"></div>
                            <div class="service-details__need-help-icon">
                                <img src="{{asset('assets/images/shapes/phone-icon.png')}}" alt="">
                            </div>
                            <h2 class="service-details__need-help-text-box">Schedule a 30-Minute Meeting With Our Time and Attendance  Professionals</h2>
                            <div class="service-details__need-help-contact">
                                <a href="tel:254710909198">+254 710 909 198</a>
                                <p>Contact us<br>today</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Service Details End-->

@endsection
