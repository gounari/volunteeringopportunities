@extends('layouts.app')

@section('content')
<div class="container" id="root">

  <div class="row">

    <div class="col-md-8">

      <h1 class="my-4"></h1>
      <ul>
        <div class="card mb-4" v-for="post in posts" >
        <img class="card-img-top" :src="image(post)" alt="Opportunity image">
            <div class="card-body">
                <h2 class="card-title">@{{ post.title }}</h2>
                <p class="card-text">@{{ post.description }}</p>
                <a :href="show(post)" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
            Posted on @{{ post.created_at}} by
                <a href="#">@{{ post.organization.user.name }}</a>
            </div>
        </div>
      </ul>
    </div>

    <div class="col-md-4">
      <div class="card my-4">
        <h5 class="card-header">Add opportunity</h5>
        <div class="card-body">
          @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" id="title" placeholder="Title" v-model="newPostTitle">
          </div>
          <div class="form-group">
            <label for="country">Country</label>
            <input class="form-control" id="country" placeholder="Country" v-model="newPostCountry">
          </div>
          <div class="form-group">
            <label for="start_date">Start Date</label>
            <input class="form-control" id="start_date" placeholder="Start Date" v-model="newPostStartDate">
          </div>
          <div class="form-group">
            <label for="end_date">End Date</label>
            <input class="form-control" id="end_date" placeholder="End Date" v-model="newPostEndDate">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" placeholder="Describe the opportunity..." rows="3" v-model="newPostDescription"></textarea>
          </div>
          <div class="form-group">
            <label for="application_url">Application URL</label>
            <input class="form-control" id="application_url" placeholder="Application URL" v-model="newPostApplicationUrl">
          </div>
          <div class="form-group">
            <div class="name">Add Image</div>
            <div class="value">
                <div class="input-group js-input-file">
                    <input class="input-file" type="file" name="file_cv" id="file" v-on="newPostImage">
                </div>
            </div>
            </div>
            <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
          <span class="input-group-btn">
            <div class="my-3">
              <button @click="createPost" class="btn btn-primary" type="button">Add</button>
            </div>
          </span>
        </div>
      </div>
    </div>

  </div>
@endsection

@push('scripts')
<script>
  var app = new Vue({
      el: "#root",
      data: {
          posts: [],
          newPostTitle: '',
          newPostCountry: '',
          newPostStartDate: '',
          newPostEndDate: '',
          newPostDescription: '',
          newPostApplicationUrl: '',
          newPostImage: '',
          validationErrors: '',
      },
      mounted() {
          axios.get("{{ route ('api.posts.index') }}") 
          .then(response => {
            this.posts = response.data; 
          })
          .catch(error => {
              console.log(error); 
          })
      },
      methods: {
        createPost() {
          axios.post("{{ route ('api.posts.store') }}", {
              title: this.newPostTitle,
              country: this.newPostCountry,
              start_date: this.newPostStartDate,
              end_date: this.newPostEndDate,
              description: this.newPostDescription,
              application_url: this.newPostApplicationUrl,
              image: this.newPostImage,
          })
          .then(response => {
              this.posts.unshift(response.data);
              this.newPostTitle = '';
              this.newPostCountry = '';
              this.newPostStartDate = '';
              this.newPostEndDate = '';
              this.newPostDescription = '';
              this.newPostApplicationUrl = '';
              this.newPostImage = '';
              this.validationErrors = '';
          })
          .catch(error => {
              if (error.response.status == 422){
                  this.validationErrors = error.response.data.errors;
              }
          })
        },
        image: function (post) {
          return '../images/' + post.image;
        },
        show: function (post) {
          var id = post.id;
          return "{{ route('posts.show', ['post' => 0]) }}" + id;
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