@extends('admin.admin_master')

@section('title') Admin | FAQ Settings @endsection
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">FAQ Section Settings</h4>

                @if (session('message'))
                    <div class="alert alert-{{ session('alert-type') }}">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="post" action="{{ route('faq.settings.update') }}">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Section Title</label>
                        <div class="col-sm-10">
                            <input name="title" class="form-control" type="text" value="{{ old('title', $settings->title) }}" maxlength="255">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Section Subtitle</label>
                        <div class="col-sm-10">
                            <input name="subtitle" class="form-control" type="text" value="{{ old('subtitle', $settings->subtitle) }}" maxlength="255">
                            @error('subtitle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update FAQ Settings">
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
