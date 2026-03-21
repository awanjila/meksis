@extends('client.layout.app')

@section('title')
    Portfolio Category | {{ $category->name ?? 'Our Works' }}
@endsection

@section('content')
    <div id="app">
        <category-portfolios></category-portfolios>
    </div>

    <script>
        // Pass category slug to Vue component
        window.categorySlug = '{{ $categorySlug }}';
    </script>
@endsection