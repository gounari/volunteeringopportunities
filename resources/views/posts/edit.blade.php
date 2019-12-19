@extends('layouts.app')

@section('content')
@if (Auth::user()->id === $post->user_id)
<div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="card card-outline-secondary my-4">
          <div class="card-body" id="root">
            
          </div>
        </div>
      </div>
    </div>
  </div>
  @else
    <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="card card-outline-secondary my-4">
          <div class="card-body" id="root">
              You are not authorized to edit this post.
          <a href="{{ route('posts.index') }}">Return to posts list.</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

@endsection
