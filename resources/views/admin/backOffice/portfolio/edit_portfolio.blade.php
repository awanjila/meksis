@extends('admin.admin_master')

@section('title')
    Admin | Edit Portfolio
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
                        <h3 class="card-title">Edit Portfolio</h3>
                        <div class="card-tools">
                            <a href="{{ route('portfolio') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Portfolios
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.portfolio') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $portfolio->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $portfolio->title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select class="form-control" id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $portfolio->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $portfolio->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="images">Add More Images (Multiple)</label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                                <small class="form-text text-muted">You can select multiple images. Existing images will be kept.</small>
                                @if($portfolio->images && count($portfolio->images) > 0)
                                    <div class="mt-2">
                                        <label>Current Images:</label>
                                        <div class="d-flex flex-wrap">
                                            @foreach($portfolio->images as $image)
                                                <div class="mr-2 mb-2">
                                                    <img src="{{ asset($image) }}" alt="Portfolio Image" style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ddd;">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="live_url">Live URL</label>
                                        <input type="url" class="form-control" id="live_url" name="live_url" value="{{ $portfolio->live_url }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tech_stack">Tech Stack (JSON)</label>
                                        <input type="text" class="form-control" id="tech_stack" name="tech_stack" value='{{ $portfolio->tech_stack ? json_encode($portfolio->tech_stack) : '' }}' placeholder='["Laravel", "Vue", "MySQL"]'>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="key_features">Key Features</label>
                                <textarea class="form-control" id="key_features" name="key_features" rows="2">{{ $portfolio->key_features }}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" {{ $portfolio->featured ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">
                                        Featured Portfolio
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Portfolio</button>
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
            selector: '#description, #key_features',
            height: 200,
            menubar: false,
            plugins: 'lists link image code',
            toolbar: 'bold italic underline | bullist numlist | link image | code',
            content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; }'
        });
    </script>

@endsection