<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Volunteering Opportunities</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="../css/blog-home.css" rel="stylesheet" type="text/css">

</head>

<body>

  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/vuejs-paginator/2.0.0/vuejs-paginator.min.js"></script>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Volunteering Opportunities</a>
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
  <div class="container" id="root">

    <div class="row">

    <!-- Blog Entries Column -->
      <div class="col-md-8">

      <h1 class="my-4">
      </h1>

      <ul>
        <!-- Opportunity Post -->
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
    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">

<!-- Search Widget -->
<div class="card my-4">
  <h5 class="card-header">Add opportunity</h5>
    <div class="card-body">
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

</div>
<!-- /.row -->

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
</body>

</html>
