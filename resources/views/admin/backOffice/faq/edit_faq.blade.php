@extends('admin.admin_master')

@section('title') Admin | Edit FAQ @endsection
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Edit FAQ</h4>

                @if (session('message'))
                    <div class="alert alert-{{ session('alert-type') }}">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="post" action="{{ route('faq.update') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $faq->id }}">

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-10">
                            <input name="question" class="form-control" type="text" value="{{ old('question', $faq->question) }}" maxlength="255">
                            @error('question')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Answer</label>
                        <div class="col-sm-10">
                            <textarea name="answer" class="form-control" rows="6">{{ old('answer', $faq->answer) }}</textarea>
                            @error('answer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Sort Order</label>
                        <div class="col-sm-10">
                            <input name="sort_order" class="form-control" type="number" min="0" value="{{ old('sort_order', $faq->sort_order) }}">
                            @error('sort_order')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update FAQ">
                            <a href="{{ route('faq.index') }}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        @if (session('message'))
            toastr.{{ session('alert-type') }}('{{ session('message') }}');
        @endif
    });
</script>

@endsection
