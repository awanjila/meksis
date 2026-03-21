@extends('client.layout.app')
@section('title')
    Drip  Experts | Find the best experts in Drip Irrigation | Sprinkler Irrigation | Green House  Construction In Kenya | Our Solutions
@endsection

@section('content')

     <!--Project V-1 Start-->
     <section class="project-v-1">
         <div class="container">
             <div class="row">
                 @foreach ($products as $product)
                 <!--Project One Single Start-->
                 <div class="col-xl-4 col-lg-6 col-md-6">
                     <div class="project-one__single">
                         <div class="project-one__img">
                             <img src="/product_image/{{$product->product_image}}" alt="{{$product->name}}">
                         </div>
                         <div class="project-one__content-box">
                             <div class="project-one__content">
                                 <p class="project-one__sub-title">{{$product->name}}</p>
                                 <h3 class="project-one__title"><a href="{{ route('show.product',$product->slug) }}">{{$product->name}}</a>
                                 </h3>
                             </div>
                             <div class="project-one__btn">
                                 <a href="{{ route('show.product',$product->slug) }}"><i class="icon-right-arrow-1"></i></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!--Project One Single End-->
                 @endforeach
             </div>
         </div>
     </section>
     <!--Project V-1 End-->

@endsection
