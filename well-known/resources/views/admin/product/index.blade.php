
@extends('admin.layout.app')

@section('title')
    WabeStudio | Products

@endsection
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Products</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
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
                            <tr>
                                <th>#</th>

                                <th>Name</th>
                                <th>Description</th>
                                <th>Cover Image</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>

                                <th>Name</th>
                                <th>Description</th>
                                <th>Cover Image</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{!!  $product->description !!}</td>
                                    <td> <img src="/product_image/{{$product->product_image}}" class="img-responsive" style="max-height: 100px; max-width: 100px" alt="{{$product->name}}" srcset=""></td>
                                    <td>
                                        <a href="{{ url('/product/'.$product->id.'/edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ url('/product/'.$product->id.'/delete') }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->

    </div>


    <!---Container Fluid-->
@endsection

@section('scripts')

    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable(); // ID From dataTable
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>

@endsection
