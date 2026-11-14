@extends('admin.admin_master')

@section('title') Admin | About &amp; Homepage Content @endsection
@section('content')
    <script src="https://cdn.tiny.cloud/1/API_KEY/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">About &amp; Homepage Content</h4>

                            @if (session('message'))
                                <div class="alert alert-{{ session('alert-type') }}">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <form method="post" action="{{ route('update.about') }}" enctype="multipart/form-data" id="sliderForm">
                                @csrf
                                <input type="hidden" value="{{ $about->id }}" name="id">

                                <h5 class="mb-3">Homepage About Section</h5>

                                <div class="row mb-3">
                                    <label for="section-label-input" class="col-sm-2 col-form-label">Section Label</label>
                                    <div class="col-sm-10">
                                        <input name="section_label" class="form-control" type="text" id="section-label-input" value="{{ old('section_label', $about->section_label ?? config('home_content.about.section_label')) }}">
                                        <span class="text-danger" id="section-label-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="headline-input" class="col-sm-2 col-form-label">Headline</label>
                                    <div class="col-sm-10">
                                        <input name="headline" class="form-control" type="text" id="headline-input" value="{{ old('headline', $about->headline ?? config('home_content.about.headline')) }}">
                                        <span class="text-danger" id="headline-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="highlight-word-input" class="col-sm-2 col-form-label">Highlight Word</label>
                                    <div class="col-sm-10">
                                        <input name="highlight_word" class="form-control" type="text" id="highlight-word-input" value="{{ old('highlight_word', $about->highlight_word ?? config('home_content.about.highlight_word')) }}">
                                        <span class="text-danger" id="highlight-word-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="paragraph-one-input" class="col-sm-2 col-form-label">Paragraph One</label>
                                    <div class="col-sm-10">
                                        <textarea name="paragraph_one" class="form-control" id="paragraph-one-input" rows="3">{{ old('paragraph_one', $about->paragraph_one ?? config('home_content.about.paragraph_one')) }}</textarea>
                                        <span class="text-danger" id="paragraph-one-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="paragraph-two-input" class="col-sm-2 col-form-label">Paragraph Two</label>
                                    <div class="col-sm-10">
                                        <textarea name="paragraph_two" class="form-control" id="paragraph-two-input" rows="3">{{ old('paragraph_two', $about->paragraph_two ?? config('home_content.about.paragraph_two')) }}</textarea>
                                        <span class="text-danger" id="paragraph-two-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="stat-one-number-input" class="col-sm-2 col-form-label">Stat One Number</label>
                                    <div class="col-sm-10">
                                        <input name="stat_one_number" class="form-control" type="text" id="stat-one-number-input" value="{{ old('stat_one_number', $about->stat_one_number ?? config('home_content.about.stat_one_number')) }}">
                                        <span class="text-danger" id="stat-one-number-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="stat-one-label-input" class="col-sm-2 col-form-label">Stat One Label</label>
                                    <div class="col-sm-10">
                                        <input name="stat_one_label" class="form-control" type="text" id="stat-one-label-input" value="{{ old('stat_one_label', $about->stat_one_label ?? config('home_content.about.stat_one_label')) }}">
                                        <span class="text-danger" id="stat-one-label-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="stat-two-number-input" class="col-sm-2 col-form-label">Stat Two Number</label>
                                    <div class="col-sm-10">
                                        <input name="stat_two_number" class="form-control" type="text" id="stat-two-number-input" value="{{ old('stat_two_number', $about->stat_two_number ?? config('home_content.about.stat_two_number')) }}">
                                        <span class="text-danger" id="stat-two-number-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="stat-two-label-input" class="col-sm-2 col-form-label">Stat Two Label</label>
                                    <div class="col-sm-10">
                                        <input name="stat_two_label" class="form-control" type="text" id="stat-two-label-input" value="{{ old('stat_two_label', $about->stat_two_label ?? config('home_content.about.stat_two_label')) }}">
                                        <span class="text-danger" id="stat-two-label-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="image-input" class="col-sm-2 col-form-label">Homepage Image</label>
                                    <div class="col-sm-10">
                                        <input name="about_image" class="form-control" type="file" id="image-input">
                                        <span class="text-danger" id="image-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg" src="{{ $about->image ? asset($about->image) : asset(config('home_content.about.image')) }}" alt="About image">
                                    </div>
                                </div>
                                <!-- end row -->

                                <h5 class="mb-3 mt-4">About Page Content</h5>

                                <div class="row mb-3">
                                    <label for="title-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input name="title" class="form-control" type="text" id="title-input" value="{{ old('title', $about->title ?? config('home_content.about.title')) }}">
                                        <span class="text-danger" id="title-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="vision-input" class="col-sm-2 col-form-label">Vision</label>
                                    <div class="col-sm-10">
                                        <input name="vision" class="form-control" type="text" id="vision-input" value="{{ old('vision', $about->vision ?? config('home_content.about.vision')) }}">
                                        <span class="text-danger" id="vision-error"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="mission-input" class="col-sm-2 col-form-label">Mission</label>
                                    <div class="col-sm-10">
                                        <input name="mission" class="form-control" type="text" id="mission-input" value="{{ old('mission', $about->mission ?? config('home_content.about.mission')) }}">
                                        <span class="text-danger" id="mission-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="description-input" class="col-sm-2 col-form-label">About Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" id="description-input">{{ old('description', $about->description ?? config('home_content.about.description')) }}</textarea>
                                        <span class="text-danger" id="description-error"></span>
                                    </div>
                                </div>
                                <!-- end row -->

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update About &amp; Homepage">
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
            $('#sliderForm').submit(function(e) {
                e.preventDefault();

                // Clear previous error messages
                $('.text-danger').text('');

                // Retrieve form inputs
                var title = $('#title-input').val().trim();
                var vision = $('#vision-input').val().trim();
                var mission = $('#mission-input').val().trim();

                var editor = (typeof tinymce !== 'undefined') ? tinymce.get('description-input') : null;
                var description = editor ? editor.getContent() : $('#description-input').val();

                // Perform validation
                var isValid = true;

                if (title === '') {
                    $('#title-error').text('Title is required.');
                    isValid = false;
                }

                if (vision === '') {
                    $('#vision-error').text('Vision Statement is required.');
                    isValid = false;
                }

                if (mission === '') {
                    $('#mission-error').text('Mission Statement is required.');
                    isValid = false;
                }

                if (description === '') {
                    $('#description-error').text('About Description is required.');
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

            $('#image-input').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            });

            // Initialize TinyMCE on the description textarea when it is available
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: '#description-input',
                    height: 300,
                    plugins: 'advlist autolink lists link image charmap print preview anchor',
                    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link',
                    images_upload_url: '/your-upload-handler-url',
                    images_upload_credentials: true,
                    images_upload_handler: function (blobInfo, success, failure) {
                        var xhr, formData;
                        xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', '/your-upload-handler-url');
                        xhr.onload = function() {
                            var json;

                            if (xhr.status !== 200) {
                                failure('HTTP Error: ' + xhr.status);
                                return;
                            }

                            json = JSON.parse(xhr.responseText);

                            if (!json || typeof json.location !== 'string') {
                                failure('Invalid JSON: ' + xhr.responseText);
                                return;
                            }

                            success(json.location);
                        };
                        formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        xhr.send(formData);
                    }
                });
            }
        });
    </script>
@endsection
