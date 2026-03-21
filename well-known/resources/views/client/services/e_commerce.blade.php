
@extends('client.layout.app')
@section('title')
    E-Commerce Website development in Kenya
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
                <h2>E-Commerce Website Development in Kenya</h2>
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
                            <img src="{{asset('assets/images/resources/e_commerce_development_in_kenya.jpg')}}" alt="">
                        </div>
                        <div class="service-details__content">
                            <div class="service-details__benefits">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="service-details__benefits-text">
                                            <h3 class="service-details__benefits-title">Traditional retail will be doomed to its inevitable extinction. It a matter of When.</h3>
                                            <p class="service-details__benefits-text">Online businesses are booming and rightly so – this year it is expected that 28% of all  retail purchases will occur online. That’s partly because eCommerce website development has got easy – almost anyone can do it. But hubris might be your downfall; there are a number of important things to consider before you choose a company to build
                                                your eCommerce website.
                                                This is especially true if you want customers to keep coming back to your site.</p>

                                            <p>At Wabestudio Here are 5 Important things we will consider before  developing your eCommerce website</p>
                                            <ul class="list-unstyled service-details__benefits-list">
                                                <li>
                                                    <div class="icon">
                                                        <span class="fa fa-check"></span>
                                                    </div>
                                                    <div class="text">
                                                        <p>Robust and Scalable Platform, We use Laravel & Vue Js</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <span class="fa fa-check"></span>
                                                    </div>
                                                    <div class="text">
                                                        <p>Clean, Simple and Modern Design</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <span class="fa fa-check"></span>
                                                    </div>
                                                    <div class="text">
                                                        <p>Your eCommerce website needs to be secure</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <span class="fa fa-check"></span>
                                                    </div>
                                                    <div class="text">
                                                        <p>SEO attracts organic traffic to your eCommerce site.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <span class="fa fa-check"></span>
                                                    </div>
                                                    <div class="text">
                                                        <p>Site Speed.</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="service-details__benefits-img">
                                            <img src="{{asset('assets/images/resources/e_commerce_development_in_kenya_2.jpg')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="service-details__text-2"> It is essential to understand that ecommerce is not limited to strictly the buying and selling of goods on a website.
                                It is the technique by which a website aids the business processes of a company or firm in a way that expedites the process and makes the entire exchange between the buyer and seller convenient and easy.
                                Our websites even provide a secure <a href="{{route('mpesa_integration')}}">**Payment Portal**</a> for our clients to use to buy our services. As expected, it is how almost all of our clients choose to complete their transactions with us..</p>
                            <p>We offer our Ecommerce Web Services services all over Kenya, in We have clients in Nakuru, Mombasa, Eldoret, Kisumu and
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
