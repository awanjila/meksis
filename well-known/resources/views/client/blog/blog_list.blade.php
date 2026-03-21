
@extends('client.layout.app')
@section('title')
     Wabestudio | Blogs  Web Development & Design Company
@endsection

@section('content')

<!-- subheader -->
<section id="subheader" data-bgimage="url(images/background/subheader-8.jpg)" data-stellar-background-ratio=".2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Blog</h1>
                <ul class="crumb">
                    <li><a href="/">Home</a></li>
                    <li class="sep">/</li>
                    <li>Blog</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- subheader close -->

<!-- content begin -->
<div id="content">
    <div class="container">
        <div class="row">
            @foreach($blog_posts as $blog_post)

            <div class="col-lg-4 col-md-6 mb30">
                <div class="bloglist item">
                    <div class="post-content">
                        <div class="post-image">
                            <a class="image-popup-no-margins" href="/storage/posts_images/{{$blog_post->image}}">
                                <img alt="" src="/storage/posts_images/{{$blog_post->image}}">
                            </a>
                        </div>
                        <div class="post-text">
                            <span class="p-tagline">{{$blog_post->category}}</span>
                            <h4><a href="{{ route('blogs.show',$blog_post->slug) }}">{{$blog_post->name}}</a></h4>

                           {!!substr($blog_post->description,0,110)!!}


                            <span class="p-date">{{$blog_post->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="spacer-single"></div>

            <ul class="pagination m-auto">
                <li><a href="#">Prev</a></li>
                <li><a href="#">{!! $data->links() !!}</a></li>
                <li><a href="#">Next</a></li>
            </ul>

        </div>

    </div>
</div>

        @endsection
