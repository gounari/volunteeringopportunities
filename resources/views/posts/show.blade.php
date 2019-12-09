@extends('layouts.app')

@section('title', 'Post details')

@section('content')

<p>The volunteering opportunitie:</p>

<ul>
    <li>Title: {{ $post->title }}</li>
    <li>Country: {{ $post->country }}</li>
    <li>Start Date: {{ $post->start_date }}</li>
    <li>End Date: {{ $post->end_date }}</li>
    <li>Description: {{ $post->description }}</li>
    <li>Apply: {{ $post->application_url }}</li>
    <li>Organization: {{ $post->organization->user->name }}</li>
</ul>

<form method="POST"
    action="{{ route('posts.destroy', ['id' => $post->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>

<a href="{{ route('posts.index') }}">Back</a>
@endsection