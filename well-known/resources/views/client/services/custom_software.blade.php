@extends('client.layout.app')
@section('title')
   Custom Software development in Kenya
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
                <h2>Custom Software Development</h2>
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
{{--                        <div class="service-details__img">--}}
{{--                            <img src="{{asset('assets/images/resources/e_commerce_development_in_kenya.jpg')}}" alt="">--}}
{{--                        </div>--}}
                        <div class="service-details__content">
                            <div class="service-details__benefits">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="service-details__benefits-text">
                                            <h4 class="service-details__benefits-title">What is Custom Web Development?</h4>

                                            <p class="service-details__text-2"> Custom software development is the process of designing, creating, deploying and maintaining software for a specific set of users, functions or organizations.
                                                In contrast to commercial off-the-shelf software (COTS), custom software development aims at a narrowly defined set of requirements.
                                                COTS targets a broad set of requirements, allowing it to be packaged and commercially marketed and distributed</p>
                                            <p>
                                                <em>Microsoft Office</em>, for example, is a packaged commercial software products and services. It meets the generalized needs of office productivity and website creation.
<br>
                                                <em>Custom software</em>, on the other hand, is designed for a specific set of needs, such as:

                                                a broadcast messaging  program for a school or
                                                an attendance program that can differentiate staff and students.
                                                <p>Custom software, and its development, is also referred to as bespoke software. The term has its origins in old English and the tailoring trade. Think tailor-made suit.
                                            </p>
<br>
                                            <h4 class="service-details__benefits-title">What is Automation?</h4>
                                            <p>"Automation means that  business owners have the opportunity to unify their processes, evolving from disparate spreadsheets to one integrated, affordable system."</p>

                                            <h4 class="service-details__benefits-title">Why is custom software development important?</h4>
                                            <p class="service-details__text-2"> Custom software development is important because it helps meet unique requirements at a cost competitive with purchasing, maintaining and modifying commercial software.


<ul>
<li>Efficiency: Custom software is purpose-built to support processes swiftly and productively, without the need to tinker with or adjust COTS applications.</li>
<li>Scalability: Custom software can grow as an organization or business grows and changes. Designers and developers can assess future needs as part of their requirements gathering. These factors can then be incorporated into the application, rather than incurring costs by purchasing additional licenses or subscriptions of packaged applications.</li>
<li> Lower integration costs: One of the chief considerations of commercial software is: will it work with existing and legacy applications? If the answer is no, organizations face a further investment in getting commercial software to communicate and operate with their existing infrastructure. Custom software can be built to integrate with its intended environment.</li>
 <li>Profitability: It’s possible to make money with custom software development. Depending on the terms and conditions of the project, businesses that develop their own software may own the software and therefore be able to license or sell it to other organizations.</li>
<li>Independence: The benefits of being free of a commercial software vendor cut both ways. On the plus side, organizations can avoid price hikes for licensing and support — and getting stuck maintaining packaged software should the vendor go out of business or terminate a product. On the negative side, the cost of supporting and maintaining custom software falls to the organization that created it or had it developed. How the equation works out requires each organization to look carefully at whether it’s better to build or buy</li>
                                                </ul>

                                        </div>
                                    </div>

                                </div>
                            </div>


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
                                <li><a href="">School Management System <span class="icon-right-arrow"></span></a>
                                </li>
                                <li><a href="{{route('web_design')}}">Time & Attendance System <span class="icon-right-arrow"></span></a>
                                </li>
                                <li><a href="/">ISP Management & Billing System <span
                                            class="icon-right-arrow"></span></a></li>
                                <li><a href="/">Branding <span
                                            class="icon-right-arrow"></span></a></li>
                                <li><a href="/">Digital Marketing <span
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
                            <h2 class="service-details__need-help-text-box">Schedule a 30-Minute Meeting With Our E-Commerce  Professionals</h2>
                            <div class="service-details__need-help-contact">
                                <a href="tel:254710909198">+254 710 909 198</a>
                                <p>Contact us<br>today</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="news-details__social-list">
                    {{--                    <a href="https://twitter.com/intent/tweet?text={{$blog->name}}&url=https:/www.wabestudio.co.ke/blogs/{{$blog->slug}}"><i class="fab fa-twitter"></i></a>--}}
                    {{--                    <a href="https://www.facebook.com/sharer.php?u=https/www.wabestudio.co.ke/blogs/{{$blog->slug}}"><i class="fab fa-facebook"></i></a>--}}
                    {{--                    <a href="https://www.pinterest.com/pin-builder/?url=http:/www.wabestudio.co.ke/blogs/{{$blog->slug}}"><i class="fab fa-pinterest-p"></i></a>--}}
                    {{--                    <a href="https://www.linkedin.com/shareArticle?url=https:/www.wabestudio.co.ke/{{$blog->slug}}"><i class="fab fa-linkedin"></i></a>--}}
                    {{--                    <a href=""><i class="fab fa-whatsapp"></i></a>--}}




                </div>
            </div>
    </section>
    <!--Service Details End-->



@endsection

