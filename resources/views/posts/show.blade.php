@extends('layouts.app')

@section('content')
  <div class="container">

    <div class="row">

      <div class="col-lg-9">

        <div class="card mt-4">
          <img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">
          <div class="card-body">
            <h3 class="card-title">{{ $post->title }}</h3>
            <h4>Posted by: {{ $post->organization->user->name }}</h4>
            <p class="card-text">{{ $post->description }}</p>
          </div>
        </div>
        
        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Comments
          </div>
          <div class="card-body" id="root">
            <form>
                @csrf
                <div class="form-group">
                    <textarea name="comment" class="form-control" rows="1" placeholder="Leave a comment" v-model="newCommentCommentText"></textarea>
                </div>
                <a class="btn btn-success" @click="createComment()">Leave a Comment</a>
                <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
            </form>
            <div v-for="comment in comments">
                <hr>
                <p>@{{ comment.comment_text }}</p>
                <small class="text-muted">Posted by @{{ comment.user.name }} on @{{ comment.created_at }}</small>
                <button v-if="commentBelongsTo(comment)" @click="" type="button" class="btn btn-sm btn-outline-danger pull-right">delete</button>
                <button v-if="commentBelongsTo(comment)" @click="" type="button" class="btn btn-sm btn-outline-secondary pull-right">Edit </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <meta name="user-id" content="{{ Auth::user()->id }}">
  <meta name="post-id" content="{{ $post->id }}">
  @endsection

 

  @push('scripts')
  <script>
    Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
    Vue.prototype.$postId = document.querySelector("meta[name='post-id']").getAttribute('content');
    var app = new Vue({
        el: "#root",
        data: {
          comments: [],
          newCommentCommentText: '',
          validationErrors: '',
        },
        mounted() {
          axios.get("{{ route('api.posts.comments', ['post' => $post->id]) }}") 
          .then(response => {
            this.comments = response.data;
          })
          .catch(error => {
            console.log(error); 
          })
        },
        methods: {
          createComment() {
            axios.post("{{ route ('api.comments.store') }}", {
              comment_text: this.newCommentCommentText,
              post_id: this.$postId,
              user_id: this.$userId,
            })
            .then(response => {
              this.comments.unshift(response.data);
              this.newCommentCommentText = '';
              this.validationErrors = '';
            })
            .catch(error => {
                if (error.response.status == 422){
                  this.validationErrors = error.response.data.errors;
                }
            })
          },
          commentBelongsTo: function(comment) {
            if (this.$userId == comment.user.id) {
              return true;
            }
            return false;
          }
        }
    });
    Vue.component('validation-errors', {
      data(){
          return {
              
          }
      },
      props: ['errors'],
      template: `<div v-if="validationErrors">
                  <ul class="alert alert-danger">
                      <li v-for="(value, key, index) in validationErrors">@{{ value }}</li>
                  </ul>
              </div>`,
      computed: {
          validationErrors(){
              let errors = Object.values(this.errors);
              errors = errors.flat();
              return errors;
          }
      }
  });
</script>
@endpush
