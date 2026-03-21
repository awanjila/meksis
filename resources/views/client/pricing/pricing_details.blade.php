@extends('client.layout.app')
@section('title')
{{$packageprice->title}} 
@endsection

@section('meta_title')

    {{$packageprice->meta_title}}
@endsection

@section('meta_description')

    {{$packageprice->meta_description}}

@endsection
<!-- subheader -->
@section('content')


<!-- Main content Start -->
<div class="main-content">
            
        
            <!-- Breadcrumbs Start -->
            <div class="rs-breadcrumbs img2">
                <div class="breadcrumbs-inner text-center">
                    <h1 class="page-title">{{$packageprice->title}}</h1>
                    <ul>
                        <li title="Braintech - IT Solutions and Technology Startup HTML Template">
                            <a class="active" href="/">Home</a>
                        </li>
                       <li>{{$packageprice->title}}</li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumbs End -->

            <!-- Pricing section start -->
            <div class="rs-pricing style2 gray-color pt-120 pb-150 md-pt-80 md-pb-80">
                <div class="container">
                    <div class="sec-title2 text-center mb-45">
                        <span class="sub-text style-bg">Pricing</span>
                        <h2 class="title title2">
                           Our {{$packageprice->title}} Plans
                        </h2>
                    </div>
                   <div class="row">
                    @foreach($prices as $item)
                       <div class="col-lg-4">
                           <div class="pricing-table new-style2">
                               <div class="pricing-badge">
                                   {{$item->title}}
                               </div>
                               <div class="pricing-icon">
                                   <img src="assets/images/pricing/main-home/icons/1.png" alt="">
                               </div>
                               <div class="pricing-table-price">
                                    <div class="pricing-table-bags">
                                        <span class="pricing-currency">Ksh</span>
                                        <span class="table-price-text"> {{$item->pricing}}</span>
                                        <span class="table-period">{{$item->duration}}</span>
                                    </div>
                               </div>
                               <div class="pricing-table-body">
                                   <ul>
                                       <li>{!! $item->description !!}</li>
                                   </ul>
                               </div>
                               <div class="btn-part">
                                   <a class="readon buy-now pricing" href="#">Buy Now</a>
                               </div>
                           </div>
                       </div>
                       @endforeach
                       
                   </div>
                </div>
            </div>
            <!-- Pricing section end -->

        </div> 
        <!-- Mai

    @endsection
