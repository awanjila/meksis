@extends('admin.admin_master')

@section('title') Wabe Digital Agency| Admin @endsection
@section('content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    @php
    $contacts =App\Models\Contact::latest()->get();
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Email</a></li>
                                    <li class="breadcrumb-item active">Email Read</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Email Read</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Right Sidebar -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                        
                            <div class="card-body">
                                <!-- Left sidebar -->
                                <div class="inbox-leftbar">


                                    <div class="mail-list mt-4">
                                        <a href="javascript: void(0);" class="text-danger fw-bold"><i class="dripicons-inbox me-2"></i>Inbox<span class="badge badge-soft-danger float-end ms-2">{{count($contacts)}}</span></a>
                                    </div>


                                </div>
                                <!-- End Left sidebar -->

                                <div class="inbox-rightbar">




                                    <div class="mt-4">
                                        <h5 class="font-18">{{$contact->subject}}!</h5>

                                        <hr/>

                                        <div class="d-flex align-items-start mb-3 mt-1">
                                            <div class="w-100">
                                                <small class="float-end">{{ $contact->created_at->format('M d, Y, g:i A') }}</small>
                                                <h6 class="m-0 font-14">{{$contact->name}}</h6>
                                                <small class="text-muted">From: {{$contact->email}}</small><br>
                                                <small class="text-muted">phone: {{$contact->phone}}</small>
                                            </div>
                                        </div>

                                        <h4>{{$contact->subject}}</h4>

                                        <p>Hello Wabe Digital Agency</p>
                                        <p>{{$contact->message}}</p>
                                        <hr/>


                                    </div>
                                    <!-- end .mt-4 -->

                                </div>
                                <!-- end inbox-rightbar-->

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div> <!-- end Col -->

                </div><!-- End row -->


            </div> <!-- container -->

        </div> <!-- content -->


    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->




@endsection
