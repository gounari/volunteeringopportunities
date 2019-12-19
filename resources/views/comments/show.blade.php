@extends('layouts.app')

@section('content')
  <div class="container">

    <div class="row">
      <div class="col-lg-9">
        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Your comment
          </div>
          <div class="card-body" id="root">
            <form>
                
                <div class="form-group">
                    <textarea name="comment" class="form-control" rows="1">{{ $comment->comment_text }}</textarea>
                </div>
                
                <form method="POST"
                    action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-secondary pull-left">Update</button>
                </form>
                

                <form method="POST" 
                    action="{{ route('comments.update', ['comment' => $comment]) }}">
                </form>

                <form method="POST"
                    action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger pull-right">Delete</button>
                </form>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <meta name="user-id" content="{{ Auth::user()->id }}">
  @endsection
