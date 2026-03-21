@extends('admin.admin_master')

@section('title') Admin | Edit Home Slider @endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Home Slider Page</h4>

                            @if (session('message'))
                                <div class="alert alert-{{ session('alert-type') }}">
                                    {{ session('message') }}
                                </div>
                            @endif

                          <form method="post" action="{{ route('update.slider') }}" enctype="multipart/form-data" id="sliderForm">
                                @csrf

                                <input type="hidden" name="id" value="{{$homeslide->id}}">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input name="title" class="form-control" type="text" id="title-input" value="{{$homeslide->title}}">
                                        <span class="text-danger" id="title-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                                    <div class="col-sm-10">
                                        <input name="short_title" class="form-control" type="text" id="short-title-input" value="{{$homeslide->short_description}}">
                                        <span class="text-danger" id="short-title-error"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Video Url</label>
                                    <div class="col-sm-10">
                                        <input name="video_url" class="form-control" type="text" id="video-url-input"value="{{$homeslide->video_url}}">
                                        <span class="text-danger" id="video-url-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Slider Image</label>
                                    <div class="col-sm-10">
                                        <input name="home_slide" class="form-control" type="file" id="image-input">
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
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add a Slider HomePage">
                            </form>




                            

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            @if (session('message'))
                toastr.{{ session('alert-type') }}('{{ session('message') }}');
            @endif

            // Form validation and image preview code...


        });
  
        $(document).ready(function(){
            $('#sliderForm').submit(function(e) {
                e.preventDefault();

                // Clear previous error messages
                $('.text-danger').text('');

                // Retrieve form inputs
                var title = $('#title-input').val();
                var shortTitle = $('#short-title-input').val();
                var videoUrl = $('#video-url-input').val();
                var image = $('#image-input').val();

                // Perform validation
                var isValid = true;

                if (title.trim() === '') {
                    $('#title-error').text('Title is required.');
                    isValid = false;
                }

                if (shortTitle.trim() === '') {
                    $('#short-title-error').text('Short Title is required.');
                    isValid = false;
                }

                if (videoUrl.trim() === '') {
                    $('#video-url-error').text('Video URL is required.');
                    isValid = false;
                }

                if (image.trim() === '') {
                    $('#image-error').text('Slider Image is required.');
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


<!-- In this code, I added the Toastr library by including the CSS and JavaScript files from a CDN. I then used `toastr.success()` to display a success message when the form is submitted successfully, and `toastr.error()` to display an error message when the form has validation errors.

``` -->









