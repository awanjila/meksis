@extends('admin.layout.app')

@section('title')
Wabestudio | Edit {{$product->name}}

@endsection
@section('content')
    <div class="main-content side-content pt-0">
    <div class="container-fluid" id="container-wrapper">
        <div class="row">

            <div class="col-lg-8">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Edit {{$product->name}}</h6>
                    </div>

                    <div class="card-body">

                        @if (Session::has('status'))
                            <div class="alert alert-success">

                                {{Session::get('status')}}

                            </div>
                        @endif
                        @if (Session::has('status1'))
                            <div class="alert alert-danger">

                                {{Session::get('status1')}}

                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="/update_product/{{$product->id}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="form-group">

                                <input type="hidden"  class="form-control" id="id" aria-describedby="emailHelp"
                                       value="{{$product->id}}">
                            </div>

                            <div class="form-group">
                                <label for="name" >Name</label>
                                <input type="name" name="name" class="form-control" id="name" aria-describedby="emailHelp"
                                       value="{{$product->name}}">
                            </div>
                            <div class="form-group">
                                <label for="name" >Slug</label>
                                <input type="name" name="slug" class="form-control" id="name" aria-describedby="emailHelp"
                                       value="{{$product->slug}}">
                            </div>

                            <div class="form-group">
                                <label for="name" >Description</label>
                                <textarea type="text" name="description" class="form-control" id="name" aria-describedby="emailHelp"
                                          value="{{$product->description}}"> {{$product->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="">Client </label>
                                <textarea class="form-control" type="text"name="client" value="{{ $product->client}}"> {{ $product->client}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="">Demo URL </label>
                                <textarea class="form-control"type="text"name="url" value="{{$product->url}}">{{$product->url}} </textarea>
                            </div>

                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="cover_image">
                                    <label class="custom-file-label" for="customFile">Choose a cover image for the Product</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <label class="custom-file-label" for="customFile">Choose more product images</label>
                                    <input type="file" class="custom-file-input" id="customFile"  multiple name="body_images[]"  >
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <p>Cover :</p>
                <form action="/product_cover_image/{{$product->id}}" method="post">
                    <button class="btn text-danger">X</button>
                    @csrf
                    @method('delete')
                </form>
                <img src="/cover_image/{{$product->cover_image}}" class="img-responsive" style="max-height: 100px; max-width: 100px" alt="{{$product->name}}" srcset="">

                <p>Images :</p>

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


@endsection
