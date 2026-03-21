
@extends('layouts.admin_app')

@section('title')
    Details {{$customer->name}} Customer
@endsection

@section('content')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


    <div class="col-lg-8 col-xl-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('customer.store')}}" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{$customer->id}}">
                    @csrf
                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Customer Info</h5>
                    <div class="row">


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Customer Name</label>
                                <p class="text-danger">{{ $customer->name }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="useremail" class="form-label">Customer Email </label>
                                <p class="text-danger">{{$customer->email}}</p>
                            </div>
                        </div> <!-- end col -->

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Customer Address</label>
                                <p class="text-danger">{{$customer->address}}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Customer Phone</label>
                                <p class="text-danger">{{$customer->phone}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Customer Location</label>
                                <p class="text-danger">{{$customer->location}}</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <img id="showImage" src="{{(!empty($customer->photo))? asset($customer->photo) : url('upload/no_image.jpg')}}" class="rounded-circle avatar-lg img-thumbnail"
                                 alt="profile-image">
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                </form>



            </div>
        </div> <!-- end card-->

    </div> <!-- end col -->

    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

        });
    </script>



@endsection
