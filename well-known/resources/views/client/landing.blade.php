@extends('client.layout.app')
@section('title')
Wabestudio Web Design, Custom Software Development and Creative digital strategy in Kenya
@endsection

@section('content')


    <!-- content begin -->
    <div id="content" class="no-bottom no-top">

        <!-- revolution slider begin -->
        <section id="section-slider" class="fullwidthbanner-container" aria-label="section-slider">
            <div id="revolution-slider">
                <ul>
                    <li data-transition="fade" data-slotamount="10" data-masterspeed="200" data-thumb="">
                        <!--  BACKGROUND IMAGE -->
                        <img src="images-webstudio/slider/wide1.jpg" alt="" />
                        <div class="tp-caption big-white sft" data-x="0" data-y="150" data-speed="800" data-start="400" data-easing="easeInOutExpo"
                             data-endspeed="450">
                            Improve the perception of your business
                        </div>

                        <div class="tp-caption ultra-big-white customin customout start" data-x="0" data-y="center" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:2;scaleY:2;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.85;scaleY:0.85;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-speed="800" data-start="400" data-easing="easeInOutExpo" data-endspeed="400">
                            Modern  <span class="id-color">Web Solutions</span>
                        </div>

                        <div class="tp-caption sfb" data-x="0" data-y="335" data-speed="400" data-start="800" data-easing="easeInOutExpo">
                            <a href="show_service/modern_website_design_kenya" class="btn-slider">See Solution
                            </a>
                        </div>
                    </li>

                    <li data-transition="fade" data-slotamount="10" data-masterspeed="200" data-thumb="">
                        <!--  BACKGROUND IMAGE -->
                        <img src="images-webstudio/slider/wide2.jpg" alt="" />
                        <div class="tp-caption big-white sft" data-x="center" data-y="160" data-speed="800" data-start="400" data-easing="easeInOutExpo"
                             data-endspeed="450">
                           Automation Frees up Your Time, Money & Resources
                        </div>

                        <div class="tp-caption ultra-big-white customin customout start" data-x="center" data-y="center" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:2;scaleY:2;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.85;scaleY:0.85;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-speed="800" data-start="400" data-easing="easeInOutExpo" data-endspeed="400"> Custom Software
                           <span class="id-color">Development</span>
                        </div>

                        <div class="tp-caption sfb" data-x="center" data-y="335" data-speed="400" data-start="800" data-easing="easeInOutExpo">
                            <a href="{{route('product.index')}}" class="btn-slider">See Products
                            </a>
                        </div>
                    </li>
                    <li data-transition="fade" data-slotamount="10" data-masterspeed="200" data-thumb="">
                        <!--  BACKGROUND IMAGE -->
                        <img src="images-webstudio/slider/wide3.jpg" alt="" />
                        <div class="tp-caption big-white sft" data-x="0" data-y="150" data-speed="800" data-start="400" data-easing="easeInOutExpo"
                             data-endspeed="450">
                            stand out even in a saturated market
                        </div>

                        <div class="tp-caption ultra-big-white customin customout start" data-x="0" data-y="center" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:2;scaleY:2;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.85;scaleY:0.85;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-speed="800" data-start="400" data-easing="easeInOutExpo" data-endspeed="400">
                            Branding & <span class="id-color">Digital Marketing</span>
                        </div>

                        <div class="tp-caption sfb" data-x="0" data-y="335" data-speed="400" data-start="800" data-easing="easeInOutExpo">
                            <a href="show_service/branding_digital_marketing_kenya" class="btn-slider">See Solution
                            </a>
                        </div>
                    </li>

                </ul>
            </div>
        </section>
        <!-- revolution slider close -->

        <!-- section begin -->
        <section id="section-about">
            <div class="wm wow fadeIn">01</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center wow fadeInUp">
                        <h5 class="s2 id-color">We Love</h5>
                        <h1>What We Do</h1>
                        <div class="separator"><span><i class="fa fa-circle"></i></span></div>
                        <div class="spacer-single"></div>
                  </div>
                    @foreach(\Illuminate\Support\Facades\DB::table('services')->inRandomOrder()->take(3)->get() as $service)
                    <div class="col-md-4 wow fadeInRight" data-wow-delay=".4s">
                        <a  href="{{ route('show.service',$service->slug) }}">
                            <img src="/cover_image/{{$service->cover_image}}" class="img-responsive" alt="{{$service->name}}">
                        </a>
                        <div class="spacer20"></div>
                        <h3><span class="id-color" href="{{ route('show.service',$service->slug) }}">{{$service->name}}</h3>
                        {!!substr($service->description,0,200)!!}....

                    </div>
                        @endforeach

                </div>
            </div>
        </section>
        <!-- section close -->


        <!-- section begin -->
        <section id="section-testimonial-coworking" data-bgimage="url(images-webstudio/bg/1.jpg)" class="text-light" data-stellar-background-ratio=".1">
            <div class="container">
                <div class="row">

                    <div class="col-md-8 offset-md-2">

                        <div id="testimonial-carousel-single" class="owl-carousel owl-theme wow fadeInUp">
                            <blockquote class="testimonial-big s2">
                                <span class="title"> Professionalism, Quality, Responsiveness, Value</span>
                                I'm always impressed with the services. Took time to understand my needs, and made a beautiful website for my services..

                                <span class="name">Frank, Frich Enterprises</span>
                            </blockquote>

                            <blockquote class="testimonial-big s2">
                                <span class="title">Awesome design!</span>
                                Responsiveness, Value and they have a proffessional team

                                <span class="name">Jamal Dhahir, Intelvision</span>
                            </blockquote>

                            <blockquote class="testimonial-big s2">
                                <span class="title">Superb teamwork!</span>
                                Excellent workmanship, made an amazing website, I highly recommend.

                                <span class="name">Hesbon, Refushe</span>
                            </blockquote>
                        </div>

                    </div>


                </div>
            </div>
        </section>
        <!-- section close -->


        <!-- section begin -->
        <section data-bgcolor="#0f0000">
            <div class="wm wow fadeIn">02</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center wow fadeInUp">
                        <h5 class="s2 id-color">Discover</h5>
                        <h1>Our Features</h1>
                        <div class="separator"><span><i class="fa fa-square"></i></span></div>
                        <div class="spacer-single"></div>
                    </div>

                    <div class="clearfix"></div>


                    <div class="col-md-3">
                        <div class="box-icon top">
                            <span class="icon wow bounceIn" data-wow-delay="0s"><i class="icon-paintbrush id-color"></i></span>
                            <div class="text wow fadeIn" data-wow-delay=".15s">
                                <h3>Research & Discovery</h3>
                                <p>Discovery gives website developers and you the business owner, numerous benefits that can make their projects more successful. Essentially, a discovery phase sets entire projects up for success. 
                                Since the discovery process demands answers to difficult questions, it prepares your company in a number of ways..</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="box-icon top">
                            <span class="icon wow bounceIn" data-wow-delay=".25s"><i class="icon-trophy id-color"></i></span>
                            <div class="text wow fadeIn" data-wow-delay=".4s">
                                <h3>Shaping Idea & Design</h3>
                                <p>A website is like the front door inviting prospective customers to invest in their business for any company. It is why a professional, user-friendly interface is pivotal in building credibility and exposure.

In today’s digital landscape, creative designing strategies remain effective in growing your customer base. With the right website, you can create an online presence that makes your business stand out in the competition and drive sales.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="box-icon top">
                            <span class="icon wow bounceIn" data-wow-delay=".5s"><i class="icon-chat id-color"></i></span>
                            <div class="text wow fadeIn" data-wow-delay=".65s">
                                <h3>Prototyping & Development</h3>
                                <p> We use <em>Prototypes</em> to test your idea and or implementation idea for early feedback from your users.</p>
                                <p>Actual Development starts after research & discovery, Shaping the Idea into a design, and after feedback from the prototype. </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3" >
                        <div class="box-icon top">
                            <span class="icon wow bounceIn" data-wow-delay=".75s"><i class="icon-wallet id-color"></i></span>
                            <div class="text wow fadeIn" data-wow-delay=".9s">
                                <h3>Support</h3>
                                <p>We offer Ongoing maintenance to ensure website uptime, security, backups in case of disaster, Support Services. Free up your time and let our team manage everything so you can focus on what's really important, your business.</p>
                                <p> </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- section close -->


        <section data-bgimage="url(images-webstudio/bg/2.jpg)" class="text-light" data-stellar-background-ratio=".1">
            <div class="wm wow fadeIn">03</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center wow fadeInUp">
                        <h5 class="s2 id-color">Sample</h5>
                        <h1>Study Case</h1>
                        <div class="separator"><span><i class="fa fa-square"></i></span></div>
                        <div class="spacer-single"></div>
                    </div>
                </div>

                <div class="row g-0 align-items-center wow fadeInUp" data-bgcolor="rgba(20,20,20,.8)">

                    <div class="col-md-6 text-middle">
                        <div class="padding50">
                            <h3><span class="id-color">Website Before / After</span></h3>
                            <p>We carry rich expertise in building a high-performing solution consistently, without costly errors and setbacks. Our core offerings include practical agile methodologies, delivering innovative solutions on-time and in-budget. </p>
                            <div class="spacer10"></div>
                            <a href="#" class="btn-line-white">View Details</a>
                        </div>
                    </div>

                    <div class="col-md-6 text-middle">
                        <div class="twentytwenty-container">
                            <img src="images-webstudio/before-after/1b.jpg" alt="" class="img-responsive" />
                            <img src="images-webstudio/before-after/1a.jpg" alt="" class="img-responsive" />
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- section begin -->
        <section class="no-bottom">
            <div class="wm wow fadeIn">04</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center wow fadeInUp">
                        <h5 class="s2 id-color">Latest Work</h5>
                        <h1>Our Portfolio</h1>
                        <div class="separator"><span><i class="fa fa-square"></i></span></div>
                        <div class="spacer-single"></div>
                    </div>
                </div>
            </div>
            <div class="grid" data-col="4" data-gridspace="20" data-ratio="466/700">
                <div class="grid-sizer"></div>
                <div class="grid-item residential">
                    <!-- gallery item -->
                    <div class="item">
                        <div class="picframe s2">
                            <a href="https://kemsi-africa.com/">
                                    <span class="overlay">
                                        <span class="pf_title">
                                            <span class="project-name">Engineering</span>
                                        </span>
                                    </span>
                            </a>
                            <img src="images-webstudio/portfolio/1.jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->
                </div>
                <div class="grid-item large-width hospitaly">
                    <!-- gallery item -->
                    <div class="item">
                        <div class="picframe s2">
                            <a href="https://www.flamingowildvacations.com/">
                                    <span class="overlay">
                                        <span class="pf_title">
                                            <span class="project-name">Flamingo WIld </span>
                                        </span>
                                    </span>
                            </a>

                            <img src="images-webstudio/portfolio/2.jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->
                </div>
                <div class="grid-item large-height hospitaly">
                    <!-- gallery item -->
                    <div class="item">
                        <div class="picframe s2">
                            <a href="http://www.dripexperts.co.ke">
                                    <span class="overlay">
                                        <span class="pf_title">
                                            <span class="project-name">Agriculture</span>
                                        </span>
                                    </span>
                            </a>

                            <img src="images-webstudio/portfolio/3.jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->
                </div>
                <div class="grid-item residential">
                    <!-- gallery item -->
                    <div class="item">
                        <div class="picframe s2">
                            <a href="https://simbaboreholeequiping.co.ke/">
                                    <span class="overlay">
                                        <span class="pf_title">
                                            <span class="project-name">Simba Equiping</span>
                                        </span>
                                    </span>
                            </a>
                            <img src="images-webstudio/portfolio/4.jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->
                </div>
                <div class="grid-item large-height office">
                    <!-- gallery item -->
                    <div class="item">
                        <div class="picframe s2">
                            <a href="https://rhinowaterdrillers.com/">
                                    <span class="overlay">
                                        <span class="pf_title">
                                            <span class="project-name">Drilling</span>
                                        </span>
                                    </span>
                            </a>
                            <img src="images-webstudio/portfolio/5.jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->
                </div>
                <div class="grid-item commercial">
                    <!-- gallery item -->
                    <div class="item">
                        <div class="picframe s2">
                            <a href="http://www.wabestudio.co.ke/">
                                    <span class="overlay">
                                        <span class="pf_title">
                                            <span class="project-name">Technology</span>
                                        </span>
                                    </span>
                            </a>
                            <img src="images-webstudio/portfolio/6.jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->
                </div>

                <div class="grid-item large-width office">
                    <!-- gallery item -->
                    <div class="item office">
                        <div class="picframe s2">
                            <a href="http://www.intelvision.co.ke/">
                                    <span class="overlay">
                                        <span class="pf_title">
                                            <span class="project-name">Technology</span>
                                        </span>
                                    </span>
                            </a>

                            <img src="images-webstudio/portfolio/8.jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->
                </div>

                <div class="grid-item residential">
                    <!-- gallery item -->
                    <div class="item residential">
                        <div class="picframe s2">
                            <a href="https://wamutheregarden.co.ke/"
                            class="simple-ajax-popup-align-top">
                                    <span class="overlay">
                                        <span class="pf_title">
                                            <span class="project-name">Leisure & Garden</span>
                                        </span>
                                    </span>
                            </a>

                            <img src="images-webstudio/portfolio/7.jpg" alt="" />
                        </div>
                    </div>
                    <!-- close gallery item -->
                </div>


            </div>
        </section>
        <!-- section close -->


        <!-- section begin -->
        <section id="view-all-projects" class="call-to-action text-light bg-color padding40" aria-label="cta">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="size-2 no-margin">Are you looking for creative partner? </h3>
                    </div>

                    <div class="col-md-4 text-right">
                        <a href="https://wa.me/254781312070" class="btn-line-white wow fadeInUp">Hire Us Now</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- logo carousel section close -->

@endsection
