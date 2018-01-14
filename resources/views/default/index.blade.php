@extends('default.layout')

@section('content')
    @foreach($posts as $post)
    <div class="post type-post status-publish format-standard hentry">
        <h2 class="title"><a href="/{{ $post->url }}/" rel="bookmark" title="Постоянная ссылка на {{ $post->title }}">{{ $post->title }}</a></h2>
        <div class="postdate">{{ $post->published_at }}</div>
        <div class="entry">
            {!! $post->annotation !!}
        </div>
    </div>
    @endforeach
    {{ $posts->links() }}
@endsection