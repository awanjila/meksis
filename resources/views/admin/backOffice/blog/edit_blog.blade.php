@extends('admin.admin_master')

@section('title') Admin | Edit Blog Post | Meksis Engineering @endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Blog Post</h4>

                        @if (session('message'))
                        <div class="alert alert-{{ session('alert-type') }}">
                            {{ session('message') }}
                        </div>
                        @endif

                        <form method="post" action="{{ route('update.blog') }}" enctype="multipart/form-data" id="sliderForm">
                            @csrf

                            <input name="id" value="{{$blog->id}}" type="hidden">
                            
                            <div class="row mb-3">
                                <label for="title-input" class="col-sm-2 col-form-label">Blog Title</label>
                                <div class="col-sm-10">
                                    <input name="name" class="form-control" type="text" id="title-input" value="{{$blog->name}}">
                                    <span class="text-danger" id="title-error"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="meta-title-input" class="col-sm-2 col-form-label">Meta Title</label>
                                <div class="col-sm-10">
                                    <input name="meta_title" class="form-control" type="text" id="meta-title-input" value="{{$blog->meta_title}}">
                                    <small class="text-muted">SEO title for search engines</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category-select" class="col-sm-2 col-form-label">Blog Category</label>
                                <div class="col-sm-10">
                                    <select name="category" id="category-select" class="form-select" 
                                        style="color: #333; background-color: #fff; border: 1px solid #ced4da;">
                                        <option value="">Select Blog Category</option>
                                        @foreach($blog_cats as $cat)
                                        <option value="{{$cat->id}}" {{ $cat->id == $blog->blog_category_id ? 'selected' : '' }}>{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="category-error"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="author-input" class="col-sm-2 col-form-label">Blog Author</label>
                                <div class="col-sm-10">
                                    <input name="author" class="form-control" type="text" id="author-input" value="{{$blog->author}}">
                                    <span class="text-danger" id="author-error"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description-input" class="col-sm-2 col-form-label">Blog Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" type="text" id="description-input">{{$blog->description}}</textarea>
                                    <span class="text-danger" id="description-error"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="meta-description-input" class="col-sm-2 col-form-label">Meta Description</label>
                                <div class="col-sm-10">
                                    <textarea name="meta_description" class="form-control" id="meta-description-input" rows="3">{{$blog->meta_description}}</textarea>
                                    <small class="text-muted">SEO description for search engines</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image-input" class="col-sm-2 col-form-label">Blog Image</label>
                                <div class="col-sm-10">
                                    <input name="image" class="form-control" type="file" id="image-input">
                                    <span class="text-danger" id="image-error"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Current Image</label>
                                <div class="col-sm-10">
                                    @if($blog->image)
                                    <img id="showImage" class="rounded avatar-lg" src="{{ url($blog->image) }}" alt="Blog image" style="max-width: 200px;">
                                    @else
                                    <img id="showImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="No image">
                                    @endif
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog">
                        </form>
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

            $('.text-danger').text('');

            var title = $('#title-input').val();
            var author = $('#author-input').val();
            var category = $('#category-select').val();

            var isValid = true;

            if (title.trim() === '') {
                $('#title-error').text('Title is required.');
                isValid = false;
            }

            if (author.trim() === '') {
                $('#author-error').text('Author is required.');
                isValid = false;
            }

            if (category === '') {
                $('#category-error').text('Please select a category.');
                isValid = false;
            }

            if (isValid) {
                toastr.success('Form submitted successfully.');
                this.submit();
            } else {
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
