<!DOCTYPE html>
<head>
    <title>Comments</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    
    <div id="root">
        <h2>New comment</h2>
        Comment: <input type="text" id="input" v-model="newCommentCommentText">
        <button @click="createComment()">Create</button>
        <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>

        <h1>Comments</h1>
        <ul>
            <li v-for="comment in comments">@{{ comment.comment_text }}</li>
        </ul>
    </div>

    <script>
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
        var app = new Vue({
            el: "#root",
            data: {
                comments: [],
                newCommentCommentText: '',
                validationErrors: ''
            },
            mounted() {
                axios.get("{{ route ('api.comments.index') }}") 
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
                        comment_text: this.newCommentCommentText
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
    </script>
</body>
</html>
