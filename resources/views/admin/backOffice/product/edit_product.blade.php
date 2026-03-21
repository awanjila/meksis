
@extends('admin.admin_master')

@section('title')
    Edit Product
@endsection

@section('content')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
      <script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>



    <div class="col-lg-8 col-xl-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('product.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Product Info</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="name" value="{{$product->product_name}}">

                                @error('product_name')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category </label>
                                <select name="category_id" class="form-select" id="example-select">
                                    <option disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!-- end col -->

                        <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <textarea type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title">{!! $product->meta_title !!}</textarea>
                            @error('meta_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                       
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Product Code</label>
                                <input type="text" name="product_code" class="form-control @error('product_code') is-invalid @enderror" id="product_code" value="{{$product->product_code}}">

                                @error('product_code')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div> <!-- end col -->

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Buying Price</label>
                                <input type="text" name="buying_price" class="form-control @error('buying_price') is-invalid @enderror" id="buying_price" value="{{$product->buying_price}}">

                                @error('buying_price')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div> <!-- end col -->


                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Product Quantity</label>
                                <input type="number" name="product_store" class="form-control @error('product_store') is-invalid @enderror" id="product_store" value="{{$product->product_store}}">

                                @error('product_store')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div> <!-- end col -->

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Selling Price</label>
                                <input type="text" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" value="{{$product->selling_price}}">

                                @error('selling_price')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div> <!-- end col -->

                             <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Product Description</label>
                                <textarea type="text" name="product_description" class="form-control @error('product_description') is-invalid @enderror" id="product_description">{{$product->product_description}}</textarea>

                                @error('product_description')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div> <!-- end col -->

                        
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror">{{$product->meta_description}}</textarea>
                        @error('meta_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                         <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Product Features</label>
                                <textarea type="text" name="product_features" class="form-control @error('product_features') is-invalid @enderror" id="product_features">{{$product->product_features}}</textarea>

                                @error('product_features')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="example-fileinput" class="form-label">Product Image</label>
                                <input type="file" name="product_image" class="form-control" id="image">

                            </div>

                            <img id="showImage" src="{{(!empty($product->product_image))? url('upload/product/'.$product->product_image) : url('upload/no_image.jpg')}}" class="rounded-circle avatar-lg img-thumbnail"
                                 alt="profile-image">
                        </div> <!-- end col -->
                    </div> <!-- end row -->


                    <div class="text-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update</button>
                    </div>
                </form>



            </div>
        </div> <!-- end card-->

    </div> <!-- end col -->

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



@endsection
