
@extends('admin.admin_master')

@section('title')
    Add Employee
@endsection

@section('content')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea', // Apply TinyMCE to all textareas
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>


    <div class="col-lg-8 col-xl-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('category.update')}}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{$category->id}}">
                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>Edit Category</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="name" value="{{$category->category_name}}">

                                @error('category_name')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Title * Data about the Title</label>
            <textarea class="form-control" name="meta_title" id="meta_title" placeholder="Add Meta Title" required>{{ $category->meta_title }}</textarea>
          </div>

          <div class="mb-3">
            <label for="category_description" class="form-label">Category Description</label>
            <textarea name="category_description" class="form-control @error('category_description') is-invalid @enderror" id="category_description" required>{{ $category->category_description }}</textarea>
            @error('category_description')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="parent_category" class="form-label">Parent Category</label>
            <select name="parent_id" id="parent_category" class="form-control">
              <option value="">Default</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="category_image" class="form-label">Category Image</label>
            <input type="file" name="category_image" class="form-control" id="category_image">
            <img id="showImage" src="{{ (!empty($category->category_image)) ? url('upload/category/' . $category->category_image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail mt-2" alt="profile-image">
          </div>
                        </div>
                    </div> <!-- end row -->


                    <div class="text-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i>Update</button>
                    </div>
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
