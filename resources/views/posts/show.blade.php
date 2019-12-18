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
                    <div class="form-group">
                        <textarea name="comment" class="form-control" rows="3" placeholder="Leave a comment"></textarea>
                    </div>
                    <a href="#" class="btn btn-success">Leave a Comment</a>
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
        },
        mounted() {
            axios.get("{{ route('api.posts.comments', ['post' => $post->id]) }}") 
            .then(response => {
              this.comments = response.data; 
              console.log(response.data); 
            })
            .catch(error => {
                console.log(error); 
            })
        },
        methods: {
          
        }
    });
  </script>
</body>

</html>
