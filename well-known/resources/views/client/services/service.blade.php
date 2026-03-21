@extends('client.layout.app')
@section('title')
    Wabestudio Web Design | Our Solutions
@endsection

@section('content')

    <div id="content">
        <div class="container">
            <div class="row">
                 @foreach($services as $service)

                
                <div class="col-md-3">
                <h3><span class="id-color">{{$service->name}}</span></h3>
                    {!!substr($service->description,0,200)!!}
                    <div class="spacer-single"></div>
                    <img src="/cover_image/{{$service->cover_image}}" class="img-responsive" alt="{{$service->name}}">
                    <div class="spacer-single"></div>
                    <a href="{{ route('show.service',$service->slug) }}" class="btn-line btn-fullwidth">Read More</a>
                          
                </div>
                @endforeach
          


            </div>
        </div>



    </div>
@endsection
