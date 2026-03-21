@extends('admin.admin_master')

@section('title') Intelvision Technologies | Services @endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<style>
    .service-image {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .service-image:hover {
        transform: scale(1.1);
    }
    
    .service-description {
        max-width: 400px;
        line-height: 1.5;
        color: #64748b;
    }
    
    .card {
        border: 1px solid rgba(1, 174, 239, 0.1);
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        border-radius: 12px;
    }
    
    .card-body {
        padding: 24px;
    }
    
    .header-title {
        color: #02375f;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 8px;
    }
    
    .table thead th {
        background: linear-gradient(135deg, #01aeef 0%, #0284c7 100%);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 14px 12px;
    }
    
    .table tbody td {
        vertical-align: middle;
        padding: 16px 12px;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
        background-color: #f8fafc;
        box-shadow: 0 2px 8px rgba(1, 174, 239, 0.1);
    }
    
    .btn {
        padding: 8px 16px;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-blue {
        background: linear-gradient(135deg, #01aeef 0%, #0284c7 100%);
        color: white;
    }
    
    .btn-blue:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(1, 174, 239, 0.3);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
    
    .alert {
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border: 1px solid #6ee7b7;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #991b1b;
        border: 1px solid #fca5a5;
    }
    
    .service-title {
        color: #02375f;
        font-weight: 600;
        font-size: 1rem;
    }
    
    .badge-count {
        background: linear-gradient(135deg, #01aeef 0%, #0284c7 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="header-title">Services Management</h4>
                        <p class="text-muted mb-0">
                            Manage all Intelvision security services
                        </p>
                    </div>
                    <div>
                        <span class="badge-count">{{ $services->count() }} Services</span>
                    </div>
                </div>
                
                @if (session('message'))
                <div class="alert alert-{{ session('alert-type') }}">
                    <i class="fas fa-{{ session('alert-type') == 'success' ? 'check-circle' : 'exclamation-circle' }}"></i>
                    {{ session('message') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width: 60px;">#</th>
                                <th style="width: 100px;">Image</th>
                                <th style="width: 200px;">Service Name</th>
                                <th>Description</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($item->image) }}" 
                                         alt="{{ $item->name }}" 
                                         class="service-image"
                                         onerror="this.src='{{ asset('upload/no_image.jpg') }}'">
                                </td>
                                <td>
                                    <span class="service-title">{{ $item->name }}</span>
                                </td>
                                <td>
                                    <div class="service-description">
                                        {{ Str::limit(strip_tags($item->description), 120, '...') }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('edit.service', $item->id) }}" 
                                       class="btn btn-blue rounded-pill waves-effect waves-light" 
                                       title="Edit Service"
                                       data-toggle="tooltip">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{ route('delete.service', $item->id) }}" 
                                       class="btn btn-danger rounded-pill waves-effect waves-light" 
                                       id="delete" 
                                       title="Delete Service"
                                       data-toggle="tooltip"
                                       onclick="return confirm('Are you sure you want to delete {{ $item->name }}?')">
                                        <i class="fa fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <p>No services found. Add your first service to get started.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script type="text/javascript">
$(document).ready(function() {
    // Toastr notifications
    @if (session('message'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };
    toastr.{{ session('alert-type') }}('{{ session('message') }}');
    @endif

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // DataTable initialization with custom styling
    $('#state-saving-datatable').DataTable({
        stateSave: true,
        pageLength: 10,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search services..."
        }
    });
});
</script>

@endsection