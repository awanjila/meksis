@extends('admin.admin_master')

@section('title') Intelvison Technologies | Services @endsection
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Index Services</h4>
                <p class="text-muted font-13 mb-4">
                    
                </p>
                @if (session('message'))
                <div class="alert alert-{{ session('alert-type') }}">
                    {{ session('message') }}
                </div>
                @endif

                <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                    <thead>
                        <tr><th>#</th>
                      
                            <th>Title</th>
                           
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                     @foreach($blog_cats as $key=>$item)
                     
                     <tr>
                        <td>{{$key+1}}</td>

                     
                        
                        <td>{{$item->name}}</td>
                      

                        <td>
                            <a href="{{route('delete.blog.category', $item->id)}}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete"title="Delete"><i class="fa fa-trash-alt"></i></a>
                            
                        </td>
                        
                    </tr>

                    @endforeach
                </tbody>
            </table>

        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
</div>
<!-- end row-->

<script type="text/javascript">
    
   $(document).ready(function() {
    @if (session('message'))
    toastr.{{ session('alert-type') }}('{{ session('message') }}');
    @endif

            // Form validation and image preview code...


});
</script>

@endsection

