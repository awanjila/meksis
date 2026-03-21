@extends('admin.layout.app')

@section('title')
    Wabe - Studio | Create A Product

@endsection

@section('content')

    <!-- Main Content-->
    <div class="main-content side-content pt-0">

        <div class="container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-header-1">
                        <h1 class="main-content-title tx-30">Product</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Form-Elements</li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->



                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                </div>
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    <h6 class="main-content-label mb-1">Create a product form</h6>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                        <form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="form-group">
                                                                <label class="">Name </label>
                                                                <input class="form-control" required="" type="text" name="name">
                                                            </div>


                                                            <div class="form-group">
                                                                <label class="">Slug</label>
                                                                <div class="pos-relative">
                                                                    <input class="form-control pd-r-80" required="" type="text" name="slug">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="">Image</label>
                                                                <div class="pos-relative">
                                                                    <input class="form-control pd-r-80" type="file" name="product_image">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="">Description </label>
                                                                <textarea class="form-control"  type="text"name="description"> </textarea>
                                                            </div>
                                                                <div class="form-group">
                                                                    <label class="">Client </label>
                                                                    <textarea class="form-control" type="text"name="client"> </textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="">Demo URL </label>
                                                                    <textarea class="form-control"type="text"name="url"> </textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="custom-file">
                                                                        <label class="custom-file-label" for="customFile">Choose more product images</label>
                                                                        <input type="file" class="custom-file-input" id="customFile"  multiple name="body_images[]"  >
                                                                    </div>
                                                                </div>
                                                            <input type="submit" name="submitbutton" class="btn btn-default" value="Submit">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>
    </div>
    <!-- End Main Content-->

@endsection
{{--@section('scripts')--}}
{{--    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}
{{--    <script>tinymce.init({selector:'textarea'});</script>--}}
{{--    <script>--}}

{{--        tinymce.init({--}}

{{--            selector: 'textarea',--}}
{{--            entity_encoding : "raw",--}}
{{--        });--}}
{{--    </script>--}}


{{--@endsection--}}
