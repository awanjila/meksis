@extends('admin.admin_master')

@section('title')
    @section('title') Admin | Add a Blog Post  | Intelvision   @endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@php
   
    $blogcats =App\Models\BackOffice\BlogCategory::latest()->get();
  

    @endphp
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>

    <!-- <div class="content-page"> -->
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Add a Blog Post </h4>

                                @if (session('message'))
                                <div class="alert alert-{{ session('alert-type') }}">
                                    {{ session('message') }}
                                </div>
                                @endif

                                <form method="post" action="{{ route('store.blog') }}" enctype="multipart/form-data" id="sliderForm">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="title-input" class="col-sm-2 col-form-label">Blog Title</label>
                                        <div class="col-sm-10">
                                            <input name="name" class="form-control" type="text" id="title-input">
                                            <span class="text-danger" id="title-error"></span>
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
                                        <label for="category-select" class="col-sm-2 col-form-label">Blog Category Name</label>
                                        <div class="col-sm-10">
                                            <select name="category" id="category-select" class="form-select" aria-label="Default select example"
                                                style="color: #333; background-color: #fff; border: 1px solid #ced4da;"
                                            >
                                                <option value="" style="color: #6c757d;">Select Blog Category</option>
                                                @foreach($blogcats as $cat)
                                                <option value="{{$cat->id}}" style="color: #333;">{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="category-error"></span>
                                        </div>
                                    </div>

                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="author-input" class="col-sm-2 col-form-label">Blog Author</label>
                                        <div class="col-sm-10">
                                            <input name="author" class="form-control" type="text" id="author-input">
                                            <span class="text-danger" id="author-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="description-input" class="col-sm-2 col-form-label">Blog Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" class="form-control" type="text" id="description-input"></textarea>
                                            <span class="text-danger" id="description-error"></span>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="meta_description-input" class="col-sm-2 col-form-label">Meta Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="meta_description" class="form-control" type="text" id="description-input"></textarea>
                                            <span class="text-danger" id="description-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="image-input" class="col-sm-2 col-form-label">Blog Image</label>
                                        <div class="col-sm-10">
                                            <input name="image" class="form-control" type="file" id="image-input">
                                            <span class="text-danger" id="image-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap">
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Add a Blog ">
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
                var title = $('#title-input').val();
                var author = $('#author-input').val();
                var category = $('#category-select').val();
                // var description = $('#description-input').val();

    // Perform validation
                var isValid = true;

                if (title.trim() === '') {
                    $('#title-error').text('Title is required.');
                    isValid = false;
                }

                if (author.trim() === '') {
                    $('#author-error').text('Author is required.');
                    isValid = false;
                }

                // if (description.trim() === '') {
                //     $('#description-error').text('Description is required.');
                //     isValid = false;
                // }

                if (category === '') {
                    $('#category-error').text('Please select a category.');
                    isValid = false;
                }

                if (isValid) {
        // Show success message using Toastr
                    toastr.success('Form submitted successfully.');

        // Submit the form if valid
                    this.submit();
                } else {
        // Show error message using Toastr
                    toastr.error('Please fill in all the required fields.');
                }
            });


            $('#image-input').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });

            
        });
    </script>
    @endsection
