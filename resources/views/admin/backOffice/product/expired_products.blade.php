@extends('layouts.admin_app')

@section('title')
  product
@endsection

@section('content')


    <!-- toastr -->

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <!-- toastr -->

            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <a href="{{route('product.add')}}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Product</a>
                                    </ol>
                                </div>
                                <h4 class="page-title">products</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>

                                        <tr>
                                            <th>s1</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Code</th>
                                            <th>Supplier</th>
                                            <th>QTY</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(  $expired_products as $key=> $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td><img src="{{ asset($item->product_image) }}" style="width: 50px; height: 40px;"></td>
                                            <td>{{$item->product_name}}</td>
                                            <td>{{$item->category->category_name}}</td>
                                            <td>{{$item->product_code}}</td>
                                            <td>{{$item->supplier->name}}</td>
                                            <td>{{$item->product_store}}</td>
                                            <td>
                                                @if($item->expire_date >=\Carbon\Carbon::now()->format('Y-m-d'))
<span class="badge badge-soft-success">Valid</span>
                                                @else
                                                    <span class="badge badge-soft-danger">Expired</span>
                                                @endif

                                            </td>
                                            <td>

                                                <a href="{{route('edit.product', $item->id)}}" class="btn btn-blue rounded-pill waves-effect waves-light"title="Edit"><i class="fa fa-pencil-alt"></i></a>
                                                <a href="{{route('barcode.product', $item->id)}}" class="btn btn-info rounded-pill waves-effect waves-light" id="details" title="Details"><i class="fa fa-barcode"></i></a>
                                                <a href="{{route('delete.product', $item->id)}}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete"title="Delete"><i class="fa fa-trash-alt"></i></a>

                                            </td>


                                        </tr>

                                        @endforeach
                                        </tbody>
                                    </table>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>
                    <!-- end row-->


                    <!-- end row-->

                </div> <!-- container  fluid-->
            </div> <!-- container -->

                <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
                <link href="{{asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
                <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;
            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;
            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;
            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
        @endif
    </script>

@endsection
