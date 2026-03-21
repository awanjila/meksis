@extends('admin.admin_master')

@section('title') Intelvison Technologies | Admin @endsection
@section('content')

    @php
    $contacts =App\Models\Contact::latest()->get();
    $blogs =App\Models\BackOffice\Blog::latest()->get();
    $services =App\Models\Service::latest()->get();

    @endphp
   
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">WABE CMS</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active"> Wabe Digital Agency</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Intelvision Technologies</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <div class="card" id="tooltip-container">
                            <div class="card-body">
                                <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                <h4 class="mt-0 font-16">Inbox</h4>
                                <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{count($contacts)}}</span></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card" id="tooltip-container1">
                            <div class="card-body">
                                <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                <h4 class="mt-0 font-16">Blog</h4>
                                <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{count($blogs)}}</span></h2>
{{--                                <p class="text-muted mb-0">Total sales: 2398 <span class="float-end"><i class="fa fa-caret-down text-danger me-1"></i>7.85%</span></p>--}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card" id="tooltip-container2">
                            <div class="card-body">
                                <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                <h4 class="mt-0 font-16">Services</h4>
                                <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{count($services)}}</span></h2>
{{--                                <p class="text-muted mb-0">Total users: 121 M <span class="float-end"><i class="fa fa-caret-up text-success me-1"></i>3.64%</span></p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <!-- INBOX -->
                    <div class="col-xl-12 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    </div>
                                </div>
                                <h4 class="header-title mb-3">Inbox</h4>

                                <div class="inbox-widget" data-simplebar style="max-height: 407px;">

                                    @foreach($contacts as $item)
                                    <div class="inbox-item">
                                        <p class="inbox-item-author">{{$item->name}}</p>
                                        <p class="inbox-item-text">{!! substr($item->message,0,15) !!}....</p>
                                        <p class="inbox-item-date">

                                            <a href="{{ route('contact.view',$item->id)}}" class="btn btn-sm btn-link text-info font-13"> View</a>
                                        </p>
                                    </div>
                                    @endforeach

                                </div> <!-- end inbox-widget -->
                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end col -->

                </div> <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        @include('admin.partials.footer')
        <!-- end Footer -->

    </div>
@endsection


