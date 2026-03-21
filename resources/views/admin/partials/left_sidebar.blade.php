
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li class="menu-title mt-2">Custom</li>


                <li>
                    <a href="#homeSlider" data-bs-toggle="collapse">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> HOME PAGE </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="homeSlider">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('home.slider') }}">Add a Home Slide</a>
                            </li>

                            <li>
                                <a href="{{ route('index.slider') }}">Home Slides List</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>



               <li>
                    <a href="#about" data-bs-toggle="collapse">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> ABOUT PAGE </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="about">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('edit.about.page') }}">About Content</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                    <li>
                    <a href="#service" data-bs-toggle="collapse">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> SERVICE PAGE </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="service">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.service') }}">Add a Service</a>
                            </li>

                            <li>
                                <a href="{{ route('index.service') }}">Service List</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarAut" data-bs-toggle="collapse">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> BLOG SECTION </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAut">
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{route('add.blog.category')}}">Add a Blog Category</a>
                            </li>

                            <li>
                                <a href="{{route('index.blog.category')}}">Blog Categorys</a>
                            </li>
                            <li>
                                <a href="{{route('add.blog')}}">Add a Post</a>
                            </li>
                            <li>
                                <a href="{{route('index.blog')}}">Posts</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">Apps</li>

                <li>
                    <a href="#sidebarEmail" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Email </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmail">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('contact.inbox')}}">Inbox</a>
                            </li>
                        
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarProjects" data-bs-toggle="collapse">
                        <i class="mdi mdi-briefcase-check-outline"></i>
                        <span> Portfolio </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarProjects">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('portfolio.category')}}">Portfolio Category</a>
                            </li>

                            <li>
                                <a href="{{route('portfolio')}}">Portfolio</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarPricing" data-bs-toggle="collapse">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> Pricing Section </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPricing">
                        <ul class="nav-second-level">
                        <li>
                                <a href="{{route('add.pricing.package')}}">Add Pricing Package</a>
                            </li>
                            <li>
                                <a href="{{route('index.pricing.package')}}">Pricing Packages</a>
                            </li>
                          
                            <li>
                                <a href="{{route('add.pricing')}}">Add Pricing</a>
                            </li>
                            <li>
                                <a href="{{route('index.pricing')}}">Pricing</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
    <a href="#category" data-bs-toggle="collapse">
    <i class="fa fa-briefcase "></i>
    <span> Category Management </span>
    <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="category">
         <ul class="nav-second-level">
            <li>
               <a href="{{route('all.category')}}">All Category</a>
            </li>
         </ul>
    </div>
    </li>

    <li>
       <a href="#product" data-bs-toggle="collapse">
       <i class="fa fa-briefcase "></i>
      
       <span class="menu-arrow"></span>
       </a>
       <div class="collapse" id="product">
           <ul class="nav-second-level">

               <li>
                  <a href="{{route('all.product')}}">All Product</a>
               </li>

               <li>
                   <a href="{{route('product.add')}}">Add Product</a>
               </li>
           </ul>
   </div>
   </li>
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
