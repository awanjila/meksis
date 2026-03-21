    @extends('client.layout.app')
    @section('title')
        Wabestudio |{{$blog->name}} | Web Development & Design Company
    @endsection

    @section('content')

        <!-- subheader -->
        <section id="subheader" data-bgimage="url(images/background/subheader-8.jpg)" data-stellar-background-ratio=".2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>{{$blog->name}}</h1>
                        <ul class="crumb">
                            <li><a href="/">Home</a></li>
                            <li class="sep">/</li>
                            <li>{{$blog->name}}</li>
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
                    <div class="col-md-8">
                        <div class="blog-read">
                            <div class="post-content">
                                <div class="post-image">
                                    <img src="/storage/posts_images/{{$blog->image}}" alt="{{$blog->name}}" />
                                </div>

                                <div class="date-box">
                                    <div class="month">{{$blog->created_at->format('M')}}</div>
                                     <div class="day">{{$blog->created_at->format('d')}}</div>

                                </div>

                                <div class="post-text">
                                    <h3><a href="#">{{$blog->name}} </a></h3>
                                    <p>{!! $blog->description !!} .</p>

                                </div>
                            </div>

                            <div class="post-meta"><span><i class="fa fa-user id-color"></i>By: <a href="#">{{$blog->author}} </a></span> <span><i class="fa fa-tag id-color"></i><a href="#">{{$blog->category}}</a>, <a href="#">{{$blog->name}}</a></span></div>

                            <div class="spacer-single"></div>
                             @if(!Auth::check())
                            <div id="app">

                            <div id="blog-comment">

                                <a href="{{route('login')}}" class="btn-on-header btn-line">
                                       Sign in to post a comment</a>
                                   </div>

                                     @else


                                <div class="spacer-half"></div>


                                <ol>

                                    <li>

                                        <get-comments :userid="{{Auth::user()->id}}" :blogid="{{$blog->id}}"></get-comments>

                                    </li>
                                </ol>


                                    <h3>Leave a Comment</h3>
                                    <!-- <a class="thm-btn sidebar__tags-btn" href="{{route('login')}}"> -->



                                <div class="spacer-single"></div>


                                <div id="comment-form-wrapper">


                                    <h3>Leave a Comment</h3>


                                    <div class="comment_form_holder">
                                        <form id="contact_form" name="form1"  action="#">
                                            @csrf

                                        <add-comment :userid="{{Auth::user()->id}}" :blogid="{{$blog->id}}">

                                        </add-comment>



                                                </div>


                                        </form>
                                    </div>
                                </div>
                                  @endif
                            </div>


                        </div>


                    </div>

                    <div id="sidebar" class="col-md-4">
                    <div id="sidebar1">
                        <div class="widget widget-post">
                            <h4>Recent Posts</h4>
                            <div class="small-border"></div>
                            <ul>
                                @foreach($blog_posts as $blo_g)
                                <li><a href="{{ route('blogs.show',$blo_g->slug) }}">{{$blo_g->name}}</a></li>
                                @endforeach

                            </ul>
                        </div>

                        <div class="widget widget-text">
                            <h4>About Us</h4>
                            <div class="small-border"></div>

                            We are Wabestudio, a creative digital studio that loves to learn, collaborate and create.
                            We strive to partner with growth minded individuals and companies helping them accelerate their digital presence through great design and to ease their internal processes through great software products.
                        </div>

                        <div class="widget widget_tags">
                            <h4>Tags</h4>
                            <div class="small-border"></div>
                            <ul>
                                @foreach($blogcats as $blogcat)
                                <li><a href="#link">{{$blogcat->name}}</a></li>

                                @endforeach
                            </ul>
                        </div>

                    </div>

                    </div>
                </div>
            </div>
        </div>


    @endsection
