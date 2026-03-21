@extends('admin.layout.app')

@section('title')
    WabeStudio | Edit {{$service->name}}

@endsection
@section('content')
    <div class="main-content side-content pt-0">
    <div class="container-fluid" id="container-wrapper">
        <div class="row">

            <div class="col-lg-8">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Edit {{$service->name}}</h6>
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
                        <form action="/update_service/{{$service->id}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="form-group">

                                <input type="hidden"  class="form-control" id="id" aria-describedby="emailHelp"
                                       value="{{$service->id}}">
                            </div>

                            <div class="form-group">
                                <label for="name" >Name</label>
                                <input type="name" name="name" class="form-control" id="name" aria-describedby="emailHelp"
                                       value="{{$service->name}}">
                            </div>
                            <div class="form-group">
                                <label for="name" >Slug</label>
                                <input type="name" name="slug" class="form-control" id="name" aria-describedby="emailHelp"
                                       value="{{$service->slug}}">
                            </div>


                            <div class="form-group">
                                <label for="name" >Description</label>
                                <textarea type="text" name="description" class="form-control" id="name" aria-describedby="emailHelp"
                                          value="{!!  $service->description!!}"></textarea>
                            </div>

                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="cover_image">
                                    <label class="custom-file-label" for="customFile">Choose a cover image for the service</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <p>Cover :</p>
                <form action="/delete_service_cover_image/{{$service->id}}" method="post">
                    <button class="btn text-danger">X</button>
                    @csrf
                    @method('delete')
                </form>
                <img src="/cover_image/{{$service->cover_image}}" class="img-responsive" style="max-height: 100px; max-width: 100px" alt="{{$service->name}}" srcset="">

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
