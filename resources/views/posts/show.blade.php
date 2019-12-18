<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Item - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/shop-item.css" rel="stylesheet">

</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
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
        <!-- /.card -->

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
                </div>
            
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="../jquery/jquery.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>

  <script>
    var app = new Vue({
        el: "#root",
        data: {
            comments: [],
            newCommentCommentText: '',
            current_post_id: '',
            validationErrors: '',
        },
        mounted() {
            axios.get("{{ route('api.posts.comments', ['post' => $post->id]) }}") 
            .then(response => {
              this.comments = response.data; 
              this.current_post_id = response.data[0].post_id;
            })
            .catch(error => {
                console.log(error); 
            })
        },
        methods: {
            createComment() {
                axios.post("{{ route ('api.comments.store') }}", {
                    comment_text: this.newCommentCommentText,
                    post_id: this.current_post_id,
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
</body>

</html>
