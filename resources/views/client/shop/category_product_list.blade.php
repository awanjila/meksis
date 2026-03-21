
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
        <div class="main-content">
         
            <!-- Breadcrumbs Start -->
            <div class="rs-breadcrumbs img3">
                <div class="breadcrumbs-inner text-center">
                    <h1 class="page-title">Shop {{ $category->category_name }}</h1>
                    <ul>
                        <li title="Braintech - IT Solutions and Technology Startup HTML Template">
                            <a class="active" href="/">Home</a>
                        </li>
                        <li>{{ $category->category_name }}</li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumbs End -->

            <!--Shop part start-->
            <div class="rs-shop-part pt-120 pb-120 md-pt-70 md-pb-80">
                <div class="container">
                   	<div class="row align-items-center rs-vertical-middle shorting mb-50">
                   	    <div class="col-sm-6 col-12">
                   	        <p class="woocommerce-result-count">Showing 1-9 of 12 results</p>
                   	    </div>
                   	    <div class="col-sm-6 col-12 sm-mt-20">
                   	        <select class="from-control">
                   	            <option>Default sorting</option>
                   	            <option>Sort by popularity</option>
                   	            <option>Sort by average rating</option>
                   	            <option>Sort by lates</option>
                   	            <option>Sort by price: low to high</option>
                   	            <option>Sort by price: high to low</option>
                   	        </select>
                   	    </div>
                   	</div>
                   	<div class="row">

                       @foreach($items as $p)
                   	    <div class="col-lg-4 col-md-6 mb-80">
                   	        <div class="product-list">
                   	            <div class="image-product">
                                   <img src="{{ asset($p->product_image) }}" alt="{{ $p->product_name }}">
                   	                <div class="overley">
                   	                    <a href="shop-single.html"><i class="flaticon-shopping-bag"></i></a>
                   	                </div>
                   	            </div>
                   	            <div class="content-desc text-center">
                   	                <h2 class="loop-product-title pt-15"><a href="{{ route('show.product',$p->slug) }}">{{ $p->product_name }}</a></h2>
                   	                <span class="price">Ksh {{ $p->selling_price }}.00</span>
                   	            </div>
                   	        </div>
                   	    </div>

                        @endforeach
                   	    
                   	    


                   	     <div class="col-lg-12 text-center pt-40">
                   	         <ul class="pagination-part">
                   	             <li class="active"><a href="#">1</a></li>
                   	             <li><a href="#">2</a></li>
                   	             <li><a class="next-page" href="#">Next</a></li>
                   	         </ul> 
                   	     </div>
                   	</div>
                </div>
            </div>
            <!--Shop part end-->
        </div> 
        <!-- Main content End -->

        @endsection
     