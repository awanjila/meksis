
@extends('admin.admin_master')

@section('title')
Add category
@endsection

@section('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


<div class="col-lg-8 col-xl-8">
    <div class="card">
       <form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <label for="category_name">Category Name</label>
    <input type="text" name="category_name" id="category_name" required>
    
    <label for="category_description">Category Description</label>
    <textarea name="category_description" id="category_description"></textarea>
    
    <label for="parent_category">Parent Category</label>
    <select name="parent_id" id="parent_category">
        <option value="">No Parent Category (Top-Level)</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach
    </select>

    <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="product_image" class="form-label">Product Image</label>
                        <input type="file" name="product_image" class="form-control" id="image">
                    </div>
                    <img id="showImage" src="{{ (!empty($product->product_image)) ? url('upload/product/' . $product->product_image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                </div> <!-- end col -->
    
    <button type="submit">Add Category</button>
</form>

    </div> <!-- end card-->

</div> <!-- end col -->




@endsection
