@extends('admin.admin_master')

@section('title') Service | Home Slider @endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea', // Select the desired textarea(s)
            plugins: 'advlist autolink lists link image imagetools charmap print preview',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link image',
            // Add more configuration options as needed
        });
    </script>
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Service Page </h4>

                            <form method="post" action="{{ route('store.service') }}" enctype="multipart/form-data">
                                @csrf
{{--                                <input type="hidden" name="id" value="{{$about->id}}">--}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input name="title" class="form-control" type="text"  id="example-text-input">
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="short_description" class="form-control" type="text"  id="example-text-input"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">long Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="long_description" class="form-control" type="text"  id="example-text-input"></textarea>
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Header Image </label>
                                    <div class="col-sm-10">
                                        <input name="service_image" class="form-control" type="file"  id="image">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($about->about_image))? url($about->about_image):url('upload/no_image.jpg') }}" alt="Card image cap">
                                    </div>
                                </div>
                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Save Service">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>



@endsection

@section('scripts')

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    {{--        <script>tinymce.init({selector:'textarea'});</script>--}}
    <script>

        tinymce.init({

            selector: 'textarea',
            entity_encoding : "raw",
            toolbar:
                "undo redo | styleselect | fontselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image",
            plugins: 'image imagetools',
            imagetools_cors_hosts: ['mydomain.com', 'otherdomain.com'],
            imagetools_proxy: 'proxy.php'
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>

@endsection


