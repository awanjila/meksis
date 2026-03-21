
@extends('layouts.admin_app')

@section('title')
   Product BarCode
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <div class="col-lg-8 col-xl-8">
        <div class="card">
            <div class="card-body">
                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Product BarCode</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <h3>{{$product->product_name}}</h3>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Product Code</label>
                                <h3>{{$product->product_code}}</h3>

                            </div>
                        </div> <!-- end col -->
                        @php
                        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                        @endphp

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Product BarCode</label>
                                <h3>{!! $generator->getBarcode($product->product_code,$generator::TYPE_CODE_128)!!}</h3>

                            </div>
                        </div> <!-- end col -->






                    </div> <!-- end row -->




            </div>
        </div> <!-- end card-->

    </div> <!-- end col -->

@endsection

