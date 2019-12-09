@extends('layouts.app')

@section('title', 'Posts')

@section('content')

<p>The volunteering opportunities:</p>

<ul>
    @foreach ($posts as $post)
    <li><a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a></li>
    @endforeach
</ul>

<a href="{{ route('posts.create') }}">Create Post</a>
@endsection