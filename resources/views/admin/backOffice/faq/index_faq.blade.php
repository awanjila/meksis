@extends('admin.admin_master')

@section('title') Admin | FAQs @endsection
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="header-title mb-0">FAQs</h4>
                    <a href="{{ route('faq.add') }}" class="btn btn-info waves-effect waves-light">
                        <i class="fa fa-plus"></i> Add a FAQ
                    </a>
                </div>

                @if (session('message'))
                    <div class="alert alert-{{ session('alert-type') }}">
                        {{ session('message') }}
                    </div>
                @endif

                <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->question }}</td>
                                <td>{{ $item->sort_order }}</td>
                                <td>
                                    @if($item->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('faq.edit', $item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light" title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{ route('faq.delete', $item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light delete" title="Delete">
                                        <i class="fa fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No FAQs yet. Add your first FAQ.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        @if (session('message'))
            toastr.{{ session('alert-type') }}('{{ session('message') }}');
        @endif

        $('.delete').on('click', function () {
            return confirm('Are you sure you want to delete this FAQ?');
        });
    });
</script>

@endsection
