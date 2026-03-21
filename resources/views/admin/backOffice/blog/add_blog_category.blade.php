@extends('admin.admin_master')

@section('title') Admin | Add a Blog Post Category | Wabe Digital Agency  @endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Add a Blog Post Category</h4>

                                @if (session('message'))
                                    <div class="alert alert-{{ session('alert-type') }}">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                <form method="post" action="{{ route('store.blog.category') }}" enctype="multipart/form-data" id="sliderForm">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input name="title" class="form-control" type="text" id="title-input">
                                            <span class="text-danger" id="title-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" class="form-control" type="text" id="description-input"></textarea>
                                            <span class="text-danger" id="description-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Add a Blog Category">
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
                

                // Perform validation
                var isValid = true;

                if (title.trim() === '') {
                    $('#title-error').text('Title is required.');
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

            tinymce.init({
                selector: '#description-input',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
                height: 300
            });
        });
    </script>
@endsection
