@extends('admin.admin_master')

@section('title')
    Admin | Add a Pricing Package
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add a Pricing Package</h4>

                                @if (session('message'))
                                    <div class="alert alert-{{ session('alert-type') }}">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                <form method="post" action="{{ route('store.pricing') }}" enctype="multipart/form-data" id="sliderForm">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input name="name" class="form-control" type="text" id="name-input">
                                            <span class="text-danger" id="name-error"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="category-select" class="col-sm-2 col-form-label">Package</label>
                                        <div class="col-sm-10">
                                            <select name="category" id="category-select" class="form-select" aria-label="Default select example">
                                                <option value="">Select Price Package</option>
                                                @foreach($pricepackage as $cat)
                                                <option value="{{$cat->id}}">{{$cat->title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="category-error"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Pricing</label>
                                        <div class="col-sm-10">
                                            <input name="pricing" class="form-control" type="text" id="pricing-input">
                                            <span class="text-danger" id="pricing-error"></span>
                                        </div>
                                    </div>

                                    

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Duration</label>
                                        <div class="col-sm-10">
                                            <input name="duration" class="form-control" type="text" id="duration-input">
                                            <span class="text-danger" id="duration-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="title-input" class="col-sm-2 col-form-label">Meta Title</label>
                                        <div class="col-sm-10">
                                            <input name="meta_title" class="form-control" type="text" id="title-input">
                                            <span class="text-danger" id="title-error"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" class="form-control" id="description-input"></textarea>
                                            <span class="text-danger" id="description-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="meta_description-input" class="col-sm-2 col-form-label">Meta Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="meta_description" class="form-control" type="text" id="meta-description-input"></textarea>
                                            <span class="text-danger" id="description-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->


                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Add a Price range">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            @if (session('message'))
                toastr.{{ session('alert-type') }}('{{ session('message') }}');
            @endif

            $('#sliderForm').submit(function(e) {
                e.preventDefault();

                // Clear previous error messages
                $('.text-danger').text('');

                // Retrieve form inputs
                var title = $('#name-input').val();
                // var description = $('#description-input').val();
               

                // Perform validation
                var isValid = true;

                if (title.trim() === '') {
                    $('#name-error').text('Name is required.');
                    isValid = false;
                }

                // if (description.trim() === '') {
                //     $('#description-error').text('Description is required.');
                //     isValid = false;
                // }

              

                if (isValid) {
                    toastr.success('Form submitted successfully.');
                    this.submit();
                } else {
                    toastr.error('Please fill in all the required fields.');
                }
            });

        
            
            
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  
        });
    </script>
@endsection
