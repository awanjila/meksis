@extends('client.layout.app')

@section('title')
    {{$service->name}}  |  {{$service->meta_title}}
@endsection

@section('meta_title')
    {{$service->meta_title}}
@endsection

@section('meta_description')
    {{$service->meta_description}}
@endsection

@section('content')

<service-detail></service-detail>

@endsection
