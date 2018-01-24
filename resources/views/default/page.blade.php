@extends('default.layout')

@section('title'){{ $title }}@endsection
@section('metaTitle'){{ $metaTitle }}@endsection
@section('metaDescription'){{ $metaDescription }}@endsection

@section('content')
    {!! $content !!}
@endsection