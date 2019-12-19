@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="card card-outline-secondary my-4">
          <div class="card-body" id="root">
          @if (Auth::user()->id == $post->organization->user->id)
          @else
          You are not authorized to edit this post.
          <a href="{{ route('posts.index') }}">Return to posts list.</a>
          @endif

          </div>
        </div>
      </div>
    </div>
  </div>
  
@endsection
