@extends('admin.admin_master')

@section('title')
Admin | Edit Service
@endsection

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

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Price Package</h4>

                            @if (session('message'))
                            <div class="alert alert-{{ session('alert-type') }}">
                                {{ session('message') }}
                            </div>
                            @endif

                            <form method="post" action="{{ route('update.pricing.package') }}" enctype="multipart/form-data" id="pricingForm">
                                @csrf
                                <input name="id" type="hidden" value="{{ $price_package->id }}">

                                <div class="row mb-3">
                                    <label for="title-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input name="name" class="form-control" type="text" value="{{ $price_package->title }}">
                                        <span class="text-danger" id="title-error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="pricing-input" class="col-sm-2 col-form-label">Price Range</label>
                                    <div class="col-sm-10">
                                        <input name="pricing" class="form-control" type="text" value="{{ $price_package->price_range }}">
                                        <span class="text-danger" id="pricing-error"></span>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="description-input" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control">{{ $price_package->description }}</textarea>
                                        <span class="text-danger" id="description-error"></span>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Price Package">
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

        $('#pricingForm').submit(function(e) {
            // Perform validation
            var isValid = true;

            if ($('input[name="name"]').val().trim() === '') {
                $('#title-error').text('Title is required.');
                isValid = false;
            }
            if ($('textarea[name="description"]').val().trim() === '') {
                $('#description-error').text('Description is required.');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                toastr.error('Please fill in all the required fields.');
            }
        });
    });
</script>
@endsection
