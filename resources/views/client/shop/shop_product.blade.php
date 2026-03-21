@extends('client.layout.app')
@section('title')
Meksis Engineering | Advanced Security Solutions  
@endsection

@section('meta_title')
Categories | Shop Wabe Digital Agency   
@endsection

@section('meta_description')
Boost your online presence with expert Website Design, efficient Point Of Sale systems, robust Ecommerce solutions, innovative Web Design, and secure Biometric Attendance systems. Enhance functionality and user experience.
@endsection
@section('content')

		<!-- Main content Start -->
        <div class="main-content">
            
          
            <!-- Breadcrumbs Start -->
            <div class="rs-breadcrumbs img3">
                <div class="breadcrumbs-inner text-center">
                    <h1 class="page-title">Shop {{$product->product_name}}</h1>
                    <ul>
                        <li title="Braintech - IT Solutions and Technology Startup HTML Template">
                            <a class="active" href="/">Home</a>
                        </li>
                        <li title="Go To the Business category archives">
                        <a class="active" href="/products/{{ $product->category->slug }}">{{ $product->category->category_name }}</a>
                        </li>
                        <li title="Go To the Business category archives">
    <a class="active" href="/products/{{ $product->slug }}">{{ $product->product_name }}</a>
</li>

                        
                    </ul>
                </div>
            </div>
            <!-- Breadcrumbs End -->

            <!-- Shop Single Start -->
            <div id="rs-single-shop" class="rs-single-shop pt-120 pb-80 md-pt-80 sm-pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 sm-mb-30">
                            <div class="single-product-image">
                                <div class="images-single">
                                    <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="single-price-info pl-30 sm-pl-0">
                                <h4 class="product-title">{{ $product->product_name }}</h4>
                                <span class="single-price">Ksh {{ $product->selling_price }}.00</span>
                                <p class="some-text">{!! $product->product_features !!}.</p>
                                <add-to-cart :product="{{ json_encode($product) }}"></add-to-cart>
                                <p class="category"><span>Category:</span><a href="/products/{{ $product->category->slug }}"> {{ $product->category->category_name }}</a></p>
                            </div>
                        </div> 
                    </div>
                    <div class="tab-area">
                        <ul class="nav nav-tabs">
                            <li><a class="active" href="#one" data-toggle="tab">Description</a></li>
                            <li><a href="#two" data-toggle="tab">Reviews (0)</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="one">
                                <p class="dsc-p">{!! $product->product_description !!}</p>
                            </div><!-- #one -->

                            <div class="tab-pane" id="two">
                                <div class="reviews-grid">
                                    <div class="top-area">
                                        <p>There are no reviews yet.</p>
                                        <h6 class="mb-0">Be the first to review "{{$product->product_name}}"</h6>
                                    </div>

                                    <form class="comment-form" id="commentform">
                                        <p class="comment-notes">Your email address will not be published. Required fields are marked *</p>

                                        <div class="placeholder-cntrl">
                                            <label>Name *</label>
                                            <input type="text" name="name" size="30" required="">
                                        </div>
                                        <div class="placeholder-cntrl">
                                            <label>Email *</label>
                                            <input type="Email" name="email" size="30" required="">
                                        </div>
                                        <div class="ratings">Your rating
                                            <ul>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <div class="placeholder-cntrl">
                                            <label>Your review *</label>
                                            <textarea required=""></textarea>
                                        </div>
                                        <div class="btn-part">
                                            <button class="add-btn ml-10" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- #two -->
                        </div>
                    </div><!-- .tab-area -->
                </div>
            </div>
            <!-- Shop Single Start -->

            <!--Shop part end-->
            <div class="rs-shop-part pb-120 md-pb-75">
                <div class="container">
                    <h4 class="title pb-23 md-pb-10">Related products</h4>
                    <div class="row">

                    @foreach($products as $item)

                        <div class="col-lg-4 col-md-6 col-sm-6 md-mb-45">
                            <div class="product-list">
                                <div class="image-product">
                                    <img src="{{ asset($item->product_image) }}" alt="">
                                    <div class="overley">
                                        <a href="shop-single.html"><i class="flaticon-shopping-bag"></i></a>
                                    </div>
                                </div>
                                <div class="content-desc text-center">
                                    <h2 class="loop-product-title pt-15"><a href="shop-single.html">{{$item->product_name}}</a></h2>
                                    <span class="price">Ksh {{$item->selling_price}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <!--Shop part end-->

        </div> 
        <!-- Main content End -->
     @endsection