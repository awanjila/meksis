
@extends('admin.admin_master')

@section('title')  Wabe Digital Agency| Admin @endsection
@section('content')
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
 
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
                                            <li class="breadcrumb-item active">Inbox</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Inbox</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                        <div class="row">

                            <!-- Right Sidebar -->
                            <div class="col-12">
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

           

                                        <div class="mt-3">
                                            <ul class="message-list">

                                            	@foreach($contacts as $item)
    <li class="unread">
        <a href="{{ route('contact.view', $item->id) }}">
            <div class="col-mail col-mail-1">
                <div class="checkbox-wrapper-mail">
                    <label for="chk1" class="toggle"></label>
                </div>
                <span class="star-toggle far fa-star text-warning"></span>
                <a href="" class="title">{{ $item->name }}</a>
            </div>
            <div class="col-mail col-mail-2">
                <a href="" class="subject">{{ $item->subject }}! &nbsp;&ndash;&nbsp;
                    <span class="teaser">{{ \Illuminate\Support\Str::limit($item->message, 10) }}.</span>
                </a>
                <div class="date">{{ $item->created_at->format('M d, Y') }}</div>
            </div>
        </a>
    </li>
@endforeach

                                               
                                            </ul>
                                        </div>
                                        <!-- end .mt-4 -->

                                        <!-- <div class="row">
                                            <div class="col-7 mt-1">
                                                Showing 1 - 20 of 289
                                            </div> 
                                            <div class="col-5">
                                                <div class="btn-group float-end">
                                                    <button type="button" class="btn btn-light btn-sm"><i class="mdi mdi-chevron-left"></i></button>
                                                    <button type="button" class="btn btn-info btn-sm"><i class="mdi mdi-chevron-right"></i></button>
                                                </div>
                                            </div> 
                                        </div> -->
                                        <!-- end row-->
                                    </div> 
                                    <!-- end inbox-rightbar-->

                                    <div class="clearfix"></div>
                                    </div>
                                </div> <!-- end card -->

                            </div> <!-- end Col -->
                        </div><!-- End row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

              

        

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
@endsection

        
   