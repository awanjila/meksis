@extends('admin.admin_master')

@section('title') Intelvision Technologies | Blogs @endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<style>
    .blog-image {
        width: 100px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .blog-image:hover {
        transform: scale(1.15);
        box-shadow: 0 4px 16px rgba(1, 174, 239, 0.3);
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
    
    .page-description {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 0;
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
        white-space: nowrap;
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
    
    .blog-title {
        color: #02375f;
        font-weight: 600;
        font-size: 1rem;
        max-width: 300px;
        line-height: 1.4;
    }
    
    .blog-author {
        color: #475569;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .blog-author i {
        color: #01aeef;
        font-size: 0.875rem;
    }
    
    .btn {
        padding: 8px 16px;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        margin-right: 6px;
    }
    
    .btn-info {
        background: linear-gradient(135deg, #01aeef 0%, #0284c7 100%);
        color: white;
    }
    
    .btn-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(1, 174, 239, 0.4);
        color: white;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        color: white;
    }
    
    .alert {
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
    }
    
    .alert i {
        font-size: 1.25rem;
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
    
    .alert-info {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
        border: 1px solid #93c5fd;
    }
    
    .badge-count {
        background: linear-gradient(135deg, #01aeef 0%, #0284c7 100%);
        color: white;
        padding: 6px 16px;
        border-radius: 16px;
        font-weight: 600;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .badge-count i {
        font-size: 0.875rem;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #94a3b8;
    }
    
    .empty-state i {
        font-size: 3.5rem;
        margin-bottom: 16px;
        color: #cbd5e1;
    }
    
    .empty-state h5 {
        color: #64748b;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .empty-state p {
        color: #94a3b8;
        margin: 0;
    }
    
    .row-number {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        color: #475569;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 6px;
        display: inline-block;
        min-width: 36px;
        text-align: center;
    }
    
    .action-buttons {
        display: flex;
        gap: 6px;
        flex-wrap: nowrap;
    }
    
    /* DataTable custom styling */
    .dataTables_wrapper .dataTables_filter input {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px 16px;
        transition: all 0.3s ease;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus {
        outline: none;
        border-color: #01aeef;
        box-shadow: 0 0 0 3px rgba(1, 174, 239, 0.1);
    }
    
    .dataTables_wrapper .dataTables_length select {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 6px 12px;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="header-title">Blog Management</h4>
                        <p class="page-description">
                            Manage all blog posts and articles for Intelvision Technologies
                        </p>
                    </div>
                    <div>
                        <span class="badge-count">
                            <i class="fas fa-blog"></i>
                            {{ $blogs->count() }} {{ Str::plural('Post', $blogs->count()) }}
                        </span>
                    </div>
                </div>
                
                @if (session('message'))
                <div class="alert alert-{{ session('alert-type') }}">
                    <i class="fas fa-{{ session('alert-type') == 'success' ? 'check-circle' : (session('alert-type') == 'danger' ? 'exclamation-circle' : 'info-circle') }}"></i>
                    {{ session('message') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width: 60px;">#</th>
                                <th style="width: 120px;">Image</th>
                                <th style="width: 300px;">Blog Title</th>
                                <th style="width: 180px;">Author</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @forelse($blogs as $key => $item)
                            <tr>
                                <td>
                                    <span class="row-number">{{ $key + 1 }}</span>
                                </td>
                                
                                <td>
                                    <img src="{{ asset($item->image) }}" 
                                         alt="{{ $item->name }}" 
                                         class="blog-image"
                                         onerror="this.src='{{ asset('upload/no_image.jpg') }}'">
                                </td>
                                
                                <td>
                                    <div class="blog-title">{{ $item->name }}</div>
                                </td>
                                
                                <td>
                                    <div class="blog-author">
                                        <i class="fas fa-user-edit"></i>
                                        {{ $item->author ?? 'Unknown' }}
                                    </div>
                                </td>

                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('edit.blog', $item->id) }}" 
                                           class="btn btn-info rounded-pill waves-effect waves-light" 
                                           title="Edit Blog Post"
                                           data-toggle="tooltip">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{ route('delete.blog', $item->id) }}" 
                                           class="btn btn-danger rounded-pill waves-effect waves-light delete" 
                                           title="Delete Blog Post"
                                           data-toggle="tooltip"
                                           data-blog-title="{{ $item->name }}">
                                            <i class="fa fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-blog"></i>
                                        <h5>No Blog Posts Yet</h5>
                                        <p>Start creating blog posts to share security tips and company updates.</p>
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
    // Toastr notifications with custom options
    @if (session('message'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.{{ session('alert-type') }}('{{ session('message') }}');
    @endif

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Delete confirmation with blog title
    $('.delete').on('click', function(e) {
        e.preventDefault();
        var blogTitle = $(this).data('blog-title');
        var deleteUrl = $(this).attr('href');
        
        if (confirm('Are you sure you want to delete "' + blogTitle + '"?\n\nThis action cannot be undone.')) {
            window.location.href = deleteUrl;
        }
    });

    // DataTable initialization with custom options
    $('#state-saving-datatable').DataTable({
        stateSave: true,
        pageLength: 10,
        order: [[0, 'asc']],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search blogs...",
            lengthMenu: "Show _MENU_ posts",
            info: "Showing _START_ to _END_ of _TOTAL_ posts",
            infoEmpty: "No posts available",
            infoFiltered: "(filtered from _MAX_ total posts)",
            zeroRecords: "No matching blog posts found",
            emptyTable: "No blog posts available"
        },
        columnDefs: [
            { orderable: false, targets: [1, 4] } // Disable sorting on Image and Actions columns
        ]
    });
});
</script>

@endsection