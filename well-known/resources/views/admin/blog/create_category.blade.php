@extends('admin.layout.app')

@section('title')
   Wabestudio | Create Posts Category

@endsection

@section('content')

    <!-- Main Content-->
    <div class="main-content side-content pt-0">

        <div class="container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-header-1">
                        <h1 class="main-content-title tx-30">Blog Post Category</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Form-Elements</li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->



                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">Default Form Input Fields with labels</h6>
                                    <p class="text-muted card-sub-title">A form control with labels state.</p>
                                    @if (Session::has('status'))
                                        <div class="alert alert-success">

                                            {{Session::get('status')}}

                                        </div>
                                    @endif
                                    @if (Session::has('status1'))
                                        <div class="alert alert-danger">

                                            {{Session::get('status1')}}

                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    <h6 class="main-content-label mb-1">Demo Plans Form</h6>
                                                    <p class="text-muted card-sub-title">A form group layout for entering card information upon checkout.</p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                        <form action="{{ route('blogcats.store') }}" method="post" enctype="multipart/form-data">
                                                             {{ csrf_field() }}
                                                            <div class="form-group">
                                                                <label class="">Name </label>
                                                                <input class="form-control" required="" type="text" name="name">
                                                            </div>
                                                            <button class="btn ripple btn-main-primary btn-block">Submit</button>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Row -->
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>
    </div>
    <!-- End Main Content-->


@endsection
