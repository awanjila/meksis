@extends('admin.admin_master')

@section('title')
Admin | Edit Service
@endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
                                <h4 class="card-title">Edit Product </h4>

                                @if (session('message'))
                                <div class="alert alert-{{ session('alert-type') }}">
                                    {{ session('message') }}
                                </div>
                                @endif

                                <form method="post" action="{{ route('update.service') }}" enctype="multipart/form-data" id="sliderForm">
                                    @csrf


                                    <input name="id" class="form-control" type="hidden" id="title-input" value="{{$service->id}}">
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input name="title" class="form-control" type="text" id="title-input" value="{{$service->name}}">
                                            <span class="text-danger" id="title-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                    <div class="row mb-3">
                                        <label for="title-input" class="col-sm-2 col-form-label">Meta Title</label>
                                        <div class="col-sm-10">
                                            <input name="meta_title" class="form-control" type="text" id="title-input"  value="{{$service->meta_title}}">
                                            <span class="text-danger" id="title-error"></span>
                                        </div>
                                    </div>

                                <div class="row mb-3">
                                        <label for="meta-description-input" class="col-sm-2 col-form-label">Meta Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="meta_description" class="form-control" id="meta-description-input">{{$service->meta_description}}</textarea>
                                            <span class="text-danger" id="meta-description-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" class="form-control" id="description-input">{{$service->description}}</textarea>
                                            <span class="text-danger" id="description-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Service Image</label>
                                        <div class="col-sm-10">
                                            <input name="image" class="form-control" type="file" id="image-input">
                                            
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($service->image))? url($service->image):url('upload/no_image.jpg') }}" alt="Service image preview">
                                        </div>
                                    </div>
                                    <!-- end row -->
                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Service">
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

                // Sync TinyMCE content back to textarea
                if (tinymce) {
                    tinymce.triggerSave();
                }

                // Clear previous error messages
                $('.text-danger').text('');

                // Retrieve form inputs
                var title = $('#title-input').val();
                var description = $('#description-input').val();
                var metaDescription = $('#meta-description-input').val();

                // Perform validation
                var isValid = true;

                if (title.trim() === '') {
                    $('#title-error').text('Title is required.');
                    isValid = false;
                }

                if (description.trim() === '') {
                    $('#description-error').text('Description is required.');
                    isValid = false;
                }

                if (metaDescription.trim() === '') {
                    $('#meta-description-error').text('Meta description is required.');
                    isValid = false;
                }

                if (isValid) {
                    toastr.success('Form submitted successfully.');
                    this.submit();
                } else {
                    toastr.error('Please fill in all the required fields.');
                }
            });

            $('#image-input').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
            
            tinymce.init({
                selector: '#description-input',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
                menubar: false,
                toolbar_mode: 'floating',
                height: 300
            });
        });
    </script>
    @endsection
