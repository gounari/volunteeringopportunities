@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="card card-outline-secondary my-4">
          <div class="card-body" id="root">
            {!! Form::open(['action' => ['CommentController@update', $comment->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('comment', 'Your comment')}}
                {{Form::text('comment', $comment->comment_text, ['class' => 'form-control', 'placeholder' => $comment->comment_text ])}}
            </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Update', ['class'=>'btn btn-sm btn-outline-secondary'])}}
            {!! Form::close() !!}

            <form method="POST"
                action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger pull-right">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
