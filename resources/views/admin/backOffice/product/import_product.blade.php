
@extends('layouts.admin_app')

@section('title')
    Add Product
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <a href="{{route('export.product')}}" class="btn btn-primary rounded-pill waves-effect waves-light">Download Xlxs</a>
                    </ol>
                </div>
                <h4 class="page-title">Import Product</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="col-lg-8 col-xl-8">
        <div class="card">
            <div class="card-body">
                <form id="myForm" method="POST" action="{{route('import')}}" enctype="multipart/form-data">
                    @csrf
                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Product Info</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Xlxs File Import</label>
                                <input type="file" name="import_product" class="form-control @error('import_product') is-invalid @enderror" id="import_product" >

                                @error('import_product')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>

                    </div> <!-- end row -->


                    <div class="text-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Upload</button>
                    </div>
                </form>



            </div>
        </div> <!-- end card-->

    </div> <!-- end col -->

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required : true,
                    },
                    category_id: {
                        required : true,
                    },
                    supplier_id: {
                        required : true,
                    },

                    product_store: {
                        required : true,
                    },
                    buying_date: {
                        required : true,
                    },
                    expire_date: {
                        required : true,
                    },
                    buying_price: {
                        required : true,
                    },
                    product_image: {
                        required : true,
                    },
                },
                messages :{
                    product_name: {
                        required : 'Please Enter Product Name',
                    },
                    category_id: {
                        required : 'Please Select Category',
                    },
                    supplier_id: {
                        required : 'Please Select Supplier',
                    },
                    product_store: {
                        required : 'Please Enter Product Store',
                    },
                    buying_date: {
                        required : 'Please Select Buying Date',
                    },
                    expire_date: {
                        required : 'Please Select Expire Date',
                    },
                    buying_price: {
                        required : 'Please Enter Buying Price',
                    },
                    product_image: {
                        required : 'Please Select Product Image',
                    },
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

        });
    </script>
@endsection
