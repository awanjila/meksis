<header class="transparent scroll-light">
    <div class="info">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="column">Working Hours Monday - Friday <span class="id-color"><strong>08:00-16:00</strong></span></div>
                    <div class="column">Toll Free <span class="id-color"><strong>1800.899.900</strong></span></div>
                    <!-- social icons -->
                    <div class="column social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-rss"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-envelope-o"></i></a>
                    </div>
                    <!-- social icons close -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- logo begin -->
                <div id="logo">
                    <a href="/">
                        <img class="logo" src="images-webstudio/logo.png" alt="">
                    </a>
                </div>
                <!-- logo close -->

                <!-- small button begin -->
                <span id="menu-btn"></span>
                <!-- small button close -->

                <!-- mainmenu begin -->
                <nav>
                    <ul id="mainmenu">
                        <li><a href="/">Home<span></span></a>
                        </li>
                        <li><a href="{{route('about')}}">About Us<span></span></a>
                        </li>
                        <li><a href="{{route('service.index')}}">Services</a>
                            <ul>
                                @foreach(\Illuminate\Support\Facades\DB::table('services')->get() as $service)
                                <li><a href="{{ route('show.service',$service->slug) }}">{{$service->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{route('product.index')}}">Products</a>
                            <ul>
                                @foreach(\Illuminate\Support\Facades\DB::table('products')->get() as $product)
                                    <li><a href="{{ route('show.product',$product->slug) }}">{{$product->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{route('blogs.index')}}">Blog<span></span></a>
                        </li>

                        <li><a href="{{route('contact')}}">Contact Us<span></span></a>
                        </li>

                    </ul>

                </nav>
               

                <!-- mainmenu close -->

            </div>


        </div>
    </div>
</header>
