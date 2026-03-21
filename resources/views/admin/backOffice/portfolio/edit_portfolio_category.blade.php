@extends('admin.admin_master')

@section('title')
    Admin | Edit Portfolio Category
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Portfolio Category</h3>
                        <div class="card-tools">
                            <a href="{{ route('portfolio.category') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Categories
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.portfolio.category') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5">{{ $category->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if(session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        tinymce.init({
            selector: '#description',
            height: 200,
            menubar: false,
            plugins: 'lists link image code',
            toolbar: 'bold italic underline | bullist numlist | link image | code',
            content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; }'
        });
    </script>

@endsection