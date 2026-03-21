
@extends('admin.admin_master')
@section('content')

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">


            <div class="row">
            <div class="col-lg-4">
                <div class="card">

                    <img class="card-img-top img-fluid" src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">{{$adminData->name}}'s Profile </h4>
                        <p class="card-text">Name: {{$adminData->name}}</p>
                        <p class="card-text">Email: {{$adminData->email}}</p>


                        <a href="{{route('edit.profile')}}" class="btn btn-info btn-rounded waves-effect waves-light">Edit Profile</a>

                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;
            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;
            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;
            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
        @endif
    </script>


    @stack('script')



@endsection
