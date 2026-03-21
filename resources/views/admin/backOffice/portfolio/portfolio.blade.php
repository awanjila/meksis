@extends('admin.admin_master')

@section('title')
    Admin | Portfolios
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
                        <h3 class="card-title">Portfolios</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPortfolioModal">
                                <i class="fas fa-plus"></i> Add Portfolio
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Images</th>
                                    <th>Featured</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($portfolios as $portfolio)
                                <tr>
                                    <td>{{ $portfolio->id }}</td>
                                    <td>{{ $portfolio->title }}</td>
                                    <td>{{ $portfolio->category->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($portfolio->images && count($portfolio->images) > 0)
                                            <img src="{{ asset($portfolio->images[0]) }}" alt="Portfolio Image" style="width: 50px; height: 50px; object-fit: cover;">
                                            @if(count($portfolio->images) > 1)
                                                <span class="badge badge-info">+{{ count($portfolio->images) - 1 }}</span>
                                            @endif
                                        @else
                                            No Images
                                        @endif
                                    </td>
                                    <td>
                                        @if($portfolio->featured)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-secondary">No</span>
                                        @endif
                                    </td>
                            
                                    <td>
                                        <a href="{{ route('edit.portfolio', $portfolio->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('delete.portfolio', $portfolio->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this portfolio?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No portfolios found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Portfolio Modal -->
    <div class="modal fade" id="addPortfolioModal" tabindex="-1" role="dialog" aria-labelledby="addPortfolioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('store.portfolio') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPortfolioModalLabel">Add Portfolio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="images">Images (Multiple)</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                            <small class="form-text text-muted">You can select multiple images.</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="live_url">Live URL</label>
                                    <input type="url" class="form-control" id="live_url" name="live_url">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tech_stack">Tech Stack (JSON)</label>
                                    <input type="text" class="form-control" id="tech_stack" name="tech_stack" placeholder='["Laravel", "Vue", "MySQL"]'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="key_features">Key Features</label>
                            <textarea class="form-control" id="key_features" name="key_features" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1">
                                <label class="form-check-label" for="featured">
                                    Featured Portfolio
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Portfolio</button>
                    </div>
                </form>
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