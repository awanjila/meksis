
@extends('client.layout.app')
@section('title')
   Modern Web Design & Development in Kenya
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
            <h2>Web Design & Development in Kenya</h2>
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
                        <img src="{{asset('assets/images/resources/modern_web_design_in_kenya.jpg')}}" alt="">
                    </div>
                    <div class="service-details__content">
                        <div class="service-details__benefits">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="service-details__benefits-text">
                                        <h3 class="service-details__benefits-title">Modern web development is both a set of tools and a way of thinking.</h3>
                                        <p class="service-details__benefits-text">These are the core elements of modern web development in 2021.</p>
                                        <ul class="list-unstyled service-details__benefits-list">
                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check"></span>
                                                </div>
                                                <div class="text">
                                                    <p>Mobile-Friendly Layout</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check"></span>
                                                </div>
                                                <div class="text">
                                                    <p>Light and optimized for speed</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check"></span>
                                                </div>
                                                <div class="text">
                                                    <p>High-quality Images</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check"></span>
                                                </div>
                                                <div class="text">
                                                    <p>Typography and fonts that uniquely identify you.</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="service-details__benefits-img">
                                        <img src="{{asset('assets/images/resources/modern_web_design_in_kenya_2.jpg')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="service-details__text-2">Responsive web design is the practice of designing a page or site with a dynamically changing appearance or layout based on the screen size of the person’s device.
                        </p>

                        <p> In 2021 responsive web design is one of the most essential tools for anyone with a digital presence.
                            </p>
                        <p>This practice ensures users will have good viewing experience no matter what type of device they’re using.
                            Perhaps that's why it's so surprising, when users are turning more and more to mobile devices and tablets,
                            to find websites that continue to suffer from non-responsive web designs. .</p>

                        <p>We offer our modern web design services all over Kenya, in We have clients in Nakuru, Mombasa, Eldoret, Kisumu and
                            Nanyuki. In  East and Central Africa, Uganda, Tanzania, Rwanda,  Burundi and Congo</p>
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
                            <li><a href="it-consultancy.html">E-Commerce <span
                                        class="icon-right-arrow"></span></a></li>
                            <li><a href="cloud-computing.html">Lipa Na Mpesa Integration <span
                                        class="icon-right-arrow"></span></a></li>
                            <li><a href="">School Management System <span class="icon-right-arrow"></span></a>
                            </li>
                            <li><a href="{{route('web_design')}}">Time & Attendance System <span class="icon-right-arrow"></span></a>
                            </li>
                            <li><a href="it-consultancy.html">ISP Management & Billing System <span
                                        class="icon-right-arrow"></span></a></li>
                            <li><a href="cloud-computing.html">Branding <span
                                        class="icon-right-arrow"></span></a></li>
                            <li><a href="cloud-computing.html">Digital Marketing <span
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
                        <h2 class="service-details__need-help-text-box">Schedule a 30-Minute Meeting With Our Web Design  Professionals</h2>
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
