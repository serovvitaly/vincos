@extends('default.layout')

@section('title'){{ $seo_title }}@endsection
@section('description'){{ $seo_description }}@endsection

@section('content')
    <div class="post type-post status-publish format-standard hentry">
            <h2 class="title">{{ $title }}</h2>
            <div class="postdate">
                {{ $published_at }}
            </div>
            <div class="entry">
                    {!! $content !!}
            </div>
        <div class="postmeta">Категория: <a href="#" rel="category tag">{{ $category }}</a></div>
    </div>
@endsection