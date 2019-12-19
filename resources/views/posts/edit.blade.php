@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="card card-outline-secondary my-4">
          <div class="card-body" id="root">
          @if (Auth::user()->id == $post->organization->user->id)

          {!! Form::open(['action' => ['PostController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $post->title, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('country', 'Country')}}
                {{Form::text('country', $post->country, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('start_date', 'Start Date')}}
                {{Form::text('start_date', $post->start_date, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('end_date', 'End Date')}}
                {{Form::text('end_date', $post->end_date, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::text('description', $post->description, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('application_url', 'Application URL')}}
                {{Form::text('application_url', $post->application_url, ['class' => 'form-control'])}}
            </div>
                <div class="form-group">
            <div class="name">Add Image</div>
            <div class="value">
                <div class="input-group js-input-file">
                {{Form::file('image')}}
                </div>
            </div>
            </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Update', ['class'=>'btn btn-sm btn-outline-secondary'])}}
            {!! Form::close() !!}

            <form method="POST"
                action="{{ route('posts.destroy', ['post' => $post]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger pull-right">Delete</button>
            </form>

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
