@extends('admin.admin_master')

@section('title', 'Add Product')

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
            <form id="myForm" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Product Info</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="product_name">
                            @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <textarea type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title"></textarea>
                            @error('meta_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" class="form-select form-group @error('category_id') is-invalid @enderror" id="category_id">
                                <option disabled selected>Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                
                </div> <!-- end row -->

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="buying_price" class="form-label">Buying Price</label>
                        <input type="text" name="buying_price" class="form-control @error('buying_price') is-invalid @enderror" id="buying_price">
                        @error('buying_price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="selling_price" class="form-label">Selling Price</label>
                        <input type="text" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" id="selling_price">
                        @error('selling_price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="product_store" class="form-label">Product Quantity</label>
                        <input type="number" name="product_store" class="form-control @error('product_store') is-invalid @enderror" id="product_store">
                        @error('product_store')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror"></textarea>
                        @error('meta_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea name="product_description" class="form-control @error('product_description') is-invalid @enderror"></textarea>
                        @error('product_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="product_features" class="form-label">Product Features</label>
                        <textarea name="product_features" class="form-control @error('product_features') is-invalid @enderror"></textarea>
                        @error('product_features')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="product_image" class="form-label">Product Image</label>
                        <input type="file" name="product_image" class="form-control" id="image">
                    </div>
                    <img id="showImage" src="{{ (!empty($product->product_image)) ? url('upload/product/' . $product->product_image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="text-end">
                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
            </div>
        </form>
    </div>
</div> <!-- end card -->
</div> <!-- end col -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#myForm').validate({
            rules: {
                product_name: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
               
                product_store: {
                    required: true,
                },
                buying_price: {
                    required: true,
                },
                selling_price: {
                    required: true,
                },
            },
            messages: {
                product_name: {
                    required: 'Please Enter Product Name',
                },
                category_id: {
                    required: 'Please Select Category',
                },
               
                product_store: {
                    required: 'Please Enter Product Quantity',
                },
                buying_price: {
                    required: 'Please Enter Buying Price',
                },
                selling_price: {
                    required: 'Please Enter Selling Price',
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection
