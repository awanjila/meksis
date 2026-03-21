<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="images-webstudio/logo.png" class="logo-small" alt=""><br>
                We are Wabestudio, a creative digital studio that loves to learn, collaborate and create

                We strive to partner with growth minded individuals and companies helping them accelerate their digital presence through great design and to ease their internal processes through great software products
            </div>

            <div class="col-md-3">
                <div class="widget widget_recent_post">
                    <h3>Latest News</h3>
                    <ul>
                        @foreach(\Illuminate\Support\Facades\DB::table('blogs')->inRandomOrder()->get()->take(5) as $blog)
                            <li><a href="{{ route('blogs.show',$blog->slug) }}">{{$blog->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-3">
                <h3>Contact Us</h3>
                <div class="widget widget-address">
                    <address>
                        <span>3rd Parklands Avenue, Nairobi</span>
                        <span><strong>Phone:</strong>(254) 781 312 070</span>
                        <span><strong>Email:</strong><a href="mailto:needhelp@wabestudio.co.ke">needhelp@wabestudio.co.ke</a></span>
                        <span><strong>Web:</strong><a href="https://wabestudio.co.k">https://wabestudio.co.ke</a></span>
                    </address>
                </div>
            </div>

            <div class="col-md-3">
                <div class="widget widget_recent_post">
                    <h3>Our Services</h3>
                    <ul>
                        @foreach(\Illuminate\Support\Facades\DB::table('services')->inRandomOrder()->get()->take(5) as $service)
                        <li><a href="{{ route('show.service',$service->slug) }}">{{$service->name}}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="subfooter">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    &copy; Copyright 2022 - Wabe Digital Agency<span class="id-color"> by Wabestudio</span>
                </div>
                <div class="col-md-6 text-right">
                    <div class="social-icons">
                        <a href="https://www.facebook.com/wabestudio/"><i class="fa fa-facebook fa-lg"></i></a>
                        <a href="https://www.twitter.com/wabestudio/"><i class="fa fa-twitter fa-lg"></i></a>
                        <a href="#"><i class="fa fa-rss fa-lg"></i></a>
                        <a href="#"><i class="fa fa-google-plus fa-lg"></i></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" id="back-to-top"></a>
</footer>
