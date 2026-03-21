@extends('admin.layout.app')

@section('title')
    Wabestudio | Blog Categories

@endsection

@section('content')


    <!-- Main Content-->
    <div class="main-content side-content pt-0">

        <div class="container-fluid">
            <div class="inner-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">File export Datatables</h6>
                                    <p class="text-muted card-sub-title">Exporting data from a table can often be a key part of a complex application. The Buttons extension for DataTables provides three plug-ins that provide overlapping functionality for data export:</p>
                                </div>
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
                                <div class="table-responsive">
                                    <table id="exportexample" class="table table-bordered border-t0 key-buttons text-nowrap w-100" >
                                        <thead>
                                        <tr>

                                            <th>NAME</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($blogcats as $blogcat)
                                            <tr>

                                                <td>{{$blogcat->name}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
