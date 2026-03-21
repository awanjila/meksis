@extends('client.layout.app')
@section('title')
{{$blog->name}}  | {{$blog->meta_title}}
@endsection

@section('meta_title')

    {{$blog->meta_title}}
@endsection

@section('meta_description')

    {{$blog->meta_description}}

@endsection
<!-- subheader -->
@section('content')

<blog-details :slug="'{{ $blog->slug }}'"> </blog-details>
<!-- Main content Start -->

    @endsection
