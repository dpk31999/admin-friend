<template>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>Id post</th>
                                <th>Id user</th>
                                <th>Created at</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="post in posts" :key="post.id"> 
                                <td>{{post.id}}</td>
                                <td>{{post.user_id}}</td>
                                <td>{{post.created_at | formatDate}}</td>
                                <td>
                                    <button type="button" @click="changeDataPost(post.id)" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
                                        View demo
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">View Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" v-if="Object.keys(post).length !== 0">
                    <div class="d-flex justify-content-between header-post">
                    <span>
                        <img :src="post.user.url_avatar" width="40px" height="40px" style="border-radius: 50%" />
                        {{ post.user.name }}
                    </span>
                    </div>
                    <p class="title">{{ post.title }}</p>
                    <img :src="post.url_image" class="image-post" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>
<script>
export default {
  middleware: 'auth',
  metaInfo() {
    return { title: "Posts" };
  },

  data: () => ({
    posts: [],
    post : {}
  }),

  methods: {
    getPosts() {
      axios
        .get("/api/posts")
        .then((response) => {
          this.posts = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getPost(id) {
        axios.get('/api/posts/' + id)
        .then((response) => {
            this.post = response.data
        })
        .catch((error) => {
          console.log(error);
        });
    },
    changeDataPost(id) {
        this.getPost(id)
    }
  },

  created() {
    this.getPosts();
  },
};
</script>
<style scoped>
.image-post {
  width: 100%;
  padding: 0px 10px 10px;
}
.title {
  padding: 20px 10px;
}
</style>