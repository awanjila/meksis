

@php
$id=Auth::user()->id;
$adminData=App\Models\User::find($id);
@endphp


<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ms-1">
                        {{$adminData->name}} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome {{$adminData->name}} </h6>
                    </div>

                    <!-- item-->
                    
                    <a href="#" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account Profile</span>
                    </a>

                    <!-- item-->
                    
                    <a href="#" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Change PassWord</span>
                    </a>


                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="{{route('admin.logout')}}" class="dropdown-item notify-item">
                        <span>Logout</span>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="/" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="{{asset('logo/logo-img.png')}}" alt="" height="50">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img src="{{asset('logo/logo-img.png')}}" alt="" height="50">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
            </a>

            <a href="/" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{asset('logo/logo-img.png')}}" alt="" height="50">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('logo/logo-img.png')}}" alt="" height="50">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
